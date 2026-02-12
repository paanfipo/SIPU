<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;

//Models
use App\User;
use App\Actividad;
use App\Cronograma;
use App\Convocatoria;


/**
 * Gestión Cronogramas 
 * 
 * Clase que se encarga de manipular la información del cronograma y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Cronograma
 */
class CronogramaController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Cronograma'])->only(['index']);
        $this->middleware(['permission:Crear Cronograma'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Cronograma'])->only(['show','update']);
    }

    /**
     * Muestra una lista de las convocatorias con la opción para ver el cronograma.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias =  Convocatoria::all();
        
        return view('emprendimiento.cronogramas.index',['convocatorias'=>$convocatorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Almacena un cronograma recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON data<Collection - Cronograma> user_created <text> user_updated <text> menssage <text> type <text>
     */
    public function store(Request $request)
    {
        $cronograma  = $request->cronograma;
        
        if($cronograma != null){
            $cronograma = Cronograma::find($cronograma);
            $cronograma->user_updated_at =\Auth::user()->id;
        }else{
            $cronograma = new Cronograma();
            $cronograma->user_created_at =\Auth::user()->id;
        }

        $actividad = Actividad::find($request->actividad);
        $cronograma->convocatoria_id = $request->convocatoria;
        $cronograma->actividad_id = $request->actividad;
        $cronograma->etapa_id = $actividad->etapa->id;
        $cronograma->fecha_hora_inicio = date('Y-m-d H:i:s', strtotime(str_replace("T"," ",$request->data_fecha_hora_inicio))); 
        $cronograma->fecha_hora_fin = date('Y-m-d H:i:s', strtotime(str_replace("T"," ",$request->data_fecha_hora_fin))); 
        $cronograma->duracion = $request->duracion;
        $cronograma->enlace = $request->enlace;
        $cronograma->observacion = $request->observacion;
        $cronograma->asesor_id = $request->asesor;
        $cronograma->save();
        

        return response()->json([
            'data'=> $cronograma,
            'user_created' => (isset($cronograma->usuario_creacion))? $cronograma->usuario_creacion->name : "",
            'user_updated' => (isset($cronograma->usuario_modificacion))? $cronograma->usuario_modificacion->name : "",
            'message' => 'El cronograma fue enviado con exito!',
            'type' => 'info',
        ]);
    }

   /**
     * Muestra la vista para crear cornogramas por orden de etapa y actividad según el convocatoria
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convocatoria = Convocatoria::find($id);
        
        /*foreach($convocatoria->etapas as $etapa){
            foreach($etapa->actividades as $actividad){
                $cronograma = $actividad->cronogramaConvocatoria($convocatoria->id);
                if(is_object($cronograma)){

                    echo "Is a schedule object <br/>";
                    echo "Objet Time ".$cronograma->fecha_hora_inicio."NN<br/>";
                    echo var_dump($cronograma->fecha_hora_inicio)."<br/>";

                }
                echo "Empty Schedule<br/>";
            }
        }*/

       // dd("stop");

        $asesores  = User::role('Asesor')->get();
        return view('emprendimiento.cronogramas.show',['convocatoria'=>$convocatoria,'asesores'=>$asesores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
