<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\RequestIncubacionAceleracion;
use App\Http\Requests\RequestSensibilizacionPreincubacion;

//Models
use App\Etapa;
use App\User;
use App\Ciudad;
use App\UserInfo;
use App\Asistencia;
use App\Cronograma;
use App\TipoMaestro;
use App\Departamento;
use App\Convocatoria;
use App\Emprendimiento;
use App\Actividad;

//Query
use DB;


/**
 * Gestión Asistencia 
 * 
 * Clase que se encarga de manipular la información de la asistencia y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Asistencia
 */
class AsistenciaController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Asistencia'])->only(['index']);
        $this->middleware(['permission:Crear Asistencia'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Asistencia'])->only(['show','update']);
    }

    /**
     * Muestra una lista de las convocatorias que se encuentran hablitadas con la opción para generar asistencias.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias =  Convocatoria::all();
        return view('emprendimiento.asistencia.index',['convocatorias'=>$convocatorias]);
    }

    /**
     * Muestra toda la información de la convocatoria con la etapas desplegadas y en cada una con sus actividades y cronogrmas definidos, 
     * juntos con los listados de los inscriptos que se encuentran habilitados para marcar asistencia.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('emprendimiento.asistencia.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra toda la información de la convocatoria con la etapas desplegadas y en cada una con sus actividades y cronogrmas definidos, 
     * juntos con los listados de los inscriptos que se encuentran habilitados para marcar asistencia.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     
        $convocatoria = Convocatoria::findOrFail($id);
        $asesores  = User::role('Asesor')->get();        
        return view('emprendimiento.asistencia.show',['convocatoria'=>$convocatoria,'asesores'=>$asesores]);
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

    
    /**
     * Actualiza una asistencia en el almacenamiento, valida si el usuario a finalizado correctamente la etapa,
     * si ha finalizado correctamente la etapa, se registra de usuario sus respectivos registros de asistencias por cada cronograma de la siguiente etapa,
     * tambien se valida formularios de caracterización como prerequisito para pasar a la siguiente etapa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *          JSON    data<Collection - Asistencia> 
     *                  response <Collection - request> 
     *                  bandera_avance <boolean> 
     *                  bandera_avance_sensibilizacion <boolean> 
     *                  bandera_avance_incubacion <boolean>
     *                  message <text>
     *                  type <text>
     */
    public function setAjaxAsistencia(Request $request){

        $mensaje = "";
        $bandera_avance = null;
        $bandera_avance_sensibilizacion = null;
        $bandera_avance_incubacion = null;
        DB::beginTransaction();
        try {          
        
            $mensaje = "";
            $type = "info";
            $asistencia_id = $request->asistencia_id;
            $asistencia_mark = ($request->asistencia)? 1 : 0;
            
            $asistencia = Asistencia::find($asistencia_id);
            $asistencia->asistencia = $asistencia_mark;
            $asistencia->user_updated_at =\Auth::user()->id;
            $asistencia->save();
            
            //Validar si el usuario ya finalizo la etapa y termino de llenar los formularios de caracterización según la etapa
            $bandera_avance = $this->validarAvance($asistencia->user_id,$request->convocatoria,$request->etapa);
            $bandera_avance_sensibilizacion = $this->validarAvanceCaracterizacionSensibilizacion($asistencia->user_id,$request->convocatoria,$asistencia_id,$request->etapa);
            $bandera_avance_incubacion = $this->validarAvanceCaracterizacionIncubacion($asistencia->user_id,$request->convocatoria,$asistencia_id,$request->etapa);
            
            
            if($bandera_avance && $bandera_avance_sensibilizacion && $bandera_avance_incubacion){ 
                //Registra al usuario en la siguiente etapa
                $mensaje  = $this->registrarse($asistencia->user_id,$request->convocatoria,$request->etapa);            
                
                //Actualizar avance de la actual
                $mensaje.= $this->actualizarAvance($asistencia->user_id,$request->convocatoria,$request->etapa);
            }
            
            DB::commit();
            
        }catch (\Exception $e) {
            $mensaje = "Hubo un error en registrar avance comuniquese con soporte!!<br>".$e->getMessage();
        } catch (\Throwable $e) {
            $mensaje = "Hubo un error en registrar avance comuniquese con soporte!!<br>".$e->getMessage();
            
        }

        if($mensaje != ""){
            $type = "error";
        }else{
            $mensaje = "La asistencia se registro con exito !";
        }
        
        return response()->json([
            'data'=> $asistencia,
            'response'=> $request->all(),
            'bandera_avance'=> $bandera_avance,
            'bandera_avance_sensibilizacion'=> $bandera_avance_sensibilizacion,
            'bandera_avance_incubacion'=> $bandera_avance_incubacion,
            'message' => $mensaje,
            'type' => $type,
        ]);

    }

    
    /**
     * Valida si el usuario a finalizado correctamente la etapa en la convocatoria, 
     * revisando listado de asistencia por cronograma en cada etapa 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @param  int  $etapa_id
     * @return boolean
     */
    public function validarAvance($user_id,$convocatoria_id,$etapa_id){       

        //Primero validar si los avances (etapas) anteriores estan completos
        $bandera = true;
        $convocatoria = Convocatoria::find($convocatoria_id);
        if($convocatoria == null){
            return false;
        }

        $etapas = $convocatoria->etapas;
        
        foreach($etapas as $etapa){

            if($etapa->id == $etapa_id){
                break;
            }

            $registrados_sinfinalizar = $convocatoria->registrados()->wherePivot('etapa_id', $etapa->id)->wherePivot('finalizado', false)->get();            
           
            if(count($registrados_sinfinalizar->where('id',$user_id)) > 0){
                $bandera = false;
                break;
            }
        }

        //Validar si ya termino todas las actividades de la etapa donde se encuentra
        $etapa = Etapa::find($etapa_id);
        if($etapa == null){
            return false;
        }

        $actividades = $etapa->actividades->toArray();
        $actividad_id = array_column($actividades,'id');
        $cronogramas = Cronograma::select("*")->where('convocatoria_id',$convocatoria_id)->whereIn('actividad_id',$actividad_id)->get();

        foreach($cronogramas as $cronograma){

            if(count(Asistencia::select("*")->where('cronograma_id',$cronograma->id)->where('user_id',$user_id)->where('asistencia',false)->get()) > 0){
                $bandera = false;
                break;
            }
        }

        return $bandera;
    }   

     /**
     * Registra el usuario en la etapa indicada según la convocatoria y 
     * tambien registra el listado de asistencia de los cornogramas de la etapa siguiente
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @param  int  $etapa_id
     * @return void
     */
    public function registrarse($user_id,$convocatoria_id,$etapa_id){

        $mensaje = "";
        DB::beginTransaction();
        try {

            $user = User::find($user_id);
            $regsitro = $user->etapas()->wherePivot('convocatoria_id', $convocatoria_id)->get();  
            $arrayid_etapas_registradas = array_column($regsitro->toArray(),'id');

            
            $convocatoria = Convocatoria::find($convocatoria_id);
            $etapas = $convocatoria->etapas;
            $posicion = 0;
            
            $emprendimiento = null;
            $sync_data_assig = [];
            $arrayid_actividades = [];
            
            $pivot_emprendimiento = $user->userEmprendimientoConvocatoria($etapa_id)->where('id',$convocatoria_id)->get();    
                       
            foreach($etapas as $etapa){
                
                if($etapa->id == $etapa_id){
                    $posicion = $etapa->pivot->posicion;
                    $posicion++;
                }
                
                if(!(in_array($etapa->id, $arrayid_etapas_registradas)) && $etapa->pivot->posicion == $posicion){  
                    
                    $emprendimiento = (count($pivot_emprendimiento)>0)? $pivot_emprendimiento[0]->pivot->emprendimiento : null;
                    $sync_data_assig[$etapa->id] = [
                        'emprendimiento' => $emprendimiento,
                        'finalizado' => false,
                        'user_id' => $user_id,
                    ];

                    $arrayid_actividades = array_column($etapa->actividades->toArray(),'id');
                                        
                    break;  
                }

            }

            if(count($sync_data_assig) > 0){
                $convocatoria->etapaAvance()->attach($sync_data_assig);

                //Regsitro de asistencia de la actividad de la primera etapa de la convocatoria
                $cronogramas =  $convocatoria->cronogramas->whereIn('actividad_id',$arrayid_actividades);

                foreach($cronogramas as $cronograma){

                    $asistencia = Asistencia::where('cronograma_id',$cronograma->id)->where('user_id',$user_id)->first();
                    if($asistencia == null){
                        $asistencia = new Asistencia();
                    }                    
                    $asistencia->cronograma_id = $cronograma->id;
                    $asistencia->user_id = $user_id;
                    $asistencia->asistencia = false;
                    $asistencia->emprendimiento_id = $emprendimiento;
                    $asistencia->user_created_at =\Auth::user()->id;
                    $asistencia->user_updated_at = \Auth::user()->id;
                    $asistencia->save();

                }
            }   

            DB::commit();

        }catch (\Exception $e) {
            $mensaje = "Hubo un error en registrar avance comuniquese con soporte!!<br>".$e->getMessage();
        } catch (\Throwable $e) {
            $mensaje = "Hubo un error en registrar avance comuniquese con soporte!!<br>".$e->getMessage();
        }

        return $mensaje;
    }   

    /**
     * Actualiza el avance de la etapa según la convocatoria
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @param  int  $etapa_id
     * @return void
     */
    public function actualizarAvance($user_id,$convocatoria_id,$etapa_id){
            
        DB::beginTransaction();
        $mensaje = "";
        try {

            //$convocatoria = Convocatoria::find($convocatoria_id);
            $user = User::find($user_id);

            DB::table('convocatoria_etapa_user')
                ->where('user_id',$user_id)
                ->where('convocatoria_id',$convocatoria_id)
                ->where('etapa_id',$etapa_id)
                ->update(['finalizado' => true]);
            
            DB::commit();
        }catch (\Exception $e) {
            $mensaje = "Hubo un error en actualizar avance comuniquese con soporte!!<br>".$e->getMessage();
        } catch (\Throwable $e) {
            $mensaje = "Hubo un error en actualizar avance comuniquese con soporte!!<br>".$e->getMessage();
        }

        return $mensaje;
    }

    
    /**
     * Registra la asistencia de todos los usuarios inscriptos en el cronograma según la etapa y convocatoria,
     * en este punto solo se hace el proceso de validacion avance etapa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *          JSON bandera_avance<boolean>
     *               data <Collection $request> 
     *               message <text> 
     *               type <text>
     */
    public function setAjaxAllAsistencia(Request $request){

        $mensaje = "";
        $type = "info";
        $convovatoria_id = $request->convocatoria;
        $etapa_id = $request->etapa;
        $asistencias = Asistencia::where('cronograma_id',$request->cronograma)->get();

        foreach($asistencias as $asistencia){
            $asistencia = Asistencia::find($asistencia->id);
            $asistencia->asistencia = true;
            $asistencia->user_updated_at =\Auth::user()->id;
            $asistencia->save();

             //Validar si el usuario ya finalizo la etapa
            $bandera_avance = $this->validarAvance($asistencia->user_id,$convovatoria_id,$etapa_id);
            $bandera_avance_sensibilizacion = $this->validarAvanceCaracterizacionSensibilizacion($asistencia->user_id,$convovatoria_id,$asistencia->id,$etapa_id);
            $bandera_avance_incubacion = $this->validarAvanceCaracterizacionIncubacion($asistencia->user_id,$convovatoria_id,$asistencia->id,$etapa_id);
            if($bandera_avance && $bandera_avance_sensibilizacion && $bandera_avance_incubacion){
                $mensaje  = $this->registrarse($asistencia->user_id,$convovatoria_id,$etapa_id);            
                //Actualizar avance de la actual
                $mensaje.= $this->actualizarAvance($asistencia->user_id,$convovatoria_id,$etapa_id);
            }
        }

        if($mensaje != ""){
            $type = "error";
        }else{
            $mensaje = "La asistencia se registro con exito !";
        }

        return response()->json([
            'bandera_avance'=> $bandera_avance,
            'data'=> $request->all(),
            'message' => $mensaje,
            'type' => $type,
        ]);

    }

    /**
     * Muestra el formulario de caracterización emprendimiento que se debe llenar en la etapa de sensibilización
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function caracterizacion_sensibilizacion($convocatoria,$user){
        
        $usuario = User::find($user);
        
        $convocatoria = Convocatoria::find($convocatoria);

        $etapa = Etapa::where("nombre","SENSIBILIZACIÓN")->first();

        $pivot_emprendimiento = $usuario->userEmprendimientoConvocatoria($etapa->id)->where('id',$convocatoria->id)->get();
        
        if(count($pivot_emprendimiento) > 0){

            $emprendimiento = Emprendimiento::find($pivot_emprendimiento[0]->pivot->emprendimiento); 
            //$modelo_negocio = json_decode($emprendimiento->modelo_negocio);
            //dd($modelo_negocio->propuesta_valor);
            //$modelo_negocio = json_decode($emprendimiento->modelo_negocio);

            $maestro = TipoMaestro::where('nombre','Sexo')->first();
            $tipos_sexo = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Etnia')->first();
            $tipos_etnias = $maestro->tiposmaestroitem;
            
            $departamentos = Departamento::all();
    
            $maestro = TipoMaestro::where('nombre','Tipo de zona')->first();        
            $tipos_zona = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Nivel de estudios')->first();        
            $nivel_estudio = $maestro->tiposmaestroitem;
    
            $ciudades = Ciudad::all();
    
            $maestro = TipoMaestro::where('nombre','Sector Económico')->first();        
            $sector_economico = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Fases del emprendimiento')->first();        
            $fases_emprendimiento = $maestro->tiposmaestroitem;       

            $maestro = TipoMaestro::where('nombre','Tipo de zona')->first();  
            $tipos_zonas = $maestro->tiposmaestroitem;      
    
            return view('emprendimiento.asistencia.sensibilizacion_preincubacion',[
                'tipos_sexo' => $tipos_sexo,
                'tipos_etnias' => $tipos_etnias,
                'departamentos' => $departamentos,
                'tipos_zona' => $tipos_zona,
                'nivel_estudio' => $nivel_estudio,
                'ciudades' => $ciudades,
                'sector_economico' => $sector_economico,
                'fases_emprendimiento' => $fases_emprendimiento,
                'tipos_zonas' => $tipos_zonas,
                'convocatoria' => $convocatoria,
                'usuario' => $usuario,
                'etapa' => $etapa,
                'emprendimiento' => $emprendimiento,
                
            ]);

        }else{
            return back()
            ->with('info', "El usuario no se encuentra registrado en la convocatoria!!<br>");
        }
       
    }

    /**
     * Registra toda la información de caracterizacion emprendimiento en el almacenamiento
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\RequestSensibilizacionPreincubacion  $request
     * @return \Illuminate\Http\Response
     */
    public function set_caracterizacion_sensibilizacion(RequestSensibilizacionPreincubacion $request){

        DB::beginTransaction();
        try {

           // dd($request->all());

            $user = User::find($request->usuario);
            $user_info = UserInfo::where('user_id',$user->id)->first();
    
            $emprendimiento = Emprendimiento::find($request->emprendimiento_id);
    
            //User Info
            $user_info->sexo = $request->sexo;
            $user_info->etnia = $request->etnia;
            $user_info->edad = $request->edad;
            $user_info->ciudad_id = $request->ciudad_usuario;
            $user_info->direccion = $request->direccion_usuario;
            $user_info->nivel_estudio = $request->nivel_estudio_usuario;
            $user_info->tipo_zona = $request->tipo_zona;
            $user_info->user_id = $user->id; 
            $user_info->user_created_at = \Auth::user()->id;
            $user_info->user_updated_at = \Auth::user()->id;
    
            $user_info->save();

            //Emprendimiento
            $emprendimiento = new Emprendimiento;
            if($request->emprendimiento_id != null){
                $emprendimiento = Emprendimiento::find($request->emprendimiento_id);
            }

            $detalle_modelo_negocio = [
                'propuesta_valor' => $request->propuesta_valor,
                'relacion_cliente' => $request->relacion_cliente,
                'canal_distribucion' => $request->canal_distribucion,
                'recursos_actuales' => $request->recursos_actuales,
                'inversion_realizada' => $request->inversion_realizada,
                'aliados_actuales' => $request->aliados_actuales,
            ];

            $emprendimiento->nombre = $request->nombre_emprendimiento;
            $emprendimiento->descripcion = $request->descripcion_emprendimiento;
            $emprendimiento->modelo_negocio = json_encode($detalle_modelo_negocio,JSON_UNESCAPED_UNICODE);
            $emprendimiento->ciudad_id = $request->ciudad_empre;
            $emprendimiento->integrantes_hombres = $request->integrantes_hombres;
            $emprendimiento->integrantes_mujeres = $request->integrantes_mujeres;
            $emprendimiento->sector_economico = $request->sector_economico;
            $emprendimiento->producto_servicio = $request->producto_servicio;
            $emprendimiento->fase_emprendimiento = $request->fase_emprendimiento;
            $emprendimiento->user_id = $user->id;
            $emprendimiento->user_created_at = \Auth::user()->id;
            $emprendimiento->user_updated_at = \Auth::user()->id;

            $emprendimiento->save();

            //Set emprendimiento convocatoria user
            $convocatoria = Convocatoria::find($request->convocatoria);
            $user = User::find($request->usuario);
            $etapas_convo = $convocatoria->etapaAvance()->wherePivot('user_id', $user->id)->get();

            if(count($etapas_convo) > 0){
                foreach($etapas_convo as $etapa){

                    if($etapa->nombre == "SENSIBILIZACIÓN"){
                        DB::table('convocatoria_etapa_user')
                            ->where('user_id',$user->id)
                            ->where('convocatoria_id',$convocatoria->id)
                            ->where('etapa_id',$etapa->id)
                            ->update([
                                'emprendimiento' => $emprendimiento->id,
                                'caracterizacion' => true,
                            ]);
                        break;
                    }
                   
                }
            }

            if($this->validarAvance($user->id,$request->convocatoria,$request->etapa)){
                $this->registrarse($user->id,$request->convocatoria,$request->etapa);
                $this->actualizarAvance($user->id,$request->convocatoria,$request->etapa);
            }
            
            DB::commit();
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error al registrar el los datos de caracterización en sensibilización, comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
            ->with('error', "Hubo un error al registrar el los datos de caracterización en sensibilización, comuniquese con soporte!!<br>".$e->getMessage())->withInput();;
        
        }

        return redirect()->route('asistencia.caracterizacion_sensibilizacion',[$request->convocatoria,$request->usuario])
            ->with('info', 'Registro exitoso !!');   
        
    }

    /**
     * Valida si el usuario a finalizado de llenar el formulario de caracterización emprendimiento en la etpa de sensibilización
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @param  int  $etapa_id
     * @param  int  $asistencia_id
     * @return boolean
     */
    public function validarAvanceCaracterizacionSensibilizacion($user_id,$convocatoria_id,$asistencia_id,$etapa_id){

        //Primero validar si los avances (etapas) anteriores estan completos
        $bandera = true;
        $convocatoria = Convocatoria::find($convocatoria_id);
        //$etapa = Etapa::where('nombre','SENSIBILIZACIÓN')->first();
        $etapa = Etapa::find($etapa_id);

        if($etapa->nombre == "SENSIBILIZACIÓN"){

            $registrados_sincaracterizacion = $convocatoria->registrados()->wherePivot('etapa_id', $etapa->id)->wherePivot('caracterizacion', false)->get();            
        
            if(count($registrados_sincaracterizacion->where('id',$user_id)) > 0){

                $asistencia = Asistencia::find($asistencia_id);
                $asistencia->asistencia = false;
                $asistencia->user_updated_at =\Auth::user()->id;
                $asistencia->save();
                
                $bandera = false;           
            }        

        }        

        return $bandera;

    }

    /**
     * Muestra el formulario de caracterización empresarial que se debe llenar en la etapa de incubación
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function caracterizacion_empresarial($convocatoria,$user){

        $usuario = User::find($user);        
        $convocatoria = Convocatoria::find($convocatoria);
        $etapa = Etapa::where("nombre","INCUBACIÓN (ASESORIAS)")->first();

        $pivot_emprendimiento = $usuario->userEmprendimientoConvocatoria($etapa->id)->where('id',$convocatoria->id)->get();
        
        if(count($pivot_emprendimiento) > 0){

            $emprendimiento = Emprendimiento::find($pivot_emprendimiento[0]->pivot->emprendimiento);           
            
            $departamentos = Departamento::all();
            $ciudades = Ciudad::all();
    
            $maestro = TipoMaestro::where('nombre','Tipo de zona')->first();        
            $tipos_zona = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Tipos de empresas')->first();        
            $tipos_empresa = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Ruta empresarial')->first();        
            $ruta_emprensarial = $maestro->tiposmaestroitem;
    
            $maestro = TipoMaestro::where('nombre','Ruta Módulo')->first();        
            $ruta_modulo = $maestro->tiposmaestroitem;       

            $maestro = TipoMaestro::where('nombre','Ruta tipo acompañamiento')->first();  
            $ruta_acompañamiento = $maestro->tiposmaestroitem;      
    
            return view('emprendimiento.asistencia.incubacion_aceleracion',[
                'emprendimiento' => $emprendimiento,
                'departamentos' => $departamentos,
                'ciudades' => $ciudades,
                'tipos_zonas' => $tipos_zona,
                'tipos_empresa' => $tipos_empresa,
                'ruta_emprensarial' => $ruta_emprensarial,
                'ruta_modulo' => $ruta_modulo,
                'ruta_acompañamiento' => $ruta_acompañamiento,                
                'usuario' => $usuario,                
                'convocatoria' => $convocatoria,                
                'etapa' => $etapa,                
            ]);

        }else{
            return back()
            ->with('info', "El usuario no se encuentra registrado en la convocatoria!!<br>");
        }

    }

    /**
     * Registra toda la información de caracterizacion empresarial en el almacenamiento
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\RequestIncubacionAceleracion  $request
     * @return \Illuminate\Http\Response
     */
    public function set_caracterizacion_empresarial(RequestIncubacionAceleracion $request){

        //dd($request->all());
        DB::beginTransaction();
        try {

            $convocatoria = Convocatoria::find($request->convocatoria);
            $etapa = Etapa::find($request->etapa);
            $emprendimiento = Emprendimiento::find($request->emprendimiento_id);
            $usuario = User::find($request->usuario);

            $usuario_info = UserInfo::where('user_id',$usuario->id)->first();

            $usuario_info->ciudad_id = $request->ciudad_usuario;
            $usuario_info->direccion = $request->direccion_usuario;
            $usuario_info->tipo_zona = $request->tipo_zona;
            $usuario_info->save();

            $emprendimiento->camara_comercio = $request->camara_comercio;
            $emprendimiento->tipo_empresa = $request->tipo_empresa;
            $emprendimiento->ruta_empresarial = $request->ruta_empresarial;

            $emprendimiento->tipo_ruta_modulo =  json_encode($request->ruta_modulo,JSON_UNESCAPED_UNICODE);
            $emprendimiento->tipo_ruta_acompañamiento = $request->ruta_acompañamiento;
            $emprendimiento->save();

            //Set actualiza caracterización
            $etapas_convo = $convocatoria->etapaAvance()->wherePivot('user_id', $usuario->id)->get();

            if(count($etapas_convo) > 0){
                foreach($etapas_convo as $etapa){

                    if($etapa->nombre == "INCUBACIÓN (ASESORIAS)"){
                        DB::table('convocatoria_etapa_user')
                            ->where('user_id',$usuario->id)
                            ->where('convocatoria_id',$convocatoria->id)
                            ->where('etapa_id',$etapa->id)
                            ->update(['caracterizacion' => true]);
                        break;
                    }
                   
                }
            }

            if($this->validarAvance($usuario->id,$request->convocatoria,$request->etapa)){
                $this->registrarse($usuario->id,$request->convocatoria,$request->etapa);
                $this->actualizarAvance($usuario->id,$request->convocatoria,$request->etapa);
            }

            DB::commit();
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error al registrar el los datos de caracterización empresa, comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
            ->with('error', "Hubo un error al registrar el los datos de caracterización empresa, comuniquese con soporte!!<br>".$e->getMessage())->withInput();;
        
        }

        return redirect()->route('asistencia.caracterizacion_empresarial',[$request->convocatoria,$request->usuario])
            ->with('info', 'Registro exitoso !!');   

    }

    
    /**
     * Valida si el usuario a finalizado de llenar el formulario de caracterización empresarial en la etpa de incubación
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @param  int  $etapa_id
     * @param  int  $asistencia_id
     * @return boolean
     */

    public function validarAvanceCaracterizacionIncubacion($user_id,$convocatoria_id,$asistencia_id,$etapa_id){

        //Primero validar si los avances (etapas) anteriores estan completos
        $bandera = true;
        $convocatoria = Convocatoria::find($convocatoria_id);
        //$etapa = Etapa::where('nombre','SENSIBILIZACIÓN')->first();
        $etapa = Etapa::find($etapa_id);

        if($etapa->nombre == "INCUBACIÓN (ASESORIAS)"){

            $registrados_sincaracterizacion = $convocatoria->registrados()->wherePivot('etapa_id', $etapa->id)->wherePivot('caracterizacion', false)->get();            
        
            if(count($registrados_sincaracterizacion->where('id',$user_id)) > 0){

                $asistencia = Asistencia::find($asistencia_id);
                $asistencia->asistencia = false;
                $asistencia->user_updated_at =\Auth::user()->id;
                $asistencia->save();
                
                $bandera = false;           
            }        

        }        

        return $bandera;

    }

    /**
     * Genera el listado de asistencia, según el cronograma y la convocatoria
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *          JSON message <text> 
     *               type <text>
     */
    public function generarAsistencia(Request $request){

        try {
            $etapa = null;

            DB::transaction(function () use ($request, &$etapa) {
                $convocatoria = DB::table('convocatorias')->where('id',$request->convocatoria)->first();
                if($convocatoria === null){
                    throw new \Exception('La convocatoria no existe.');
                }

                $cronograma = DB::table('cronogramas')
                    ->where('id',$request->cronograma)
                    ->where('convocatoria_id',$convocatoria->id)
                    ->first();
                if($cronograma === null){
                    throw new \Exception('El cronograma no existe para esta convocatoria.');
                }

                $actividad = DB::table('actividades')->where('id',$request->actividad)->first();
                if($actividad === null){
                    throw new \Exception('La actividad no existe.');
                }

                $etapa = DB::table('convocatoria_etapa')
                    ->join('etapas', 'etapas.id', '=', 'convocatoria_etapa.etapa_id')
                    ->where('convocatoria_etapa.convocatoria_id',$convocatoria->id)
                    ->where('convocatoria_etapa.etapa_id',$request->etapa)
                    ->select('etapas.id','etapas.nombre','convocatoria_etapa.posicion')
                    ->first();
                if($etapa === null){
                    throw new \Exception('La etapa no esta asociada a esta convocatoria.');
                }

                if((int) $cronograma->etapa_id !== (int) $etapa->id || (int) $cronograma->actividad_id !== (int) $actividad->id){
                    throw new \Exception('El cronograma no corresponde a la etapa o actividad seleccionada.');
                }

                $registrados = DB::table('convocatoria_etapa_user')
                    ->where('convocatoria_id',$convocatoria->id)
                    ->where('etapa_id',$etapa->id)
                    ->select('user_id','emprendimiento')
                    ->distinct()
                    ->get();

                if(count($registrados) === 0){
                    throw new \Exception('No hay usuarios registrados en esta etapa de la convocatoria.');
                }

                $etapaAnteriorId = null;
                if($etapa->posicion > 1){
                    $etapaAnterior = DB::table('convocatoria_etapa')
                        ->where('convocatoria_id',$convocatoria->id)
                        ->where('posicion',$etapa->posicion - 1)
                        ->first();
                    if($etapaAnterior === null){
                        throw new \Exception('No se encontro la etapa anterior de la convocatoria.');
                    }
                    $etapaAnteriorId = $etapaAnterior->etapa_id;
                }

                foreach($registrados as $registrado){
                    if($etapaAnteriorId !== null){
                        $usuarioValido = DB::table('convocatoria_etapa_user')
                            ->where('convocatoria_id',$convocatoria->id)
                            ->where('etapa_id',$etapaAnteriorId)
                            ->where('user_id',$registrado->user_id)
                            ->where('finalizado',true)
                            ->exists();

                        if(! $usuarioValido){
                            continue;
                        }
                    }

                    $emprendimiento = null;
                    if($registrado->emprendimiento !== null && (int) $registrado->emprendimiento > 0){
                        $emprendimientoExiste = DB::table('emprendimientos')->where('id',$registrado->emprendimiento)->exists();
                        $emprendimiento = $emprendimientoExiste ? $registrado->emprendimiento : null;
                    }

                    $asistencia = DB::table('asistencia')
                        ->where('cronograma_id',$cronograma->id)
                        ->where('user_id',$registrado->user_id)
                        ->first();

                    $datosAsistencia = [
                        'cronograma_id' => $cronograma->id,
                        'user_id' => $registrado->user_id,
                        'asistencia' => false,
                        'emprendimiento_id' => $emprendimiento,
                        'user_created_at' => \Auth::user()->id,
                        'user_updated_at' => \Auth::user()->id,
                        'updated_at' => now(),
                    ];

                    if($asistencia === null){
                        $datosAsistencia['created_at'] = now();
                        DB::table('asistencia')->insert($datosAsistencia);
                    }else{
                        unset($datosAsistencia['user_created_at']);
                        DB::table('asistencia')->where('id',$asistencia->id)->update($datosAsistencia);
                    }
                }
            });

            return response()->json([
                'message' => 'El listado de asistencia se creo con exito !',
                'etapa' => ($etapa !== null) ? $etapa->nombre : null,
                'type' => 'info',
            ]);

        } catch (\Throwable $e) {
            \Log::error('Error generando asistencia', [
                'convocatoria' => $request->convocatoria,
                'etapa' => $request->etapa,
                'actividad' => $request->actividad,
                'cronograma' => $request->cronograma,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => "Hubo un error en registrar asistencia comuniquese con soporte!!<br>".$e->getMessage(),
                'etapa' => null,
                'type' => 'error',
            ]);
        }

    }
    
    /**
     * Asigna el asesor en la asistencia, por motivo  
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *          JSON message <text> 
     *               type <text>
     */
    public function ajaxSetAsesor(Request $request){

        $mensaje="";
        DB::beginTransaction();
        try {

            $asistencia = Asistencia::find($request->asistencia);
            $asistencia->asesor = $request->asesor;
            $asistencia->save();

            $user = User::find($request->asesor);

              DB::commit();

        }catch (\Exception $e) {
            $mensaje = "Hubo un error en registrar asistencia comuniquese con soporte!!<br>".$e->getMessage();
        } catch (\Throwable $e) {
            $mensaje = "Hubo un error en registrar asistencia comuniquese con soporte!!<br>".$e->getMessage();
        }

        if($mensaje != ""){
            $type = "error";
        }else{
            $mensaje = "Se registro el asesor con exito !";
            $type = "info";
        }
        
        return response()->json([
            'message' => $mensaje,
            'type' => $type,
            'asesor' => $user->name,
        ]);

    }
}
