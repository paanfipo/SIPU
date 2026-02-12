<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\ActividadRequest;

//Models
use App\Actividad;
use App\Convocatoria;
use App\Cronograma;
use App\Etapa;

//Query
use DB;

/**
 * Gestion Actividades 
 * 
 * Clase que se encarga de manipular la información de la actividad y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Actividad
 */
class ActividadController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */

    public function __construct()
    {        
        $this->middleware(['permission:Listar Actividades'])->only(['index']);
        $this->middleware(['permission:Crear Actividad'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Actividad'])->only(['edit','update']);
        $this->middleware(['permission:Detalle Actividad'])->only(['show']);
    }

    /**
     * Muestra una lista de las actividades.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::all();
        return view('emprendimiento.actividades.index',['actividades'=>$actividades]);
    }

    /**
     * Muestra el formulario para crear un nueva actividad.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etapas = Etapa::all();
        return view('emprendimiento.actividades.create',['etapas'=>$etapas]);
    }

    /**
     * Almacena una actividad recién creada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Http\Requests\ActividadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActividadRequest $request)
    {        
        DB::beginTransaction();

        try{
            $actividad = new Actividad();
            $actividad->nombre = $request->nombre;
            $actividad->descripcion = $request->descripcion;
            $actividad->etapa_id = $request->etapa_id;
            $actividad->personalizacion = isset($request->personalizacion)? true : false;
            $actividad->user_created_at = \Auth::user()->id;

            $actividad->save();

            if($actividad->personalizacion === true){

                $convocatorias = Convocatoria::where('estado',1)->get();

                foreach($convocatorias as $convocatoria){

                    $cronograma = Cronograma::where('convocatoria_id',$convocatoria->id)->where('actividad_id',$actividad->id)->first();
                    //dd($cronograma);
                    if($cronograma == null){
                        $cronograma = new Cronograma();
                    }                 
                    
                    $cronograma->convocatoria_id = $convocatoria->id;
                    $cronograma->actividad_id = $actividad->id;
                    $cronograma->etapa_id = $request->etapa_id;
                    $cronograma->fecha_hora_inicio = null;
                    $cronograma->fecha_hora_fin = null;
                    $cronograma->duracion = null;
                    $cronograma->observacion = null;
                    $cronograma->asesor_id = null;
                    $cronograma->enlace = null;
                    $cronograma->user_created_at = \Auth::user()->id;
                    $cronograma->save();

                }
            }
            DB::commit();
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('actividades.index')->with('info','La actividad fue registrada con éxito');
        
    }

    /**
     * Muestra la actividad especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad =  Actividad::find($id);
        $etapas = Etapa::all();
        return view('emprendimiento.actividades.show',['actividad'=>$actividad,'etapas'=>$etapas,'disabled' => 'disabled']);
    }

    /**
     * Muestra el formulario para editar la actividad especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad =  Actividad::find($id);
        $etapas = Etapa::all();
        return view('emprendimiento.actividades.show',['actividad'=>$actividad,'etapas'=>$etapas]);
    
    }

    /**
     * Actualiza la actividad especificada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Http\Requests\ActividadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActividadRequest $request, $id)
    {
        $actividad = Actividad::find($id);
        $actividad->nombre = $request->nombre;
        $actividad->descripcion = $request->descripcion;
        $actividad->etapa_id = $request->etapa_id;
        $actividad->personalizacion = isset($request->personalizacion)? true : false;
        $actividad->user_updated_at = \Auth::user()->id;

        $actividad->save();

        if($actividad->personalizacion === true){

            $convocatorias = Convocatoria::where('estado',1)->get();

            foreach($convocatorias as $convocatoria){

                $cronograma = Cronograma::where('convocatoria_id',$convocatoria->id)->where('actividad_id',$actividad->id)->first();

                if($cronograma == null){
                    $cronograma = new Cronograma();
                }     

                $cronograma->convocatoria_id = $convocatoria->id;
                $cronograma->actividad_id = $actividad->id;
                $cronograma->etapa_id = $request->etapa_id;
                $cronograma->fecha_hora_inicio = null;
                $cronograma->fecha_hora_fin = null;
                $cronograma->duracion = null;
                $cronograma->observacion = null;
                $cronograma->asesor_id = null;
                $cronograma->enlace = null;
                $cronograma->user_created_at = \Auth::user()->id;
                $cronograma->save();

            }
        }

        return redirect()->route('actividades.index')->with('info','La actividad fue actualizada con éxito');
        
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
}
