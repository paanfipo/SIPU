<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;

//Query
use Illuminate\Support\Facades\DB;

//Models
use App\User;
use App\Oferta;
use App\TipoMaestro;
use App\TipoMaestroItem;

//Notificaciones
use App\Notifications\Novedades;

//Emails
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVacantes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Gestion Tramites 
 * 
 * Clase que se encarga de manipular todos los tramites de las diferentes vacantes y demas acciones que procede de ella.
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Vacantes
 * @subpackage Monitorias
 */

class TramitesController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['permission:Listar Trámites'])->only(['index']);
        $this->middleware(['permission:Detalle Oferta a Tramite'])->only(['show']);
    }

     /**
     * Muestra una lista de las diferentes postulaciones que se encuentran activas en la diferentes ofertas que hay en el sistema, según el rol lista las postulaciones de las ofertas creadas por el usuario en sesión.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */    
    public function index()
    {
        $ofertas = array();

        if(\Auth::user()->hasRole('Empresa')){
            $ofertas =  Oferta::select("*")->where('user_created_at', \Auth::user()->id)->get();
        }

        if(\Auth::user()->hasRole(['Director de programa','Profesor de apoyo'])){
            
           $monitorias = TipoMaestroItem::where('nombre','Monitorias')->first();
           $dependencias = [];

           if(\Auth::user()->hasRole('Director de programa')){
               $dependencias  = (isset(\Auth::user()->dependencias))?  array_column(\Auth::user()->dependencias->toArray(),'id') : [];                           
            }

            if(\Auth::user()->hasRole('Profesor de apoyo')){
                $dependencias  = (isset(\Auth::user()->dependenciasprofesorapoyo))?  array_column(\Auth::user()->dependenciasprofesorapoyo->toArray(),'id') : [];
            }

           $ofertas = $monitorias->ofertas()->whereIn('dependencia_id',$dependencias)->get();
           
        }

        if(\Auth::user()->hasRole('Administrador')){
            $ofertas = Oferta::all();
        }

        return view('vacantes.tramites.index',['ofertas'=>$ofertas]); 
    }
    

   /**
     * Muestra el detalle de la postulacion según el tipo de vacante, junto con la opción de aceptar o rechazar la postulación.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(request('user_id')); 
        
        $tramite = oferta::find($id);
        $nombre = $tramite->nombre_oferta;
        $usuario = $user->name;
        $postulacion = $tramite->postuladosOfertas()->where('id',$user->id)->get()[0];
        $estado = $postulacion->pivot->estado ? 'Activo':'Inactivo';
        $fase = $postulacion->pivot->fase ? 'Aprovada':'Pendiente';
        $user_id = $user->id;

        if($fase === 'Aprovada'){
            $mensajes[]= 'El usuario '.$usuario.' se encuentra aprovado en la oferta '.$nombre;
            $checkin_on = true; 
        }else{
            $mensajes[]= 'El usuario '.$usuario.' se encuentra pendiente en la oferta '.$nombre;
            $checkin_on = false; 
        }

        return view('vacantes.tramites.show',['disabled'=>'disabled',
                                                'tramite'=>$tramite,
                                                'nombre'=>$nombre,
                                                'usuario'=>$usuario,
                                                'estado'=>$estado,
                                                'fase'=>$fase,
                                                'errors_detail' => $mensajes,
                                                'checkin_on' => $checkin_on,
                                                'user' => $user
                                                ]);
    }

    

    /**
     * Aprueba la postulación vacante de la oferta.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admitirPostulacion(Request $request)
    {
        DB::beginTransaction(); 

        try{

            $user = User::find($request->user_id);
            $oferta = Oferta::find($request->oferta_id);

            $tramite = $oferta->postuladosOfertasActivas()->where('id',$user->id)->get();

            if(count($tramite) > 0){

                $attributes = [
                    'fase' => 1, 
                ];
                $oferta->postuladosOfertasActivas()->updateExistingPivot($user->id, $attributes);
            }


            if($user->hasRole('Estudiante')){
                $user->userInfo->promedio = $request->promedio;
                $user->userInfo->save();
            }   

            $collection = collect([
                "type"=>"Proceso de admisión vacantes",
                "oferta" => $oferta->nombre_oferta,
                "estado" => "Admitido",
                "de" => Auth::user()->name,
                "para" => $user->name,
                "message"=>'Fuiste admitido en la oferta '.$oferta->nombre_oferta,
                "detalle"=>$request->descripcion,
            ]);

            $user->notify(new Novedades($collection));

            Mail::to($user->email)->send(new EmailVacantes($collection));

            DB::commit(); 
        }catch (\Exception $e) {
            return response()->json([
                'message' => "Hubo un error comuniquese con soporte!!<br>".$e->getMessage(),
                'type' => 'error',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => "Hubo un error comuniquese con soporte!!<br>".$e->getMessage(),
                'type' => 'error',
            ]);
        }
        
        return response()->json([
            'message' => 'El usuario fue admitido',
            'type' => 'info',
        ]);
    }

    /**
     * Rechaza la postulación vacante de la oferta.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rechazarPostulacion($id)
    {
        DB::beginTransaction(); 
        
        try{      

            $user = User::find(request('user_id'));
            $oferta = Oferta::find($id);

            $tramite = $oferta->postuladosOfertasActivas()->where('id',$user->id)->get();        
                    
            if(count($tramite) > 0){

                $attributes = [
                        'fase' => 0,
                ];
                $oferta->postuladosOfertasActivas()->updateExistingPivot($user->id, $attributes);
            }

            DB::commit(); 
        }catch (\Exception $e) {            
            return redirect()->route('tramites.show', [$oferta->id,'user_id'=>$user->id,'tipo'=>$oferta->tipoOferta->nombre])->with('error',"Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return redirect()->route('tramites.show', [$oferta->id,'user_id'=>$user->id,'tipo'=>$oferta->tipoOferta->nombre])->with('error',"Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('tramites.index')->with('info','El usuario fue rechazado de la postulación');
    }

    /**
     * Muestra formulario de vinculación
     * @author Vanessa Quintero <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vinculacion($user_id,$id){

        $user = User::find($user_id);        
        $tramite = oferta::find($id);
        $postulacion = $tramite->postuladosOfertas()->where('id',$user->id)->get()[0];        
        $estado = $postulacion->pivot->estado ? 'Activo':'Inactivo';
        $fase = $tramite->faseLst()[$postulacion->pivot->fase];
        

        return view('vacantes.tramites.vinculacion',[
                                                'tramite'=>$tramite,
                                                'estado'=>$estado,
                                                'fase'=>$fase,
                                                'user' => $user
                                                ]);




    }

    
}
