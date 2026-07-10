<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\LinkRegistroRequest;
use App\Http\Requests\CrearConvocatoriaRequest;
use App\Http\Requests\UpdateConvocatoriaRequest;
use App\Http\Requests\ImportRegistroMasivoRequest;

//Models
use App\Convocatoria;
use App\Cronograma;
use App\Emprendimiento;
use App\Etapa;
use App\Asistencia;
use App\User;
use App\Rol;
use App\Departamento;
use App\Ciudad;
use App\UserInfo;
use App\File;
use App\Actividad;

//Query
use DB;

//Import
use App\Imports\RegistroMasivoConvocatoriaImport;

//Notificaciones
use App\Notifications\Novedades;

//Emails
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNovedades;

/**
 * Gestion Convocatorias 
 * 
 * Clase que se encarga de manipular la información de la convocatoria y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Convocatorias
 */

class ConvocatoriaController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Convocatorias'])->only(['index']);
        $this->middleware(['permission:Crear Convocatoria'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Convocatoria'])->only(['edit','update']);
        $this->middleware(['permission:Detalle Convocatoria'])->only(['show']);
        $this->middleware(['permission:Registrarse en la convocatoria'])->only(['registrarse','checkin']);
        $this->middleware(['permission:Avance convocatoria'])->only(['avance']);
        $this->middleware(['permission:Registro masivo convocatoria'])->only(['registroMasivo','importRegistro']);
        $this->middleware(['permission:Reporte Convocatoria'])->only(['reporte']);
        //$this->middleware(['permission:Link registro publico'])->only(['linkPublicoRegistro']);
    }

    /**
     * Muestra una lista de las convocatorias.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias = Convocatoria::all();
        return view('emprendimiento.convocatorias.index',['convocatorias'=>$convocatorias]);
    }

    /**
     * Muestra el formulario para crear un nueva convocatoria.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etapas = Etapa::where('state',true)->get();
        return view('emprendimiento.convocatorias.create',['etapas'=>$etapas]);
    }

    /**
     * Almacena una convocatoria recién creada en el almacenamiento, tambien asigna las etapas y el orden en que van a estar las etapas en pivote convocatoria etapa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearConvocatoriaRequest $request)
    {
        $convocatoria = new Convocatoria;
        $convocatoria->nombre = $request->nombre;
        $convocatoria->descripcion = $request->descripcion;
        $convocatoria->fecha_inicio = $request->fecha_inicio;
        $convocatoria->fecha_fin = $request->fecha_fin;
        $convocatoria->estado = $request->estado;
        $convocatoria->user_created_at = \Auth::user()->id;
        $convocatoria->save();

        $posicion = 1;
        $sync_data_assig = [];

        foreach($request->etapas as $etapa){
            $sync_data_assig[$etapa] = ['posicion' =>  $posicion];            
            $posicion++;

            $actividades = Etapa::find($etapa)->actividades->where('personalizacion',true);

            foreach($actividades as $actividad){
                $cronograma = new Cronograma(); 
                $cronograma->convocatoria_id = $convocatoria->id;
                $cronograma->actividad_id = $actividad->id;
                $cronograma->etapa_id = $actividad->etapa->id;
                $cronograma->user_created_at = \Auth::user()->id;
                $cronograma->save();
            }
        }

        $convocatoria->etapas()->attach($sync_data_assig );

        return redirect()->route('convocatorias.index')->with('info','La convocatoria fue registrada con éxito');
    }

    /**
     * Muestra la convocatoria especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convocatoria = Convocatoria::find($id);
        return view('emprendimiento.convocatorias.show',[
                        'convocatoria'=>$convocatoria, 
                        'disabled' => 'disabled'
                    ]);
    }

     /**
     * Muestra el formulario para editar la convocatoria especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convocatoria = Convocatoria::find($id);
        return view('emprendimiento.convocatorias.show',['convocatoria'=>$convocatoria]);
    }

    /**
     * Actualiza la convocatoria especificada en el almacenamiento y el orden en el que se van a cursar la etapas.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConvocatoriaRequest $request, $id)
    {
        $convocatoria = Convocatoria::find($id);
        $convocatoria->nombre = $request->nombre;
        $convocatoria->fecha_inicio = $request->fecha_inicio;
        $convocatoria->fecha_fin = $request->fecha_fin;
        $convocatoria->descripcion = $request->descripcion;
        $convocatoria->estado = $request->estado;
        $convocatoria->user_updated_at = \Auth::user()->id;
        $convocatoria->save();
        
        if((!isset($convocatoria->cronogramas) || count($convocatoria->cronogramas) == 0)){
            $convocatoria->etapas()->detach();
            $posicion = 1;
            $sync_data_assig = [];
            foreach($request->etapas as $etapa){
                $sync_data_assig[$etapa] = ['posicion' =>  $posicion];            
                $posicion++;
            }
    
            $convocatoria->etapas()->attach($sync_data_assig );
        }
       
        
        return redirect()->route('convocatorias.index')->with('info','La convocatoria fue actualizada con éxito');
        
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
     * Muestra el formulario para registrarse en la convocatoria especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registrarse($id)
    {
        $convocatoria = Convocatoria::find($id);

        $registros = \Auth::user()->convocatorias->where('id',$id);
        
        $emprendimientos = \Auth::user()->emprendimientos;
        $checkin_on = true;
        $convocatoria_etapas = $convocatoria->etapas;
        $mensajes = array();
        foreach($convocatoria_etapas as $etapa){

            $actividades = $etapa->actividades->toArray();
            if(count($actividades) <= 0){
                $mensajes[]= "La etapa ".$etapa->nombre." de esta convocatoria no tiene actividades registradas.\n";
            }else{
                $actividad_id = array_column($actividades,'id');
                $cronogramas = Cronograma::select("*")->where('convocatoria_id',$id)->whereIn('actividad_id',$actividad_id)->get();
                
                if(count($cronogramas) <= 0){
                    $mensajes[]= "Las actividades de la etapa ".$etapa->nombre." de esta convocatoria no tiene cronogramas registrados.\n";
                }
            }         
            
        }
        //session()->flush();

        /*if(count($emprendimientos) <= 0){
            $mensajes[]= 'Para registrarse a una convocatoria debe tener al menos un empredimiento registrado. \n';            
        }*/

        if(count($registros) > 0){
            $mensajes[]= 'El usuario ya se encuentra registrado en la convocatoria '.$convocatoria->nombre.'.\n';
        }

        if($convocatoria->getOriginal('estado') != 1){
            $mensajes[]= 'No se puede registrar, la convocatoria '.$convocatoria->nombre.' se encuentra en estado '.$convocatoria->estado.'.\n';
        }

        if(count($mensajes) > 0){
            $checkin_on = false;            
        }

        return view('emprendimiento.convocatorias.checkin',[
            'convocatoria'=>$convocatoria,
            'emprendimientos'=>$emprendimientos,
            'checkin_on'=>$checkin_on,
            'errors_detail' => $mensajes
        ]);
       
    }

    /**
     * Registra el usuario en sesión a la convocatoria especificada en la primera etapa, llenando el pivote convocatoria_etapa_user, 
     * tambien se crea el regsitro de asistencia de las diferentes actividades que se encuentran programdas en la etapa, 
     * tambien se envia una notificacion en el sistema y se envia un email solicitando completar el formulario de caracterización de emprendimiento y demas información.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request){
        
        $convocatoria = Convocatoria::find($request->convocatoria_id);
        if($convocatoria == null){
            return back()
                ->with('error', 'La convocatoria seleccionada no existe.')->withInput();
        }

        $etapas = $convocatoria->etapas;
        $emprendimiento = (isset($request->emprendimiento))?  $request->emprendimiento : null;
        $sync_data_assig = [];
        $arrayid_actividades = [];
        foreach($etapas as $etapa){
            $sync_data_assig[$etapa->id] = [
                                        'emprendimiento' => $emprendimiento,
                                        'finalizado' => false,
                                        'user_id' => \Auth::user()->id,
                                        ];

            $arrayid_actividades = array_column($etapa->actividades->toArray(),'id');
                                        
            break;             
        }

        //Regsitro de asistencia de la actividade de la primera etapa de la convocatoria
        $cronogramas =  $convocatoria->cronogramas->whereIn('actividad_id',$arrayid_actividades);
        $cronograma_notificacion = $cronogramas->first();

        if($cronograma_notificacion == null){
            return back()
                ->with('error', 'La convocatoria no tiene cronogramas registrados para la primera etapa.')->withInput();
        }

        $convocatoria->etapaAvance()->attach($sync_data_assig);

        foreach($cronogramas as $cronograma){


            $asistencia = Asistencia::where('cronograma_id',$cronograma->id)->where('user_id',\Auth::user()->id)->first();
            if($asistencia == null){
                $asistencia = new Asistencia();
            } 

            $asistencia->cronograma_id = $cronograma->id;
            $asistencia->user_id = \Auth::user()->id;
            $asistencia->asistencia = false;
            $asistencia->emprendimiento_id = $emprendimiento;
            $asistencia->user_created_at =\Auth::user()->id;
            $asistencia->user_updated_at = \Auth::user()->id;
            $asistencia->save();

        }
        
        //Se genera notificación para que el usuario llene el formulario de caracterizacion emprendimiento en la etapa de sensibilización prerequisito para seguir
        $return_noty = $this->envioNotificacion(\Auth::user(),$convocatoria,$cronograma_notificacion);

        if($return_noty['type'] == "error"){
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$return_noty['mensaje'])->withInput();
        }else{
            return redirect()->route('convocatorias.index')->with('info','El registro fue con éxito');
        }        
        
    }

    /**
     * Muestra el avance por etapa de cada inscripto en la convocatoria especificada, en una lista desplegable junto con opciones de gestiones.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function avance($id){
        $convocatoria = Convocatoria::find($id);
        return view('emprendimiento.convocatorias.avance',['convocatoria'=>$convocatoria]);
    }

    /**
     * Muestra el formulario para hacer un registro masivo de inscriptos por medio de cargue de una archivo excel en la convocatoria especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registroMasivo($id){
        $convocatoria = Convocatoria::find($id);
        return view('emprendimiento.convocatorias.import',['convocatoria'=>$convocatoria]);

    }

    /**
     * Registra todos los usuarios que se encuentra en el excel a la convocatoria especificada, 
     * creando o actualizando el usuario, información detalle e emprendimiento detallado, 
     * tambien envia notificaciones para llenar el formulario de caracterización de empredimiento y detallado usuario
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  App\Http\Requests\ImportRegistroMasivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function importRegistro(ImportRegistroMasivoRequest $request){
        
        if($request->hasFile('list'))
        { 
            DB::beginTransaction();
            try {
                $import = new RegistroMasivoConvocatoriaImport($request->convocatoria_id);
                $import->import(request()->file('list'));
            }catch (\Exception $e) {
                return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
                return back()
                    ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
            }

            return redirect()->route('convocatorias.index')
                ->with('info', 'Listado de usuarios importados correctamente');                
        }else{
            return back()
                ->with('error', "Debe subir un archivo para el regsitro masivo");

        }        
    }

     /**
     * Permite descargar formato de registro masivo para realizar 
     * inscripciones de forma masiva en una convocatoria especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function downloadFileImport(){

         //PDF file is stored under project/public/download/formatoImport.xlsx
         $file= public_path(). "/download/FORMATO_REGISTRO_MASIVO.xlsx";
         $headers = ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']; 
         return response()->download($file, 'FORMATO_REGISTRO_MASIVO.xlsx', $headers);
    }

     /**
     * Asigna un emprendimiento asociado a la convocatoria según el inscripto.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON type<text>  message_response<text>  request<collection>
     */
    public function ajaxSetEmprendimiento(Request $request){

        try{

            $type = "info";
            
            $convocatoria = Convocatoria::find($request->convocatoria_id);
            $user = User::find($request->user_id);
            $etapas_convo = $convocatoria->etapaAvance()->wherePivot('user_id', $user->id)->get();

            if(count($etapas_convo) > 0){
                foreach($etapas_convo as $etapa){
                    $sync_data_assig[$etapa->pivot->convocatoria_id] = [
                        'emprendimiento' => $request->emprendimiento_id,
                        'finalizado' => $etapa->pivot->finalizado,
                        'etapa_id' =>  $etapa->pivot->etapa_id,
                    ];

                    $user->avanceConvocatoriaEtapa($etapa->id,$convocatoria->id)->sync($sync_data_assig);
                }
            }

            $mensaje_response = "Se regsitro con exito el emprendimiento!!";

        }catch(\Exception $e){
            $type = "error";
            $mensaje_response = "Comuniquese con soporte !";
        }catch(\Throwable $e){
            $type = "error";
            $mensaje_response = "Comuniquese con soporte !";
        }

        return response()->json([
            'type'=> $type,
            'mensaje_response'=> $mensaje_response,
            'request'=> $request->all()
        ]);

    }

    /**
     * Muestra la hoja de vida del usuario según la convocatoria, se lista toda la ifnormación del usuario generada dentro de la convocatoria, 
     * como documentación y novedades presentadas.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user_id
     * @param  int  $convocatoria_id
     * @return \Illuminate\Http\Response
     */
    public function hojaVida($user_id,$convocatoria_id,$etapa_id){

        $user = User::find($user_id);
        $convocatoria = Convocatoria::find($convocatoria_id);
        $roles = Rol::all();
        $emprendimiento_id = $convocatoria->etapaAvance()->wherePivot('user_id',$user->id)->get()[0]->pivot->emprendimiento;
        if($emprendimiento_id != null || $emprendimiento_id != ""){
            $emprendimiento = Emprendimiento::find($emprendimiento_id);
        }else{
            $emprendimiento = null;
        }  
        
        $etapa = Etapa::find($etapa_id);
        
        $actividades_array = Actividad::where('etapa_id',$etapa_id)->get()->toArray();
       
        $actividades = array_column($actividades_array,'id');

        $notifications = $user->notifications;
        $novedades = array();
        $cronogramas = Cronograma::select("id")->where('convocatoria_id',$convocatoria_id)->whereIn('actividad_id',$actividades)->get()->toArray();
        
        $files = File::where('user_id',$user_id)->whereIn('cronograma_id',$cronogramas)->get();      

        if(count($cronogramas) > 0){
            $cronogramas = array_column($cronogramas,'id');
            foreach($notifications as $noti){

                if((in_array((int)$noti->data["alert"]["cronograma_id"], $cronogramas)) && ($noti->data["alert"]["type"] == "Novedades Convocatoria Cronograma")){
                    $novedades[] = $noti->data["alert"];
                }
            }

        }
       
        return view('emprendimiento.convocatorias.hoja_vida',[
                    'convocatoria'=>$convocatoria,
                    'usuario'=>$user,
                    'roles'=>$roles,
                    'emprendimiento'=>$emprendimiento,
                    'novedades' => $novedades,
                    'etapa' => $etapa,
                    'files' => $files
                    ]);

    }

    /**
     * Muestra el formulario que permite realizara un registro publico en la convocatoria indicada
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function linkPublicoRegistro($convocatoria_id){
        
        $convocatoria = Convocatoria::find($convocatoria_id);
        $departamentos = Departamento::all();
        $mensajes=array();
        $checkin_on = true;
        
        if($convocatoria->getOriginal('estado') != 1){
            $mensajes[]= 'No se puede registrar, la convocatoria '.$convocatoria->nombre.' se encuentra en estado '.$convocatoria->estado.'.\n';
        }

        if(count($mensajes) > 0){
            $checkin_on = false;            
        }

        return view('emprendimiento.convocatorias.link',[
                    'convocatoria'=>$convocatoria,
                    'departamentos' => $departamentos,
                    'checkin_on'=>$checkin_on,
                    'errors_detail' => $mensajes
                    ]);
    }

    /**
     * Registra el usuario en sesión a la convocatoria especificada en la primera etapa, llenando el pivote convocatoria_etapa_user, 
     * tambien se crea el regsitro de asistencia de las diferentes actividades que se encuentran programdas en la etapa, 
     * tambien se envia una notificacion en el sistema y se envia un email solicitando completar el formulario de caracterización de emprendimiento y demas información.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\LinkRegistroRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accionLinkPublicoRegistro(LinkRegistroRequest $request){
        //dd($request->all());

        DB::beginTransaction();
        try {

            $user = User::where('email',$request->email)->first();
            $convocatoria = Convocatoria::find($request->convocatoria_id);
            
            if($user == null){
                //Registrar el usuario
                $user = new User;
                $user->name = $request->first_name." ".$request->last_name;
                $user->email = $request->email;
                $user->state = true;
                $user->password = bcrypt($request->password);
                $user->email_verified_at = now();
                //$user->user_created_at = \Auth::user()->id;
                $user->save();

                $user->assignRole('General');
            }           

            $emprendimiento = $this->registroUserInfo($user,$request->all());

            //Validar si el usuario ya esta registrado en la convocatoria
            $registros = $user->convocatorias->where('id',$request->convocatoria_id);
            if(count($registros) == 0 || $registros == null){
                //Registro del usuario en la convocatoria
                $this->registroConvocatoria($user,$emprendimiento,$request->convocatoria_id);

                //Se genera notificación para que el usuario llene el formulario de caracterizacion emprendimiento en la etapa de sensibilización prerequisito para seguir
                $etapa = Etapa::where('nombre','SENSIBILIZACIÓN')->first();
                if($etapa == null){
                    throw new \Exception('No existe la etapa SENSIBILIZACIÓN.');
                }

                $actividades = $etapa->actividades;
                if(count($actividades) == 0){
                    throw new \Exception('La etapa SENSIBILIZACIÓN no tiene actividades registradas.');
                }

                $cronograma = Cronograma::where('convocatoria_id',$convocatoria->id)->where('actividad_id',$actividades[0]->id)->first();
                if($cronograma == null){
                    throw new \Exception('La convocatoria no tiene cronograma registrado para la primera actividad de sensibilización.');
                }

                $return_noty = $this->envioNotificacion($user,$convocatoria,$cronograma);

                if($return_noty['type'] == "error"){
                    return back()
                    ->with('error', "Hubo un error comuniquese con soporte!!<br>".$return_noty['mensaje'])->withInput();
                }
                
            }

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('convocatoria.linkPublicoRegistro',$request->convocatoria_id)
            ->with('info', 'Registro exitoso !!');   
    }

    /**
     * Realiza el registro de la información detalle del usuario y ademas registra el emprendimiento, 
     * función que se utiliza solo cuando se hace registro masivo
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  collection $user
     * @param  array  $row
     * @return collection<Emprendimiento> || null
     */
    public function registroUserInfo($user,$row){
        
        $adicional = array();
        //Registro de información adicional
        $adicional = [
            'ciudad_de_residencia' => $row["departamento"]." ".$row["ciudad"],
            'estamento' => $row["estamento"],
            'programa_academico_al_que_perteneces_o_tu_perfil_profesional' => $row["perfil_profesional"],            
            'en_que_area_te_gustaria_recibir_capacitacion_para_fortalecer_tu_proyecto' => $row["pregunta_1"],
            'en_que_jornada_te_gustaria_recibir_la_capacitacion' => $row["jornada"],
            'sabes_para_que_es_la_unidad_de_emprendimiento' => $row["pregunta_2"],
            'describenos_tu_idea_de_emprendimiento' => $row["pregunta_3"],
            'describenos_tu_idea_o_modelo_de_negocio_clientes_producto_o_serviciopropuesta_de_valor' => $row["pregunta_4"],
            'en_que_nivel_esta_tu_proyecto_de_emprendedor' => $row["pregunta_5"],
        ];

        if(isset($user->userInfo)){                    
            $user_info_updated = UserInfo::find($user->userInfo->id);
            $user_info_updated->encuesta = json_encode($adicional,JSON_UNESCAPED_UNICODE);                  

            $telefonos = array();
            if($user->userInfo->telefonos != "" || $user->userInfo->telefonos != null){
                $telefonos = json_decode($user->userInfo->telefonos);                        
            }                    
            foreach(explode(",", $row["phone"]) as $num){
                array_push($telefonos,  $num);
            }
            $user_info_updated->telefonos = json_encode($telefonos);
            $user_info_updated->save();
        }else{                
            $user_info_created = new UserInfo();
            $user_info_created->encuesta = json_encode($adicional,JSON_UNESCAPED_UNICODE);
            $user_info_created->user_id = $user->id;
            $user_info_created->telefonos = json_encode(explode(",", $row["phone"]));
            $user_info_created->save();
        } 
        
        if($row["pregunta_3"] != "" || $row["pregunta_3"] != null){
            $emprendimiento = new Emprendimiento();
            $emprendimiento->user_id = $user->id;
            $emprendimiento->nombre = $row["pregunta_3"];
            $emprendimiento->descripcion = $row["pregunta_3"];
            //$emprendimiento->modelo_negocio = $row["pregunta_4"];
            $emprendimiento->save();

            return $emprendimiento;
        }else{
            return null;
        }
        
    }

    /**
     * Realiza el registro del usuario en la convocatoria 
     * y genera los regisstros de asistencia de los cronogrmas programados de la primera etapa de la convocatoria,
     * esta función solo se utiliza en registro masivo
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  collection $user
     * @param  collection  $emprendimientoObjec
     * @param  int  $convocatoria_id
     * @return void
     */
    public function registroConvocatoria($user,$emprendimientoObjec,$convocatoria_id){
        $convocatoria = Convocatoria::find($convocatoria_id);
      
        $etapas = $convocatoria->etapas;
        $emprendimiento = ($emprendimientoObjec != null)? $emprendimientoObjec->id : null;
        $sync_data_assig = [];
        $arrayid_actividades = [];
        
        foreach($etapas as $etapa){
            $sync_data_assig[$etapa->id] = [
                                        'emprendimiento' => $emprendimiento,
                                        'finalizado' => false,
                                        'user_id' => $user->id,
                                        ];

            $arrayid_actividades = array_column($etapa->actividades->toArray(),'id');
                                        
            break;             
        }

        $convocatoria->etapaAvance()->attach($sync_data_assig);

        //Regsitro de asistencia de la actividades de la primera etapa de la convocatoria
        $cronogramas =  $convocatoria->cronogramas->whereIn('actividad_id',$arrayid_actividades);

        foreach($cronogramas as $cronograma){

            $asistencia = Asistencia::where('cronograma_id',$cronograma->id)->where('user_id',$user->id)->first();
            if($asistencia == null){
                $asistencia = new Asistencia();
            }

            $asistencia->cronograma_id = $cronograma->id;
            $asistencia->user_id = $user->id;
            $asistencia->asistencia = false;
            $asistencia->emprendimiento_id = $emprendimiento;
            //$asistencia->user_created_at =\Auth::user()->id;
            //$asistencia->user_updated_at = \Auth::user()->id;
            $asistencia->save();

        }
        
    }

    /**
     * Realiza el envío de la notificación por plataforma email para solicitar el llenado del formulario de caracterización
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  collection $user
     * @param  collection  $emprendimientoObjec
     * @param  int  $convocatoria_id
     * @return void
     */
    public function envioNotificacion($user,$convocatoria,$cronograma){
         
         $collection = collect([
            "type"=>"Novedades Registro Convocatoria",
            "convocatoria"=> $convocatoria->nombre,
            "convocatoria_id"=> $convocatoria->id,
            "etapa"=> $cronograma->actividad->etapa->nombre,
            "actividad"=>$cronograma->actividad->nombre,
            "cronograma_id"=>$cronograma->id,            
            "cronograma"=>$cronograma->fecha_hora_inicio." ".$cronograma->fecha_hora_fin,            
            "usuario_id" => $user->id,
            "de" => 'SIPU',
            "para" => $user->name,
            "para_email" => $user->email,
            "url"=> 'asistencia.caracterizacion_sensibilizacion',
            "message"=>'Haga click aquí, para llenar el formulario de caracterización del emprendimiento para pasar a la siguiente etapa!',
        ]);

        //Envio a varios usuarios
        //if(\Notification::send(\Auth::user(),new Novedades($collection))){
        if($user->notify(new Novedades($collection))){
            $type = "error";
            $mensaje_response = "Comuniquese con soporte!! Error al enviar la notificación";
        }else{
            $type = "info";
            $mensaje_response = "La novedad fue enviada con exito !!";
            //Envio de correo cuando se genera una notificación
            Mail::to($collection["para_email"])->send(new EmailNovedades($collection));
        }

        return [
            'type' => $type,
            'mensaje' => $mensaje_response,
        ];
    }

     /**
     * Muestra el reporte generado por etapa registrados vs cantidad de usuarios que finalizaron en cada etapa
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $convocatoria_id
     * @return \Illuminate\Http\Response
     */
    public function reporte($id){

        $convocatoria = Convocatoria::find($id);
        $labels=array_merge(['REGISTRADOS'],array_column($convocatoria->etapas->toArray(),"nombre"));
        $datos = [count($convocatoria->registrados)];
        $finalizadosxetapas=array_fill_keys(array_column($convocatoria->etapas->toArray(),"nombre"),0);

        foreach($convocatoria->registrados as $registrado){

            foreach($convocatoria->etapas as $etapa){
                if(count($etapa->convocatoriaAvance()->wherePivot('convocatoria_id',$convocatoria->id)->wherePivot('user_id', $registrado->id)->wherePivot('finalizado', true)->get()) > 0){
                    $finalizadosxetapas[$etapa->nombre]+=1;
                }
            }
        }
        $datos = array_merge($datos,array_values($finalizadosxetapas));

        return view('reportes.etavsreg',["datos"=>json_encode(['labels'=>$labels,'datos'=>$datos]),"convocatoria"=>$convocatoria]);
    }
}
