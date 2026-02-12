<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CrearOfertasRequest;
use App\Http\Requests\ActualizarOfertasRequest;
use App\Http\Requests\PostularEstudiante;

//Models
use App\Oferta;
use App\TipoMaestro;
use App\TipoMaestroItem;
use App\User;
use App\Dependencia;
use App\Curriculum;

//Notificaciones
use App\Notifications\Novedades;

//Query
use Illuminate\Support\Facades\DB;

//Storage
use Illuminate\Support\Facades\Storage;

/**
 * Gestion Ofertas 
 * 
 * Clase que se encarga de manipular la información de las diferentes tipos de ofertas y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Vacantes
 * @subpackage Ofertas
 */
class OfertaController extends Controller
{
    
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {        
        $this->middleware(['permission:Listar Oferta'])->only(['index']);
        $this->middleware(['permission:Crear Oferta'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Oferta'])->only(['edit','update']);
        $this->middleware(['permission:Detalle Oferta'])->only(['show']);
        $this->middleware(['permission:Postular Oferta'])->only(['postular']);
        $this->middleware(['permission:Retirar Oferta'])->only(['retirar']);
    }
    
    /**
     * Muestra una lista de las ofertas que hay en el sistema.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $ofertas = array();
        
        if(\Auth::user()->hasAnyRole(['Administrador','Estudiante','Coordinador proyeccion social','Empresa','Coordinador de practicas','General'])){
            $practicas = TipoMaestroItem::where('nombre','Practicas')->first();

            $func_practicas = function($valor) {
                return array_merge(["nombre_tipo_oferta"=>"Practicas"], $valor);
            };

           $ofertas = array_merge($ofertas, array_map($func_practicas,$practicas->ofertas->toArray()) ) ;            
          
        }

        if(\Auth::user()->hasAnyRole(['Administrador','Empresa','Coordinador proyeccion social','Estudiante','General'])){
            
            $laborales = TipoMaestroItem::where('nombre','Laborales')->first();

            $func_laborales = function($valor) {
                return array_merge(["nombre_tipo_oferta"=>"Laborales"], $valor);
            };

           $ofertas = array_merge($ofertas, array_map($func_laborales,$laborales->ofertas->toArray()) ) ;            
        }

        if(\Auth::user()->hasAnyRole(['Administrador','Empresa','Coordinador administrativo','Estudiante','General','Director de programa'])){

            $monitorias = TipoMaestroItem::where('nombre','Monitorias')->first();
            
            $func_monitorias = function($valor) {
                return array_merge(["nombre_tipo_oferta"=>"Monitorias"], $valor);
            };

           $ofertas = array_merge($ofertas, array_map($func_monitorias,$monitorias->ofertas->toArray()) ) ;
        }

        return view('vacantes.ofertas.index',['ofertas'=>$ofertas]);
    }

    /**
     * Muestra el formulario para crear un nueva oferta.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_contrato = TipoMaestro::where('nombre', 'TIPO CONTRATO')->first();
        $item_tipos_contrato = $tipo_contrato->tiposmaestroitem;
        $dependencias = Dependencia::all();

        if( \Auth::user()->hasAnyRole(['Empresa']) ){
            $item_tipos_oferta = TipoMaestroItem::whereIn('nombre',['Practicas','Laborales'])->get();
        }else{
            $tipo_oferta = TipoMaestro::where('nombre', 'Ofertas')->first();
            $item_tipos_oferta = $tipo_oferta->tiposmaestroitem;
        }

        return view('vacantes.ofertas.create', [
                        'item_tipos_contrato'=>$item_tipos_contrato,
                        'item_tipos_oferta'=>$item_tipos_oferta,
                        'dependencias'=>$dependencias
                    ]);
    }

    /**
     * Almacena una oferta recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearOfertasRequest $request)
    {
        $oferta = new Oferta();
        $oferta ->nombre_empresa_dependencia = $request->nombre_empresa_dependencia;
        $oferta ->nombre_oferta = $request ->nombre_oferta;
        $oferta ->cargo = $request ->cargo;
        $oferta ->funciones = $request ->funciones;        
        $oferta ->tipo_contrato = (isset($request ->tipo_contrato))? $request ->tipo_contrato: null;        
        $oferta ->tipo_oferta = $request ->tipo_oferta;
        $oferta ->salario = $request ->salario;
        $oferta ->duracion_meses = $request ->duracion_meses;
        $oferta ->cantidad = $request ->cantidad;
        $oferta ->fecha_cierre_vacante = $request ->fecha_cierre_vacante;
        $oferta ->dependencia_id = ($request ->dependencia_id != "")? $request->dependencia_id : null;
        $oferta ->user_created_at = \Auth::user()->id;
        $oferta ->save();

        return redirect()->route('ofertas.index')->with('info','La Oferta fue registrada con éxito');
    }

    /**
     * Muestra la oferta laboral especificada junto con la opción de postularse a la vacante.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $oferta = Oferta::find($id);
        $tipo_contrato = TipoMaestro::where('nombre', 'TIPO CONTRATO')->first();
        $item_tipos_contrato = $tipo_contrato->tiposmaestroitem;

        if( \Auth::user()->hasAnyRole(['Empresa']) ){
            $item_tipos_oferta = TipoMaestroItem::whereIn('nombre',['Practicas','Laborales'])->get();
        }else{
            $tipo_oferta = TipoMaestro::where('nombre', 'Ofertas')->first();
            $item_tipos_oferta = $tipo_oferta->tiposmaestroitem;
        }
        $mensajes = array();
        
        $estados = Auth::user()->ofertasPostuladas()->where('id',$oferta->id)->wherePivot('estado', true)->get();
        
        if(count($estados) > 0){
            $mensajes[] = 'El usuario ya se encuentra registrado en la oferta '.$oferta->nombre_oferta;
            $checkin_on = true;
        }else{
            $mensajes[] = 'El usuario NO se encuentra registrado en la oferta '.$oferta->nombre_oferta;
            $checkin_on = false;
        }
        
        $dependencias = Dependencia::all();
        
        return view('vacantes.ofertas.show',[
                            'oferta' => $oferta, 
                            'disabled' => 'disabled', 
                            'item_tipos_contrato'=>$item_tipos_contrato,
                            'item_tipos_oferta'=>$item_tipos_oferta,
                            'errors_detail' => $mensajes,
                            'checkin_on'=> $checkin_on,
                            'dependencias'=> $dependencias
                        ]);
    }

   /**
     * Muestra el formulario para editar la oferta laboral especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oferta = Oferta::find($id);
        $tipo_contrato = TipoMaestro::where('nombre', 'TIPO CONTRATO')->first();
        $item_tipos_contrato = $tipo_contrato->tiposmaestroitem;
        
        $tipo_oferta = TipoMaestro::where('nombre', 'Ofertas')->first();
        $item_tipos_oferta = $tipo_oferta->tiposmaestroitem;

        $dependencias = Dependencia::all();

        return view('vacantes.ofertas.show',[                    
                    'oferta' => $oferta, 
                    'item_tipos_contrato'=>$item_tipos_contrato,
                    'item_tipos_oferta'=>$item_tipos_oferta,
                    'dependencias'=>$dependencias
        ]);
    }

    /**
     * Actualiza la oferta laboral especificada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarOfertasRequest $request, $id)
    {
        $oferta = Oferta::find($id);
        $oferta ->nombre_empresa_dependencia = $request->nombre_empresa_dependencia;
        $oferta ->nombre_oferta = $request ->nombre_oferta;
        $oferta ->cargo = $request ->cargo;
        $oferta ->funciones = $request ->funciones;
        $oferta ->tipo_contrato = (isset($request ->tipo_contrato))? $request ->tipo_contrato: null;   
        $oferta ->tipo_oferta = $request->tipo_oferta;
        $oferta ->salario = $request ->salario;
        $oferta ->duracion_meses = $request ->duracion_meses;
        $oferta ->cantidad = $request ->cantidad;
        $oferta ->fecha_cierre_vacante = $request ->fecha_cierre_vacante;
        $oferta ->user_updated_at = \Auth::user()->id;
        $oferta ->dependencia_id = ($request ->dependencia_id != "")? $request->dependencia_id : null;
        $oferta ->save();

        return redirect()->route('ofertas.index')->with('info','La Oferta fue actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * Postula el usuario en sesión en la oferta, tambien identifica si el usuario 
     * ya se encuentra postulado asi mismo le mostrara la opción de retirarse de la vacante.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postular($id)
    {
        $oferta = Oferta::find($id);

        try {

            //Notificar al usuario quien creo la oferta sobre la postulación que se genero
            $user_created_oferta = User::find($oferta->user_created_at);
            $collection = collect([
                "type"=>"Novedades Postulación Oferta",
                "oferta_id" => $oferta->id,
                "user_id" => Auth::user()->id,
                "tipo_oferta" => $oferta->tipoOferta->nombre,
                "message"=>'Un usuario del sistema se postulo a la oferta '.$oferta->nombre_oferta.' , haga click aquí, para revisar la postulación !',
            ]);

            $user_created_oferta->notify(new Novedades($collection)); 
           
            $sync_data_assig = [];

            $estados = Auth::user()->ofertasPostuladas()->where('id',$oferta->id)->get();
           
            if(count($estados) <= 0){       

                $sync_data_assig[0] = [
                'oferta_id' => $oferta->id,
                'user_id' => Auth::user()->id,
                'estado' => true,
                'fase' => false,
                ];

                $oferta->postuladosOfertas()->attach($sync_data_assig);

            }else{

                $oferta = Oferta::find($id);

                $attributes = [
                    'estado' => true
                ];

                $oferta->postuladosOfertas()->updateExistingPivot(Auth::user()->id, $attributes);

                return redirect()->route('ofertas.show',$id)->with('info', 'Ya estás postulado a esta oferta  !!');              
                
            }

           
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }
        
        return redirect()->route('ofertas.show',$id)->with('info', 'Postulación exitosa !!');   
        
    }


    /**
     * Postula el usuario tipo estudiante en sesión en la oferta, tambien identifica si el usuario 
     * ya se encuentra postulado asi mismo le mostrara la opción de retirarse de la vacante.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function postularEstudiante(Request $request, $id)
    {
        //DB::beginTransaction(); 
        
        $validatedData = $request->validate([            
            'confidencialidad' => 'mimes:pdf,xlx,csv|max:2048',
            'recibo_pago' => 'mimes:pdf,xlx,csv|max:2048',
        ]);

        
        $usuario_hv = Curriculum::where("user_id", Auth::user()->id)->first();

        if(!is_object($usuario_hv)){
            $usuario_hv = new Curriculum();
            $usuario_hv->user_id = Auth::user()->id;
            $usuario_hv->user_created_at = \Auth::user()->id;
        }else{
            $usuario_hv->user_updated_at = \Auth::user()->id;

            if($usuario_hv->cedula == "" || $usuario_hv->cedula == null){

                $validatedData = $request->validate([
                    'cedula' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);
            }

            if($usuario_hv->tabulado == "" || $usuario_hv->tabulado == null){

                $validatedData = $request->validate([
                    'tabulado' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);
            }

            
            if($usuario_hv->certificacion_bancaria == "" || $usuario_hv->certificacion_bancaria == null){

                $validatedData = $request->validate([
                    'certificacion_bancaria' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);
            }
        }

        $oferta = Oferta::find($id);

        try {

            //Notificar al usuario quien creo la oferta sobre la postulación que se genero
            $user_created_oferta = User::find($oferta->user_created_at);
            $collection = collect([
                "type"=>"Novedades Postulación Oferta",
                "oferta_id" => $oferta->id,
                "user_id" => Auth::user()->id,
                "tipo_oferta" => $oferta->tipoOferta->nombre,
                "message"=>'Un usuario del sistema se postulo a la oferta '.$oferta->nombre_oferta.' , haga click aquí, para revisar la postulación !',
            ]);

            $user_created_oferta->notify(new Novedades($collection)); 
           
            $sync_data_assig = [];

            $estados = Auth::user()->ofertasPostuladas()->where('id',$oferta->id)->get();
           
            if(count($estados) <= 0){       

                $sync_data_assig[0] = [
                'oferta_id' => $oferta->id,
                'user_id' => Auth::user()->id,
                'estado' => true,
                'fase' => false,
                ];

                $oferta->postuladosOfertas()->attach($sync_data_assig);

            }else{

                $oferta = Oferta::find($id);

                $attributes = [
                    'estado' => true
                ];

                $oferta->postuladosOfertas()->updateExistingPivot(Auth::user()->id, $attributes);

                //return redirect()->route('ofertas.show',$id)->with('info', 'Ya estás postulado a esta oferta  !!');              
                
            }

            //Save Cedula
            if($request->hasFile('cedula'))
            {
                $cedula = $request->file('cedula');

                if($usuario_hv->cedula != ""){
                    Storage::disk('public')->delete($usuario_hv->cedula);
                }

                $extension = $cedula->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$cedula->getClientOriginalName());
                $name_file = "cedula_".Auth::user()->id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.Auth::user()->id,$cedula,$name_file);            

                $usuario_hv->cedula = $path;            
            }
            
            //Save Tabulado
            if($request->hasFile('tabulado'))
            {
                $tabulado = $request->file('tabulado');

                if($usuario_hv->tabulado != ""){
                    Storage::disk('public')->delete($usuario_hv->tabulado);
                }

                $extension = $tabulado->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$tabulado->getClientOriginalName());
                $name_file = "tabulado_".Auth::user()->id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.Auth::user()->id,$tabulado,$name_file);            

                $usuario_hv->tabulado = $path;            
            }


            //Save Formato confidencialidad
            if($request->hasFile('confidencialidad'))
            {
                $confidencialidad = $request->file('confidencialidad');

                if($usuario_hv->confidencialidad != ""){
                    Storage::disk('public')->delete($usuario_hv->confidencialidad);
                }

                $extension = $confidencialidad->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$confidencialidad->getClientOriginalName());
                $name_file = "confidencialidad_".Auth::user()->id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.Auth::user()->id,$confidencialidad,$name_file);            

                $usuario_hv->confidencialidad = $path;            
            }

            //Save Recibo Pago
            if($request->hasFile('recibo_pago'))
            {
                $recibo_pago = $request->file('recibo_pago');

                if($usuario_hv->recibo_pago != ""){
                    Storage::disk('public')->delete($usuario_hv->recibo_pago);
                }

                $extension = $recibo_pago->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$recibo_pago->getClientOriginalName());
                $name_file = "recibo_pago_".Auth::user()->id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.Auth::user()->id,$recibo_pago,$name_file);            

                $usuario_hv->recibo_pago = $path;            
            }

            //Save Recibo Pago
            if($request->hasFile('certificacion_bancaria'))
            {
                $certificacion_bancaria = $request->file('certificacion_bancaria');

                if($usuario_hv->certificacion_bancaria != ""){
                    Storage::disk('public')->delete($usuario_hv->certificacion_bancaria);
                }

                $extension = $certificacion_bancaria->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$certificacion_bancaria->getClientOriginalName());
                $name_file = "certificacion_bancaria_".Auth::user()->id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.Auth::user()->id,$certificacion_bancaria,$name_file);            

                $usuario_hv->certificacion_bancaria = $path;            
            }
            
            $usuario_hv->save();

           //DB::commit(); 
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }
        
        return redirect()->route('ofertas.show',$id)->with('info', 'Postulación exitosa !!');   
        
    }

    /**
     * Retira el usuario de sesión de la oferta.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function retirar($id)
    {
        //DB::beginTransaction();
        try {

            $oferta = Oferta::find($id);
            $sync_data_assig = [];
            $estados = Auth::user()->ofertasPostuladas()->where('id',$oferta->id)->wherePivot('estado', true)->get();
                    
            if(count($estados) > 0){

                $attributes = [
                    'estado' => false
                ];

                    $oferta->postuladosOfertas()->updateExistingPivot(Auth::user()->id, $attributes);

            }else{                    
                return redirect()->route('ofertas.index')->with('info','Aún no estás postulado en esta oferta');
            }


            $usuario_hv = Curriculum::where("user_id", Auth::user()->id)->first();

            if(!is_object($usuario_hv)){
                $usuario_hv = new Curriculum();
                $usuario_hv->user_id = Auth::user()->id;
                $usuario_hv->user_created_at = \Auth::user()->id;
            }else{
                $usuario_hv->user_updated_at = \Auth::user()->id;
            }

            //Deleted Cedula
            if($usuario_hv->cedula != ""){
                Storage::disk('public')->delete($usuario_hv->cedula);
                $usuario_hv->cedula = null;
            }
            
            //Deleted Tabulado
            if($usuario_hv->tabulado != ""){
                Storage::disk('public')->delete($usuario_hv->tabulado);
                $usuario_hv->tabulado = null;
            }


            //Deleted Formato confidencialidad
            if($usuario_hv->confidencialidad != ""){
                Storage::disk('public')->delete($usuario_hv->confidencialidad);
                $usuario_hv->confidencialidad = null;
            }

            //Deleted Recibo Pago
            if($usuario_hv->recibo_pago != ""){
                Storage::disk('public')->delete($usuario_hv->recibo_pago);
                $usuario_hv->recibo_pago = null;
            }

            //Deleted Certificación Bancaria
            if($usuario_hv->certificacion_bancaria != ""){
                Storage::disk('public')->delete($usuario_hv->certificacion_bancaria);
                $usuario_hv->certificacion_bancaria = null;
            }

            $usuario_hv->save();

            //DB::commit();
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }
        
        return redirect()->route('ofertas.show',$id)->with('info', 'Has cancelado la postulacion a esta oferta !!');   

    }


      /**
         * Permite descargar  los archivos de la monitoria del postulado
         * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
         * @param  int $user_id, string $tipo
         * @return \Illuminate\Http\Response 
     */
    function downloadFile($user_id,$tipo){

        $user = User::find($user_id);

        if($tipo == 'Cedula'){
            $path = $user->curriculum->cedula;
        }

        if($tipo == 'Tabulado'){
            $path = $user->curriculum->tabulado;
        }

        if($tipo == 'Confidencialidad'){
            $path = $user->curriculum->confidencialidad;
        }

        if($tipo == 'Recibo de pago'){
            $path = $user->curriculum->recibo_pago;
        }

        if($tipo == 'Certificacion Bancaria'){
            $path = $user->curriculum->certificacion_bancaria;
        }

        $file = public_path()."/storage/".$path;
        //$headers = ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']; 
        return response()->download($file);
    }

    /**
         * Muestra el datalle de la oferta y da la oción de subir la documentación para las ofertas tipo monitorias
         * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
         * @param  int $id
         * @return \Illuminate\Http\Response 
     */
    function uploadFileOferta($id){

        $oferta = Oferta::find($id);
        $tipo_contrato = TipoMaestro::where('nombre', 'TIPO CONTRATO')->first();
        $item_tipos_contrato = $tipo_contrato->tiposmaestroitem;

        if( \Auth::user()->hasAnyRole(['Empresa']) ){
            $item_tipos_oferta = TipoMaestroItem::whereIn('nombre',['Practicas','Laborales'])->get();
        }else{
            $tipo_oferta = TipoMaestro::where('nombre', 'Ofertas')->first();
            $item_tipos_oferta = $tipo_oferta->tiposmaestroitem;
        }
        $mensajes = array();
        
        $estados = Auth::user()->ofertasPostuladas()->where('id',$oferta->id)->wherePivot('estado', true)->get();
        
        if(count($estados) > 0){
            $mensajes[] = 'El usuario ya se encuentra registrado en la oferta '.$oferta->nombre_oferta;
            $checkin_on = true;
        }else{
            $mensajes[] = 'El usuario NO se encuentra registrado en la oferta '.$oferta->nombre_oferta;
            $checkin_on = false;
        }
        
        $dependencias = Dependencia::all();
        
        return view('vacantes.ofertas.files',[
                            'oferta' => $oferta, 
                            'disabled' => 'disabled', 
                            'item_tipos_contrato'=>$item_tipos_contrato,
                            'item_tipos_oferta'=>$item_tipos_oferta,
                            'errors_detail' => $mensajes,
                            'checkin_on'=> $checkin_on,
                            'dependencias'=> $dependencias
                        ]);

    }

    /**
         * Permite Subir la documentación solicita en la ofertas tipos monitorias
         * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
         * @param  int $id, Request $request
         * @return \Illuminate\Http\Response 
     */
    function uploadFile(PostularEstudiante $request, $id){

        $usuario_hv = Curriculum::where("user_id", Auth::user()->id)->first();

        if(!is_object($usuario_hv)){
            $usuario_hv = new Curriculum();
            $usuario_hv->user_id = Auth::user()->id;
            $usuario_hv->user_created_at = \Auth::user()->id;
        }else{
            $usuario_hv->user_updated_at = \Auth::user()->id;
        }

        //Save Cedula
        if($request->hasFile('cedula'))
        {
            $cedula = $request->file('cedula');

            if($usuario_hv->cedula != ""){
                Storage::disk('public')->delete($usuario_hv->cedula);
            }

            $extension = $cedula->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$cedula->getClientOriginalName());
            $name_file = "cedula_".Auth::user()->id.".".$extension;
            $path = Storage::disk('public')->putFileAs('vacantes/ofertas/'.$id.'/postulados/'.Auth::user()->id,$cedula,$name_file);            

            $usuario_hv->cedula = $path;            
        }
        
        //Save Tabulado
        if($request->hasFile('tabulado'))
        {
            $tabulado = $request->file('tabulado');

            if($usuario_hv->tabulado != ""){
                Storage::disk('public')->delete($usuario_hv->tabulado);
            }

            $extension = $tabulado->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$tabulado->getClientOriginalName());
            $name_file = "tabulado_".Auth::user()->id.".".$extension;
            $path = Storage::disk('public')->putFileAs('vacantes/ofertas/'.$id.'/postulados/'.Auth::user()->id,$tabulado,$name_file);            

            $usuario_hv->tabulado = $path;            
        }


        //Save Formato confidencialidad
        if($request->hasFile('confidencialidad'))
        {
            $confidencialidad = $request->file('confidencialidad');

            if($usuario_hv->confidencialidad != ""){
                Storage::disk('public')->delete($usuario_hv->confidencialidad);
            }

            $extension = $confidencialidad->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$confidencialidad->getClientOriginalName());
            $name_file = "confidencialidad_".Auth::user()->id.".".$extension;
            $path = Storage::disk('public')->putFileAs('vacantes/ofertas/'.$id.'/postulados/'.Auth::user()->id,$confidencialidad,$name_file);            

            $usuario_hv->confidencialidad = $path;            
        }

        //Save Recibo Pago
        if($request->hasFile('recibo_pago'))
        {
            $recibo_pago = $request->file('recibo_pago');

            if($usuario_hv->recibo_pago != ""){
                Storage::disk('public')->delete($usuario_hv->recibo_pago);
            }

            $extension = $recibo_pago->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$recibo_pago->getClientOriginalName());
            $name_file = "recibo_pago_".Auth::user()->id.".".$extension;
            $path = Storage::disk('public')->putFileAs('vacantes/ofertas/'.$id.'/postulados/'.Auth::user()->id,$recibo_pago,$name_file);            

            $usuario_hv->recibo_pago = $path;            
        }

        //Save Recibo Pago
        if($request->hasFile('certificacion_bancaria'))
        {
            $certificacion_bancaria = $request->file('certificacion_bancaria');

            if($usuario_hv->certificacion_bancaria != ""){
                Storage::disk('public')->delete($usuario_hv->certificacion_bancaria);
            }

            $extension = $certificacion_bancaria->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$certificacion_bancaria->getClientOriginalName());
            $name_file = "certificacion_bancaria_".Auth::user()->id.".".$extension;
            $path = Storage::disk('public')->putFileAs('vacantes/ofertas/'.$id.'/postulados/'.Auth::user()->id,$certificacion_bancaria,$name_file);            

            $usuario_hv->certificacion_bancaria = $path;            
        }
        
        $usuario_hv->save();

        return redirect()->route('ofertas.index')->with('info', 'Los archivos se subieron con exito!!');  


    }

    
    
}
