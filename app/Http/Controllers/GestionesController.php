<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;

//Models
use App\User;
use App\File;
use App\Cronograma;
use App\Convocatoria;

//Query
use DB;

//Mails
use App\Mail\EmailNovedades;
use Illuminate\Support\Facades\Mail;

//Novedades
use App\Notifications\Novedades;

//Storage
use Illuminate\Support\Facades\Storage;


/**
 * Gestión Gestiones 
 * 
 * Clase que se encarga recrear varias gestiónes dadas dentro de la convocatoria, relacionada con los inscriptos.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Gestiones
 */

class GestionesController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */
    public function __construct()
    {        
        $this->middleware(['permission:Novedades'])->only(['novedades','setAjaxNovedad']);
        $this->middleware(['permission:Documentacion'])->only(['documentacion']);
    }

    /**
     * Muestra una lista de las convocatorias que se encuentran hablitadas con la opción para generar novedades,
     * se lista según el rol del usario en sesión.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias = [];

        if(\Auth::user()->hasRole('Administrador') || \Auth::user()->hasRole('Coordinador de emprendimiento')){
            $convocatorias = Convocatoria::all();
        }else{
            if(\Auth::user()->hasRole('Asesor')){
                $convocatorias_id = Cronograma::select('convocatoria_id')->where('asesor_id',\Auth::user()->id)->get()->unique('convocatoria_id')->toArray();
                $ids = array_column($convocatorias_id,'convocatoria_id');
                $convocatorias = Convocatoria::select("*")->whereIn('id',$ids)->get();            
            }else{                
                if(\Auth::user()->hasRole('General')){
                    $convocatorias = \Auth::user()->convocatorias->unique('id');            
                }
            }
        }


        

        return view('emprendimiento.gestiones.index',['convocatorias'=>$convocatorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Muestra el detalle de la convocatoria y todo su despliegue por etapas, con las opciones novedades por cronograma
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function tramites($id){
        $convocatoria =  Convocatoria::find($id);        
        return view('emprendimiento.gestiones.tramites',['convocatoria'=>$convocatoria]);
    }

    /**
     * Muestra las novedades generadas por cada incripto seleccionado y muestra el formulario para registrar mas novedades
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function novedades($cronograma,$inscripto = null){
        
        $cronograma = Cronograma::find($cronograma);
        $convocatoria = Convocatoria::find($cronograma->convocatoria_id);
        
        return view('emprendimiento.gestiones.novedades',[
                    'cronograma'=>$cronograma,
                    'convocatoria'=>$convocatoria, 
                    'inscripto'=>$inscripto, 
        ]);
    }

    /**
     * Lista todas las novedades del inscripto en un formato html y el emprendimiento que tiene asociado el usario a la convocatoria
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          JSON html <html>
     *                          emprendimiento <Collection>
     *                          avance <Collection>
     */
    public function getAjaxNovedad(Request $request){
        
        $user = User::find($request->inscripto);
        $cronograma = Cronograma::find($request->cronograma_id);
        $convocatoria = $cronograma->convocatoria;
        $avance = $convocatoria->etapaAvance()->wherePivot('user_id', $user->id)->get();
        
        if(count($avance) > 0){
            $emprendimiento = $avance[0]->pivot->emprendimiento;
        }else{
            $emprendimiento = null;
        }        

        $html = $this->getNovedades($user->id,$cronograma->id);
       
        $emprendimientos = $this->getEmprendimientos($user->id,$emprendimiento);

       return response()->json([
            'html'=> $html,
            'emprendimientos'=> $emprendimientos,
            'avance'=> $avance
        ]);

    }

    /**
     * Genera una novedad al inscripto enviando una notificación y un email
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          JSON type <text>
     *                          mensaje_response <text>
     *                          html <html>
     *                          response <Collection - $request>
     */

    public function setAjaxNovedad(Request $request){
        
        $mensaje_response = "";
        $type = "info";
        $emprendimiento = $request->emprendimiento;

        $cronograma  = Cronograma::find($request->cronograma_id);

        $para =  User::role('Coordinador de emprendimiento')->get();
        $para->push($cronograma->asesor);
        $para->push(User::find($request->inscripto));
        $para_name = implode(";",array_column($para->toArray(),"name"));
        $para_email = array_column($para->toArray(),"email");
        $cronograma = Cronograma::find($request->cronograma_id);

        $collection = collect([
            "type"=>"Novedades Convocatoria Cronograma",
            "inscripto"=>$request->inscripto,
            "etapa"=>$cronograma->actividad->etapa->nombre,
            "actividad"=>$cronograma->actividad->nombre,
            "cronograma_id"=>$cronograma->id,
            "cronograma"=>$cronograma->fecha_hora_inicio." ".$cronograma->fecha_hora_fin,
            "convocatoria" => $cronograma->convocatoria->nombre,
            "actividad" => $cronograma->actividad->nombre,
            "de" => \Auth::user()->name,
            "para" => $para_name,
            "para_email" => $para_email,
            "message"=>$request->novedad,
        ]);

        //Envio a varios usuarios
        if(\Notification::send($para,new Novedades($collection))){
            $type = "error";
            $mensaje_response = "Comuniquese con soporte!! Error al enviar la notificación";
        }else{
            $mensaje_response = "La novedad fue enviada con exito !!";
            //Envio de correo cuando se genera una notificación
            Mail::to($collection["para_email"])->send(new EmailNovedades($collection));
        }

        //Envio notificacion a un solo usuario 
        //$result_notification  = $user->notify(new Novedades($collection));       

        $html = $this->getNovedades($request->inscripto,$cronograma->id);

        //Registro emprendimiento
        if($request->emprendimiento != null){

            $user = User::find($request->inscripto);
            $cronograma = Cronograma::find($request->cronograma_id);
            $convocatoria = $cronograma->convocatoria;
            $etapas_convo = $convocatoria->etapaAvance()->wherePivot('user_id', $user->id)->get();

            if(count($etapas_convo) > 0){
                foreach($etapas_convo as $etapa){
                    DB::table('convocatoria_etapa_user')
                        ->where('user_id',$user->id)
                        ->where('convocatoria_id',$convocatoria->id)
                        ->where('etapa_id',$etapa->id)
                        ->update(['emprendimiento' => $request->emprendimiento]);
                }
            }
            

        }

        return response()->json([
            'type'=> $type,
            'mensaje_response'=> $mensaje_response,
            'html'=> $html,
            'response'=> $request->all(),
        ]);

    }

    
    /**
     * Genera la estructura html de la novedad
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user
     * @param  int  $cronograma
     * @return html
     */
    public function getNovedades($user,$cronograma){

        $user = User::find($user);
        $notifications = $user->notifications;
        $novedades = array();

        foreach($notifications as $noti){

            if(((int)$noti->data["alert"]["cronograma_id"] == $cronograma) && ($noti->data["alert"]["type"] == "Novedades Convocatoria Cronograma")){
                $novedades[] = $noti->data["alert"];
            }
        }

        $html = "";

        foreach($novedades as $novedad){
            $html .= '<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">'.$novedad["type"].'</h5>
                            <p class="card-text">'.$novedad["message"].'</p>
                            <p class="card-text">De: '.$novedad["de"].'</p>
                            <p class="card-text">Para: '.$novedad["para"].'</p>
                        </div>
                    </div>';
        }

        return $html;

    }

    /**
     * Genera la estructura html del listado de emprendimientos que tiene asociado el inscripto
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $user
     * @param  int  $cronograma
     * @return html
     */
    public function getEmprendimientos($user,$emprendimiento_select){
        $user = User::find($user);
        $emprendimientos = $user->emprendimientos;        
        $html = '<option value="">Seleccione un emprendimiento</option>';

        foreach($emprendimientos as $emprendimiento){
            if($emprendimiento_select != null && $emprendimiento_select == $emprendimiento->id ){
                $html.= '<option value="'.$emprendimiento->id.'" selected >'.$emprendimiento->nombre.'</option>';
            }else{
                $html.= '<option value="'.$emprendimiento->id.'">'.$emprendimiento->nombre.'</option>';
            }           
        }

        return $html;
    }

    /**
     * Muestra formulario para subir la información de la documentación según el inscripto dentro la convocatoria y cronograma
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function documentacion($cronograma){

        $cronograma = Cronograma::find($cronograma);
        $convocatoria = Convocatoria::find($cronograma->convocatoria_id);

        return view('emprendimiento.gestiones.documentacion',[
            'cronograma'=>$cronograma,
            'convocatoria'=>$convocatoria,
            'inscripto'=>null, 
        ]);
    }

    
    /**
     * Carga los archivos de los incriptos según la convocatoria y actividad
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          JSON files <Collection $request->files>
     *                          url <text>
     *                          data <Collection $request>
     */
    public function uploadFile(Request $request){

        $request->validate([
            'opciones1' => 'mimes:pdf,xlx,csv|max:2048',
            'opciones2' => 'mimes:pdf,xlx,csv|max:2048',
            'opciones3' => 'mimes:pdf,xlx,csv|max:2048',
        ]);

        $files = File::select("*")->where("user_id",$request->inscripto_id)->where("cronograma_id",$request->cronograma_id)->first();

        if($files == null){
            $files = new File;
        }

        //Insert Images
        if($request->hasFile('opciones1'))
        {
            $file_1 = $request->file('opciones1');

            if($files->file_1 != ""){
                Storage::disk('public')->delete($files->file_1);
            }

            $extension = $file_1->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$file_1->getClientOriginalName());
            $name_file = "file1_".$request->inscripto_id.".".$extension;
            $path = Storage::disk('public')->putFileAs('convocatorias/'.$request->convocatoria_id.'/cronogramas/'.$request->cronograma_id."/inscriptos/".$request->inscripto_id,$file_1,$name_file);            

            $files->file_1 = $path;            
        }

        if($request->hasFile('opciones2'))
        {
            $file_2 = $request->file('opciones2');

            if($files->file_2 != ""){
                Storage::disk('public')->delete($files->file_2);
            }

            $extension = $file_2->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$file_2->getClientOriginalName());
            $name_file = "file2_".$request->inscripto_id.".".$extension;
            $path = Storage::disk('public')->putFileAs('convocatorias/'.$request->convocatoria_id.'/cronogramas/'.$request->cronograma_id."/inscriptos/".$request->inscripto_id,$file_2,$name_file);            

            $files->file_2 = $path;            
        }

        if($request->hasFile('opciones3'))
        {
            $file_3 = $request->file('opciones3');

            if($files->file_3 != ""){
                Storage::disk('public')->delete($files->file_3);
            }

            $extension = $file_3->getClientOriginalExtension();            
            $nombre = str_replace(" ","",$file_3->getClientOriginalName());
            $name_file = "file3_".$request->inscripto_id.".".$extension;
            $path = Storage::disk('public')->putFileAs('convocatorias/'.$request->convocatoria_id.'/cronogramas/'.$request->cronograma_id."/inscriptos/".$request->inscripto_id,$file_3,$name_file);            

            $files->file_3 = $path;            
        }

        if($files->file_1 != "" || $files->file_2 != "" || $files->file_3 != ""){
            $files->cronograma_id = $request->cronograma_id;
            $files->user_id = $request->inscripto_id;
            $files->user_created_at = \Auth::user()->id;
            $files->save();
        }   
  
        return Response()->json([
                "files" =>  $files,
                "url" =>  route('gestiones.downloadFile', $files->id),
                "data" => $request->all(),
        ]);

    }

    /**
     * Descargar los archivos de los incriptos según el archivo la convocatoria y actividad
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          JSON files <Collection $request->files>
     *                          url <text>
     *                          data <Collection $request>
     */
    function downloadFile($file_id,$num){

        $file_object = File::find($file_id);

        if($num == 1){
            $path = $file_object->file_1;
        }

        if($num == 2){
            $path = $file_object->file_2;
        }

        if($num == 3){
            $path = $file_object->file_3;
        }

        $file = public_path()."/storage/".$path;
        //$headers = ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
 
        return response()->download($file);
    }

    /**
     * Devuelve el archivo del inscripto según el archivo  la convocatoria y actividad
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          JSON files <Collection $request->files>
     *                          url <text>
     *                          data <Collection $request>
     */
    function getFileInscripto(Request $request){

        $files = File::where("cronograma_id",$request->cronograma_id)->where("user_id",$request->inscripto)->get();

        $url = "#";
        if(count($files) > 0 ){
            $url = route('gestiones.downloadFile', $files[0]->id);
        }
        return Response()->json([            
                    "files" =>  $files,
                    "url" =>  $url,
                    "data" => $request->all(),
                ]);
    }
}
