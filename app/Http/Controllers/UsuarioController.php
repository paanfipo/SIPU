<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\CrearEmprendimientoRequest;

//Models
use App\User;
use App\Ciudad;
use App\UserInfo;
use App\Emprendimiento;
use Spatie\Permission\Models\Role;
use App\Rol;
use App\Dependencia;
use App\Departamento;
use App\TipoMaestro;
use App\Pais;
use App\Curriculum;

//Query
use DB;

//PDF
//use PDF;

use mikehaertl\pdftk\Pdf;
use setasign\Fpdi\Fpdi;

//Storage
use Illuminate\Support\Facades\Storage;

use Hamcrest\Type\IsObject;

/**
 * Gestion Usuario
 * 
 * Clase que se encarga de manipular la información de los usuarios
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Usuario
 */

class UsuarioController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Usuarios'])->only(['index']);
        $this->middleware(['permission:Crear Usuario'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Usuario'])->only(['edit','update']);
        $this->middleware(['permission:Detalle Usuario'])->only(['show']);
        $this->middleware(['permission:Listar Emprendimiento'])->only(['emprendimientos']);
    }

    /**
     * Muestra una lista de los usuarios.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('basico.usuarios.index',[
            'usuarios'=>$usuarios,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $dependencias = Dependencia::all();
        $departamentos = Departamento::all();
        $items_sexo = TipoMaestro::where('nombre','Sexo')->first()->tiposmaestroitem;
        $items_tipos_documento = TipoMaestro::where('nombre','Documentos')->first()->tiposmaestroitem;
        $ciudades = Ciudad::all();
        $paises = Pais::all();
        $items_estado_civil = TipoMaestro::where('nombre','Estado Civil')->first()->tiposmaestroitem;
        $carreras = Dependencia::where('codigo','>',100)->get();
        $estudiante_rol = Rol::where('name','Estudiante')->first();

        return view('basico.usuarios.create',[
            'roles'=>$roles,
            'dependencias'=>$dependencias,
            'departamentos'=>$departamentos,
            'items_sexo'=>$items_sexo,
            'items_tipos_documento'=>$items_tipos_documento,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'items_estado_civil' => $items_estado_civil,
            'carreras' => $carreras,
            'estudiante_rol' => $estudiante_rol,
        ]);
    }

     /**
     * Almacena un usuario recién creado en el almacenamiento, tambien almacena información adicional y foto de perfil del usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        DB::beginTransaction();

        try{

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->state = ($request->state == 1 ) ? true : false;
            $user->password = bcrypt($request->password);
            $user->user_created_at = \Auth::user()->id;
            $user->save();

            $roles = $request->rol;
        
            if(isset($request->rol_e) & ($request->rol_e != "0") & !(in_array($request->rol_e, $roles)) ){
                array_push($roles, $request->rol_e);
            }

            $user->assignRole($roles);
            
            $userInfo = new UserInfo();
            $userInfo->user_created_at = \Auth::user()->id;
            $userInfo->email_institucional = (isset($request->email_institucional))? $request->email_institucional: null;
            $userInfo->facebook = (isset($request->facebook))? $request->facebook : null;
            $userInfo->instagram = (isset($request->instagram))? $request->instagram : null;
            $userInfo->user_id = $user->id;
            $userInfo->ciudad_id = (isset($request->ciudad_id))? $request->ciudad_id : null;
            $userInfo->direccion = (isset($request->direccion))? $request->direccion : null;
            $userInfo->barrio = (isset($request->barrio))? $request->barrio : null;
            $userInfo->telefonos = (isset($request->phone_numbers) && count($request->phone_numbers) > 0)? json_encode($request->phone_numbers) : null;
            $userInfo->codigo_estudiante = (isset($request->codigo_estudiante)) ? $request->codigo_estudiante : null;
            $userInfo->codigo_carrera = (isset($request->codigo_carrera)) ? $request->codigo_carrera : null;            
            $userInfo->semestre = (isset($request->semestre)) ? $request->semestre : null;            
            $userInfo->dependencia_id = ($request->dependencia_id != "")? $request->dependencia_id: null;
            $userInfo->sexo = ($request->sexo != "")? $request->sexo: null;
            $userInfo->edad = ($request->edad != "")? $request->edad: null;
            $userInfo->estrato = ($request->estrato != "")? $request->estrato: null;
            $userInfo->tipo_documento = ($request->tipo_documento != "")? $request->tipo_documento: null;
            $userInfo->numero_documento = ($request->numero_documento != "")? $request->numero_documento: null;
            $userInfo->fecha_nacimiento = ($request->fecha_nacimiento != "")? $request->fecha_nacimiento: null;
            $userInfo->lugar_nacimiento = ($request->lugar_nacimiento != "")? $request->lugar_nacimiento: null;
            $userInfo->fecha_lugar_expedicion = ($request->fecha_lugar_expedicion != "")? $request->fecha_lugar_expedicion: null;

            if($request->hasFile('foto'))
            {
                $name_photo = "photo_perfil_".$user->id.".jpg";
                $path_photo = 'users/photo/'.$name_photo;

                $file_1 = $request->file('foto');
                if($userInfo->foto != ""){
                    Storage::disk('public/')->delete($userInfo->foto);
                }
                Storage::putFileAs('public/users/photo/', $file_1, $name_photo);
                $userInfo->foto = $path_photo;
            }

            $userInfo->save();                
            
            DB::commit();
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('usuarios.index')->with('info','El usuario fue creado con éxito');
        
    }

    /**
     * Muestra el usuario especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $dependencias = Dependencia::all();
        $departamentos = Departamento::all();
        $items_sexo = TipoMaestro::where('nombre','Sexo')->first()->tiposmaestroitem;
        $items_tipos_documento = TipoMaestro::where('nombre','Documentos')->first()->tiposmaestroitem;
        $ciudades = Ciudad::all();
        $paises = Pais::all();
        $items_estado_civil = TipoMaestro::where('nombre','Estado Civil')->first()->tiposmaestroitem;
        $carreras = Dependencia::where('codigo','>',100)->get();
        $estudiante_rol = Rol::where('name','Estudiante')->first();

        return view('basico.usuarios.show',[
            'roles'=>$roles,
            'dependencias'=>$dependencias,
            'departamentos'=>$departamentos,
            'items_sexo'=>$items_sexo,
            'items_tipos_documento'=>$items_tipos_documento,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'items_estado_civil' => $items_estado_civil,
            'carreras' => $carreras,
            'estudiante_rol' => $estudiante_rol,
            'usuario' => $user,
            'disabled' => 'disabled'
        ]);
    }

   /**
     * Muestra el formulario para editar el usuario especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        if((!\Auth::user()->hasAnyRole(['Administrador','Coordinador proyeccion social','Director de programa'])) && (\Auth::user()->id != $id)){
            return back()
            ->with('error', "Usted no puede editar información de otros usuarios!!<br>")->withInput();            
        }
        
        $user = User::find($id);
        $roles = Role::all();
        $dependencias = Dependencia::all();
        $departamentos = Departamento::all();
        $items_sexo = TipoMaestro::where('nombre','Sexo')->first()->tiposmaestroitem;
        $items_tipos_documento = TipoMaestro::where('nombre','Documentos')->first()->tiposmaestroitem;
        $ciudades = Ciudad::all();
        $paises = Pais::all();
        $items_estado_civil = TipoMaestro::where('nombre','Estado Civil')->first()->tiposmaestroitem;
        $carreras = Dependencia::where('codigo','>',100)->get();
        $estudiante_rol = Rol::where('name','Estudiante')->first();

        return view('basico.usuarios.show',[
            'roles'=>$roles,
            'dependencias'=>$dependencias,
            'departamentos'=>$departamentos,
            'items_sexo'=>$items_sexo,
            'items_tipos_documento'=>$items_tipos_documento,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'items_estado_civil' => $items_estado_civil,
            'carreras' => $carreras,
            'estudiante_rol' => $estudiante_rol,
            'usuario' => $user
        ]);
    }

     /**
     * Actualiza el usuario especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  {                

        if((!\Auth::user()->hasAnyRole(['Administrador','Coordinador proyeccion social'])) && (\Auth::user()->id != $id)){
            return back()
            ->with('error', "Usted no puede editar información de otros usuarios!!<br>")->withInput();            
        }

        DB::beginTransaction();        

        try{

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if(\Auth::user()->hasRole('Administrador')){
                $user->state = ($request->state == 1 ) ? true : false ;
            }

            if(isset($request->password)){
                $user->password = bcrypt($request->password);
            }
            $user->user_updated_at = \Auth::user()->id;
            $user->save();

            $estudiante_rol = Rol::where('name','Estudiante')->first();

            if(isset($request->rol)){
                $roles = $request->rol;
            }else{                
                $roles = array_column(Rol::select("id")->whereIn('name',$user->getRoleNames())->get()->toArray(), "id");
            }            

            if(in_array( $estudiante_rol->id, $roles )){
                //Quitar rol estudiante
                $rol_id_est = $estudiante_rol->id;
                $roles_aux = array_filter($roles, function($v, $k) use($rol_id_est) {
                    return  $v != $rol_id_est;
                }, ARRAY_FILTER_USE_BOTH);
                
                $roles = $roles_aux;
            }            

            if( isset($request->rol_e) & ($request->rol_e == "1")  ){
                array_push($roles, $estudiante_rol->id);
            }    

            $user->syncRoles($roles);


            $userInfo = UserInfo::where('user_id',$id)->first();                
            if(!is_object($userInfo)){
                $userInfo = new UserInfo();
                $userInfo->user_created_at = \Auth::user()->id;
            }else{
                $userInfo->user_updated_at = \Auth::user()->id;
            }   
            
            $userInfo->email_institucional = (isset($request->email_institucional))? $request->email_institucional: null;
            $userInfo->codigo_estudiante = (isset($request->codigo_estudiante)) ? $request->codigo_estudiante : null;
            $userInfo->codigo_carrera = (isset($request->codigo_carrera)) ? $request->codigo_carrera : null;
            $userInfo->semestre = (isset($request->semestre)) ? $request->semestre : null;

            $userInfo->facebook = (isset($request->facebook))? $request->facebook : null;
            $userInfo->instagram = (isset($request->instagram))? $request->instagram : null;
            $userInfo->user_id = $user->id;
            $userInfo->ciudad_id = (isset($request->ciudad_id))? $request->ciudad_id : null;
            $userInfo->direccion = (isset($request->direccion))? $request->direccion : null;
            $userInfo->barrio = (isset($request->barrio))? $request->barrio : null;
            $userInfo->telefonos = (isset($request->phone_numbers) && count($request->phone_numbers) > 0)? json_encode($request->phone_numbers) : null;
            $userInfo->dependencia_id = ($request->dependencia_id != "")? $request->dependencia_id: null;
            $userInfo->sexo = ($request->sexo != "")? $request->sexo: null;
            $userInfo->edad = ($request->edad != "")? $request->edad: null;
            $userInfo->estrato = ($request->estrato != "")? $request->estrato: null;
            $userInfo->tipo_documento = ($request->tipo_documento != "")? $request->tipo_documento: null;
            $userInfo->numero_documento = ($request->numero_documento != "")? $request->numero_documento: null;
            $userInfo->fecha_nacimiento = ($request->fecha_nacimiento != "")? $request->fecha_nacimiento: null;
            $userInfo->lugar_nacimiento = ($request->lugar_nacimiento != "")? $request->lugar_nacimiento: null;
            $userInfo->fecha_lugar_expedicion = ($request->fecha_lugar_expedicion != "")? $request->fecha_lugar_expedicion: null;

            if($request->hasFile('foto'))
            {
                $name_photo = "photo_perfil_".$user->id.".jpg";
                $path_photo = 'users/photo/'.$name_photo;

                $file_1 = $request->file('foto');
                if($userInfo->foto != ""){
                    Storage::disk('public/')->delete($userInfo->foto);
                }
                Storage::putFileAs('public/users/photo/', $file_1, $name_photo);
                $userInfo->foto = $path_photo;
            }

            $userInfo->save();
                
            DB::commit();

        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        if($user->hasAnyRole(['General','Asesor','Coordinador de emprendimiento','Estudiante','Coordinador proyeccion social','Coordinador de practicas','Empresa','Dependencia','Director de programa','Profesor de apoyo'])){
            return redirect()->route('usuarios.edit',$user->id)->with('info','El usuario fue actualizado con éxito');
        }else{
            return redirect()->route('usuarios.index')->with('info','El usuario fue actualizado con éxito');
        }

        
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
     * Muestra una lista de los emprendimientos que tiene asociado al usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emprendimientos($id){
        
        $user = User::find($id);
        $emprendimientos = $user->emprendimientos;

        return view('basico.usuarios.emprendimientos.index',[
            'usuario'=>$user,
            'emprendimientos'=>$emprendimientos,
        ]);

    }

    /**
     * Muestra el formulario para crear un nuevo emprendimiento asociado al usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function crearEmprendimiento($id)
    {
        $user = User::find($id);
        return view('basico.usuarios.emprendimientos.create',[
            'usuario'=>$user,
        ]);
    }

    /**
     * Almacena un emprendimiento asociado al usuario recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarEmprendimiento(CrearEmprendimientoRequest $request){
        
        $emprendimiento = new Emprendimiento();
        $emprendimiento->nombre = $request->nombre;
        $emprendimiento->descripcion = $request->descripcion;
        $emprendimiento->user_id = $request->user_id;
        $emprendimiento->user_created_at = \Auth::user()->id;        
        $emprendimiento->save();

        return redirect()->route('listar.emprendimiento',$request->user_id)->with('info','El emprendimiento fue registrado con éxito');
    }

    /**
     * Elimina un emprendimiento asociado al usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $emprendimiento_id
     * @return \Illuminate\Http\Response
     */
    public function eliminarEmprendimiento($emprendimiento_id)
    {
        $emprendimiento = Emprendimiento::find($emprendimiento_id);
        $emprendimiento->delete();
        return back()->with('info','El emprendimiento fue removido');
    }

    /**
     * Almacena un emprendimiento asociado al usuario recién creado en el almacenamiento mediante una petición ajax.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON data<collection> message<text> type<text>
     */
    public function ajaxGuardarEmprendimiento(Request $request){

        if($request->emprendimiento_id != null){
            $emprendimiento = Emprendimiento::find($request->emprendimiento_id);
            $emprendimiento->user_updated_at = \Auth::user()->id;
        }else{
            $emprendimiento = new Emprendimiento();
            $emprendimiento->user_created_at = \Auth::user()->id;
        }       

        $emprendimiento->nombre = $request->nombre;
        $emprendimiento->descripcion = $request->descripcion;
        $emprendimiento->user_id = $request->user_id;
                
        $emprendimiento->save();

        return response()->json([
            'data'=> $request->all(),
            'message' => 'El emprendimiento fue guardado con éxito',
            'type' => 'info',
        ]);
    }

    /**
     * Retorna el emprendimiento especificado por petición ajax.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON data<collection> message<text> type<text>
     */
    public function ajaxGetEmprendimiento(Request $request){

        $emprendimiento = Emprendimiento::find($request->emprendimiento_id);

        return response()->json([
            'data'=>   $emprendimiento->toArray(),
            'message' => '',
            'type' => '',
        ]);

    }

    /**
     * Marca como leído la notificaciones del usuario en sesión.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(){
        $user = \Auth::user();
        $user->unreadNotifications->markAsRead();
        return back();
    }

     /**
     * Lista los emprendimeintos asociados al usuario en una estructura html.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON data<collection> message<text> type<text> html<structura html>
     */
    public function ajaxListarEmprendimientos(Request $request){

        $user = User::find($request->user_id);
        $html = "<option value=''>Seleccione un emprendimiento</option>";

        foreach($user->emprendimientos as $emprendimiento){
            $html .= "<option value='".$emprendimiento->id."'>".$emprendimiento->nombre."</option>";
        }

        return response()->json([
            'data'=>   $user->emprendimientos,
            'message' => '',
            'type' => '',
            'html' => $html,
        ]);
    }

    /**
     * Descargar los archivos de la empresa
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     *                          files
     */

    public function dowloandFIleEmpresa($id,$tipo){

        $user_inf = UserInfo::find($id);

        if($tipo == "RUT"){
            $file = public_path()."/storage/".$user_inf->file_rut;
        }

        if($tipo == "Camara de comercio"){
            $file = public_path()."/storage/".$user_inf->file_camara_comercio;
        }

        if($tipo == "Representante"){
            $file = public_path()."/storage/".$user_inf->file_representante;
        }
        
         //$headers = ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
 
        return response()->download($file);

    }
    
    /**
     * Muestra la hoja de vida del usuario.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function showHojaVida($id)
    {
        if( !in_array('Curriculum',array_column(\Auth::user()->getAllPermissions()->toArray(),'name'), true) && (\Auth::user()->id != $id) ){
            return back()
            ->with('error', "Usted no puede editar información de otros usuarios!!<br>")->withInput();            
        }

        $usuario = User::find($id);
        $roles = Role::all();
        $dependencias = Dependencia::all();
        $departamentos = Departamento::all();
        $items_sexo = TipoMaestro::where('nombre','Sexo')->first()->tiposmaestroitem;
        $items_tipos_documento = TipoMaestro::where('nombre','Documentos')->first()->tiposmaestroitem;
        $ciudades = Ciudad::all();
        $paises = Pais::all();
        $items_estado_civil = TipoMaestro::where('nombre','Estado Civil')->first()->tiposmaestroitem;
        $items_tipo_empresa = TipoMaestro::where('nombre','Tipos de empresas')->first()->tiposmaestroitem;

        return view('basico.usuarios.hoja_vida',[
            'roles'=>$roles,
            'usuario'=>$usuario,
            'dependencias'=>$dependencias,
            'departamentos'=>$departamentos,
            'items_sexo'=>$items_sexo,
            'items_tipos_documento'=>$items_tipos_documento,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'items_estado_civil' => $items_estado_civil,
            'items_tipo_empresa' => $items_tipo_empresa
        ]);
    }

    
     /**
     * Registra la hoja de vida del usuario especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actionHojaVida(Request $request, $id) {

        DB::beginTransaction();        

        try{

            $usuario = User::find($id);
            
            $userInfo = UserInfo::where('user_id',$id)->first();                
            if(!is_object($userInfo)){
                $userInfo = new UserInfo();
                $userInfo->user_id = $id;
                $userInfo->user_created_at = \Auth::user()->id;
            }else{
                $userInfo->user_updated_at = \Auth::user()->id;
            }

            $userInfo->sexo =(isset( $request->sexo))?  $request->sexo : null;
            $userInfo->edad = (isset($request->edad))? $request->edad: null;
            $userInfo->ciudad_id = (isset($request->ciudad_id))? $request->ciudad_id : null;
            $userInfo->direccion = (isset($request->direccion))? $request->direccion : null;
            $userInfo->barrio = (isset($request->barrio))? $request->barrio : null;
            $userInfo->estrato = (isset($request->estrato))? $request->estrato : null;
            $userInfo->tipo_documento = (isset($request->tipo_documento))? $request->tipo_documento : null;
            $userInfo->numero_documento = (isset($request->numero_documento))? $request->numero_documento : null;
            $userInfo->fecha_nacimiento = (isset($request->fecha_nacimiento))? $request->fecha_nacimiento : null;
            $userInfo->lugar_nacimiento = (isset($request->lugar_nacimiento))? $request->lugar_nacimiento : null;
            $userInfo->fecha_lugar_expedicion = (isset($request->fecha_lugar_expedicion))? $request->fecha_lugar_expedicion : null;

            if($request->hasFile('foto'))
            {
                $name_photo = "photo_perfil_".$usuario->id.".jpg";
                $path_photo = 'users/photo/'.$name_photo;

                $file_1 = $request->file('foto');
                if($userInfo->foto != ""){
                    Storage::disk('public/')->delete($userInfo->foto);
                }
                Storage::putFileAs('public/users/photo/', $file_1, $name_photo);
                $userInfo->foto = $path_photo;
            }

            $userInfo->telefonos = (isset($request->phone_numbers) && count($request->phone_numbers) > 0)? json_encode($request->phone_numbers) : null;
            $userInfo->libreta_militar = (isset($request->libreta_militar) && count($request->libreta_militar) > 0)? json_encode($request->libreta_militar) : null;
            $userInfo->nacionalidad = (isset($request->nacionalidad)) ? $request->nacionalidad : null;
            $userInfo->estado_civil = (isset($request->estado_civil))? $request->estado_civil : null;
            $userInfo->personas_a_cargo = (isset($request->cant_personas_cargo))? $request->cant_personas_cargo : null;
            $userInfo->posicion_familiar = (isset($request->posicion_familiar))? $request->posicion_familiar : null;
            $userInfo->save();
           
            
            $usuario_hv = Curriculum::where("user_id",$id)->first();

            if(!is_object($usuario_hv)){
                $usuario_hv = new Curriculum();
                $usuario_hv->user_created_at = \Auth::user()->id;
            }else{
                $usuario_hv->user_updated_at = \Auth::user()->id;
            }
            
            $usuario_hv->user_id = $usuario->id;
            $usuario_hv->bachillerato = (isset($request->bachillerato) && count($request->bachillerato) > 0)? json_encode($request->bachillerato) : null;
            $usuario_hv->educacion_superior = (isset($request->educacion_superior) && count($request->educacion_superior) > 0)? json_encode($request->educacion_superior) : null;
            $usuario_hv->capacitaciones = (isset($request->cursos) && count($request->cursos) > 0)? json_encode($request->cursos) : null;
            $usuario_hv->idiomas = (isset($request->idiomas) && count($request->idiomas) > 0)? json_encode($request->idiomas) : null;
            $usuario_hv->sistemas = (isset($request->sistemas))? $request->sistemas: null;
            $usuario_hv->experiencia_laboral = (isset($request->laboral) && count($request->laboral) > 0)? json_encode($request->laboral) : null;
            $usuario_hv->perfil_ocupacional = (isset($request->perfil_ocupacional))? $request->perfil_ocupacional: null;
            $usuario_hv->referencias_personales = (isset($request->ref_personal) && count($request->ref_personal) > 0)? json_encode($request->ref_personal) : null;
            $usuario_hv->referencias_profesionales = (isset($request->ref_profesional) && count($request->ref_profesional) > 0)? json_encode($request->ref_profesional) : null;
            $usuario_hv->horario_disponibilidad = (isset($request->horario) && count($request->horario) > 0)? json_encode($request->horario) : null;

            //Save Cedula
            if($request->hasFile('cedula'))
            {
                $cedula = $request->file('cedula');

                if($usuario_hv->cedula != ""){
                    Storage::disk('public')->delete($usuario_hv->cedula);
                }

                $extension = $cedula->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$cedula->getClientOriginalName());
                $name_file = "cedula_".$id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.$id,$cedula,$name_file);            

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
                $name_file = "tabulado_".$id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.$id,$tabulado,$name_file);            

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
                $name_file = "confidencialidad_".$id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.$id,$confidencialidad,$name_file);            

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
                $name_file = "recibo_pago_".$id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.$id,$recibo_pago,$name_file);            

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
                $name_file = "certificacion_bancaria_".$id.".".$extension;
                $path = Storage::disk('public')->putFileAs('users/'.$id,$certificacion_bancaria,$name_file);            

                $usuario_hv->certificacion_bancaria = $path;            
            }

            $usuario_hv->save();
            DB::commit();

        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        if(\Auth::user()->hasAnyRole(['General','Asesor','Coordinador de emprendimiento','Estudiante','Coordinador proyeccion social','Coordinador de practicas','Empresa','Dependencia','Coordinador administrativo','Empresa','Director de programa','Profesor de apoyo'])){
            return redirect()->route('usuario.hojaVida',$usuario->id)->with('info','El usuario fue actualizado con éxito');
        }else{
            return redirect()->route('usuarios.index')->with('info','El usuario fue actualizado con éxito');
        }

        
    }

    public function generarD10($id){

        $usuario = User::find($id);
        $pdf = new FPDI('P','mm','A4');
        $pdf->setSourceFile(public_path()."\D10.pdf" );

    /*********** PAGINA 1 **********************************************/    
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Helvetica');

        /********** PRIMERA SECCIÓN ***************/
            //Campo: DÍA
            $pdf->SetFontSize('10');
            $pdf->SetXY(50.9, 45);
            $pdf->Cell(1, 0, date('d'), 0, 0, 'C');

            //Campo: MES
            $pdf->SetFontSize('10');
            $pdf->SetXY(65, 45);
            $pdf->Cell(1, 0, date('M'), 0, 0, 'C');

            //Campo: AÑO
            $pdf->SetFontSize('10');
            $pdf->SetXY(80, 45);
            $pdf->Cell(1, 0, date('Y'), 0, 0, 'C');

            //Campo: DOCENCIA
            $pdf->SetFontSize('10');
            $pdf->SetXY(113.6, 45);
            $pdf->Cell(1, 0, '', 0, 0, 'C');

            //Campo: INVESTIGACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(144.5, 45);
            $pdf->Cell(1, 0, '', 0, 0, 'C');

            //Campo: ADMINISTRATIVA
            $pdf->SetFontSize('10');
            $pdf->SetXY(177.5, 45);
            $pdf->Cell(1, 0, '', 0, 0, 'C');

            //Campo: ESPECIAL
            $pdf->SetFontSize('10');
            $pdf->SetXY(201, 45);
            $pdf->Cell(1, 0, '', 0, 0, 'C');            
        /********** FIN PRIMERA SECCIÓN ***************/

        
        /********** DATOS BÁSICOS ***************/
            //Campo: CODIGO ESTUDIANTE
            $pdf->SetFontSize('10');
            $pdf->SetXY(25, 63);
            $pdf->Cell(1, 0, (isset($usuario->userInfo))? $usuario->userInfo->codigo_estudiante :'', 0, 0, 'C');
        
            //Campo: PRIMER APELLIDO
            $pdf->SetFontSize('10');
            $pdf->SetXY(60, 63);
            $pdf->Cell(1, 0, '', 0, 0, 'C');

            //Campo: PRIMER APELLIDO
            $pdf->SetFontSize('10');
            $pdf->SetXY(100, 63);
            $pdf->Cell(1, 0, '', 0, 0, 'C');

            //Campo: NOMBRE COMPLETO
            $pdf->SetFontSize('10');
            $pdf->SetXY(163.3, 61.6);
            $pdf->Cell(1, 0,(isset($usuario))? $usuario->name :'', 0, 0, 'C');

            //Campo: CODIGO PLAN
            $pdf->SetFontSize('10');
            $pdf->SetXY(25, 73);
            $pdf->Cell(1, 0,(isset($usuario->userInfo->dependencia))? $usuario->userInfo->dependencia->codigo :'', 0, 0, 'C');

            //Campo: NOMBRE PLAN
            $pdf->SetFontSize('6');
            $pdf->SetXY(65, 73);
            $pdf->Cell(1, 0,(isset($usuario->userInfo->dependencia))? utf8_decode($usuario->userInfo->dependencia->nombre) :'', 0, 0, 'C');

            //Campo: SEMESTRE
            $pdf->SetFontSize('10');
            $pdf->SetXY(100, 73);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->semestre :'', 0, 0, 'C');

            //Campo: SEDE
            $pdf->SetFontSize('10');
            $pdf->SetXY(126, 73);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->sede :'', 0, 0, 'C');

            //Campo: JORNADA
            $pdf->SetFontSize('10');
            $pdf->SetXY(158, 73);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->jornada :'', 0, 0, 'C');

            //Campo: PERIODO ACADEMICO
            $pdf->SetFontSize('8');
            $pdf->SetXY(190, 73);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            if(isset($usuario->userInfo->sexouser) && $usuario->userInfo->sexouser->nombre == 'Hombre'){
                //Campo: GENERO M
                $pdf->SetFontSize('10');
                $pdf->SetXY(12, 83);
                $pdf->Cell(1, 0,'X', 0, 0, 'C');
            }
            if(isset($usuario->userInfo->sexouser) && $usuario->userInfo->sexouser->nombre == 'Mujer'){
                //Campo: GENERO F
                $pdf->SetFontSize('10');
                $pdf->SetXY(26, 83);
                $pdf->Cell(1, 0,'X', 0, 0, 'C');
            }

            //Campo:FECHA DE NACIMIENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(54, 83);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->fecha_nacimiento :'', 0, 0, 'C');

            //Campo:EDAD
            $pdf->SetFontSize('10');
            $pdf->SetXY(80, 83);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->edad :'', 0, 0, 'C');

            //Campo:LUGAR DE NACIMIENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(115, 83);
            $pdf->Cell(1, 0,(isset($usuario->userInfo->lugarNacimiento))? $usuario->userInfo->lugarNacimiento->nombre :'', 0, 0, 'C');

            //Campo:NUMERO DE DOCUMENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(155, 83);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->numero_documento :'', 0, 0, 'C');

            //Campo:EXPEDIDA EN 
            $pdf->SetFontSize('7');
            $pdf->SetXY(190, 83);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->fecha_lugar_expedicion :'', 0, 0, 'C');

            if(isset($usuario->userInfo->estadoCivil) && $usuario->userInfo->estadoCivil->nombre == 'Soltero'){
                //Campo:ESTADO CIVIL SOLTERO
                $pdf->SetFontSize('10');
                $pdf->SetXY(53.3, 89.5);
                $pdf->Cell(1, 0,'X', 0, 0, 'C');
            }

            if(isset($usuario->userInfo->estadoCivil) && $usuario->userInfo->estadoCivil->nombre == 'Casado'){
                //Campo:ESTADO CIVIL CASADO
                $pdf->SetFontSize('10');
                $pdf->SetXY(76.3, 89.5);
                $pdf->Cell(1, 0,'X', 0, 0, 'C');
            }

            if(isset($usuario->userInfo->estadoCivil) && $usuario->userInfo->estadoCivil->nombre == 'Unión Libre'){
                //Campo:ESTADO CIVIL UNIÓ LIBRE
                $pdf->SetFontSize('10');
                $pdf->SetXY(104.3, 89.5);
                $pdf->Cell(1, 0,'X', 0, 0, 'C');
            }

            //Campo:ESTADO CIVIL OTRO
            $pdf->SetFontSize('10');
            $pdf->SetXY(125.5, 89.5);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            //Campo:NUMERO DE PERSONAS A CARGO
            $pdf->SetFontSize('10');
            $pdf->SetXY(201, 90);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->personas_a_cargo :'', 0, 0, 'C');

            //Campo:POSICIÓN FAMILIAR INDEPENDEINTE
            $pdf->SetFontSize('10');
            $pdf->SetXY(68.5, 95.9);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            //Campo:POSICIÓN FAMILIAR CABEZA FAMILIAR
            $pdf->SetFontSize('10');
            $pdf->SetXY(110.5, 95.9);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            //Campo:POSICIÓN FAMILIAR HIJO (A)
            $pdf->SetFontSize('10');
            $pdf->SetXY(132, 95.9);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            
            //Campo:POSICIÓN FAMILIAR ESPOSO (A)
            $pdf->SetFontSize('10');
            $pdf->SetXY(161, 95.9);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            //Campo:DIRECCIÓN ACTUAL DE RESIDENCIA
            $pdf->SetFontSize('10');
            $pdf->SetXY(47, 107);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->direccion :'', 0, 0, 'C');

            //Campo:DIRECCIÓN ESTRATO
            $pdf->SetFontSize('10');
            $pdf->SetXY(92, 107);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->estrato :'', 0, 0, 'C');

            //Campo:BARRIO
            $pdf->SetFontSize('10');
            $pdf->SetXY(120, 107);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->barrio :'', 0, 0, 'C');

            //Campo:CIUDAD
            $pdf->SetFontSize('10');
            $pdf->SetXY(156, 107);
            $pdf->Cell(1, 0,(isset($usuario->userInfo->ciudad))? $usuario->userInfo->ciudad->nombre :'', 0, 0, 'C');

            //Campo:DEPARTAMENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(190, 107);
            $pdf->Cell(1, 0,(isset($usuario->userInfo->ciudad->departamento))? $usuario->userInfo->ciudad->departamento->nombre :'', 0, 0, 'C');

            //Campo:TELEFONO
            $pdf->SetFontSize('10');
            $pdf->SetXY(21, 118);
            $pdf->Cell(1, 0,(isset($usuario->userInfo) && $usuario->userInfo->telefonos != null && count(json_decode($usuario->userInfo->telefonos)) > 0)? json_decode($usuario->userInfo->telefonos)[0] :'', 0, 0, 'C');
            
            //Campo:CELULAR
            $pdf->SetFontSize('10');
            $pdf->SetXY(47, 118);
            $pdf->Cell(1, 0,(isset($usuario->userInfo) && $usuario->userInfo->telefonos != null && count(json_decode($usuario->userInfo->telefonos)) > 1)? json_decode($usuario->userInfo->telefonos)[1] : '', 0, 0, 'C');

            //Campo:EMAIL
            $pdf->SetFontSize('7');
            $pdf->SetXY(85, 118);
            $pdf->Cell(1, 0,(isset($usuario->userInfo))? $usuario->userInfo->email_institucional :'', 0, 0, 'C');

            //Campo:NOMBRE DE PERSONAS QUE LE DEN INFORMACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(146, 118);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            //Campo:TELEFONO ACUDIENTE
            $pdf->SetFontSize('9');
            $pdf->SetXY(196, 118);
            $pdf->Cell(1, 0,'', 0, 0, 'C');
        /********** FIN DE DATOS BÁSICOS ***************/

        /********** EDUCACIÓN ***************/
            $bachillerato = (isset($usuario->curriculum) && $usuario->curriculum->bachillerato != null) ? json_decode($usuario->curriculum->bachillerato,true): [];
            
            //Campo:BAHCILLERATO TITULO OBTENIDO
            $pdf->SetFontSize('10');
            $pdf->SetXY(62, 135);
            $pdf->Cell(1, 0,(count($bachillerato)>0 && $bachillerato['titulo_obtenido'] != "")? utf8_decode($bachillerato['titulo_obtenido']) : '', 0, 0, 'C');

            //Campo. BACHILLERATO AÑO DE FINALIZACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(102, 135);
            $pdf->Cell(1, 0,(count($bachillerato)>0 && $bachillerato['ano_finalizacion'] != "")? utf8_decode($bachillerato['ano_finalizacion']) : '', 0, 0, 'C');

            //Campo:BACHILLERATO NOMBRE DEL ESTABLECIMIENTO
            $pdf->SetFontSize('7');
            $pdf->SetXY(145, 135);
            $pdf->Cell(1, 0,(count($bachillerato)>0 && $bachillerato['nombre_establecimiento'] != "")? utf8_decode($bachillerato['nombre_establecimiento']) : '', 0, 0, 'C');

            //Campo:BACHILLERATO CIUDAD
            $pdf->SetFontSize('10');
            $pdf->SetXY(192, 135);
            $pdf->Cell(1, 0,'', 0, 0, 'C');

            $educacion_superior = (isset($usuario->curriculum) && $usuario->curriculum->educacion_superior != null) ? json_decode($usuario->curriculum->educacion_superior,true)[1]: [];
            //dd($educacion_superior);
            //Campo:UNIVERSITARIOS SEMESTRES
            $pdf->SetFontSize('10');
            $pdf->SetXY(45, 145);
            $pdf->Cell(1, 0,(count($educacion_superior)>0 && $educacion_superior['semestres'] != "")? $educacion_superior['semestres'] : '', 0, 0, 'C');

            //Campo:UNIVERSITARIOS PLAN ESTUDIO O TITULO OBTENIDO
            $pdf->SetFontSize('5');
            $pdf->SetXY(81, 145);
            $pdf->Cell(1, 0,(count($educacion_superior)>0 && $educacion_superior['titulo_obtenido'] != "")? utf8_decode($educacion_superior['titulo_obtenido']) : '', 0, 0, 'C');

            
            //Campo:UNIVERSITARIOS AÑO DE FINALIZACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(125, 145);
            $pdf->Cell(1, 0,(count($educacion_superior)>0 && $educacion_superior['ano_finalizacion'] != "")? utf8_decode($educacion_superior['ano_finalizacion']) : '', 0, 0, 'C');

            //Campo:UNIVERSITARIOS NOMBRE DEL ESTABLECIMIENTO
            $pdf->SetFontSize('5');
            $pdf->SetXY(160, 145);
            $pdf->Cell(1, 0,(count($educacion_superior)>0 && $educacion_superior['nombre_establecimiento'] != "")? utf8_decode($educacion_superior['nombre_establecimiento']) : '', 0, 0, 'C');

            
            //Campo:UNIVERSITARIOS CIUDAD
            $pdf->SetFontSize('5');
            $pdf->SetXY(195, 145);
            $pdf->Cell(1, 0,(count($educacion_superior)>0 && $educacion_superior['ciudad'] != "")? utf8_decode($educacion_superior['ciudad']) : '', 0, 0, 'C');
        /********** FIN EDUCACIÓN ***************/
            

        /********** CAPACITACIONES ***************/
            $capacitaciones = (isset($usuario->curriculum) && $usuario->curriculum->capacitaciones != null) ? json_decode($usuario->curriculum->capacitaciones,true): [];
            //dd($capacitaciones);
            //Campo:NOMBRE DEL ESTABLECIMIENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(35, 167);
            $pdf->Cell(1, 0,(count($capacitaciones)>0 && $capacitaciones[1]['nombre_establecimiento'] != "")? utf8_decode($capacitaciones[1]['nombre_establecimiento']) : '', 0, 0, 'C');

            //Campo:NOMBRE DEL CURSO O SEMINARIO
            $pdf->SetFontSize('10');
            $pdf->SetXY(90, 167);
            $pdf->Cell(1, 0,(count($capacitaciones)>0 && $capacitaciones[1]['nombre'] != "")? utf8_decode($capacitaciones[1]['nombre']) : '', 0, 0, 'C');

            //Campo:DURACIÓN DEL CURSO O SEMINARIO
            $pdf->SetFontSize('10');
            $pdf->SetXY(145, 167);
            $pdf->Cell(1, 0,(count($capacitaciones)>0 && $capacitaciones[1]['duracion'] != "")? utf8_decode($capacitaciones[1]['duracion']) : '', 0, 0, 'C');

            //Campo:FECHA TERMINACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(190, 167);
            $pdf->Cell(1, 0,(count($capacitaciones)>0 && $capacitaciones[1]['fecha_finalizacion'] != "")? utf8_decode($capacitaciones[1]['fecha_finalizacion']) : '', 0, 0, 'C');

            /*---------------SECCIÓN 2-------------*/
            //Campo:NOMBRE DEL ESTABLECIMIENTO
            $pdf->SetFontSize('10');
            $pdf->SetXY(35, 178);
            $pdf->Cell(1, 0,(count($capacitaciones)>1 && $capacitaciones[2]['nombre_establecimiento'] != "")? utf8_decode($capacitaciones[2]['nombre_establecimiento']) : '', 0, 0, 'C');

            //Campo:NOMBRE DEL CURSO O SEMINARIO
            $pdf->SetFontSize('10');
            $pdf->SetXY(90, 178);
            $pdf->Cell(1, 0,(count($capacitaciones)>1 && $capacitaciones[2]['nombre'] != "")? utf8_decode($capacitaciones[2]['nombre']) : '', 0, 0, 'C');

            //Campo:DURACIÓN DEL CURSO O SEMINARIO
            $pdf->SetFontSize('10');
            $pdf->SetXY(145, 178);
            $pdf->Cell(1, 0,(count($capacitaciones)>1 && $capacitaciones[2]['duracion'] != "")? utf8_decode($capacitaciones[2]['duracion']) : '', 0, 0, 'C');

            //Campo:FECHA TERMINACIÓN
            $pdf->SetFontSize('10');
            $pdf->SetXY(190, 178);
            $pdf->Cell(1, 0,(count($capacitaciones)>1 && $capacitaciones[2]['fecha_finalizacion'] != "")? utf8_decode($capacitaciones[2]['fecha_finalizacion']) : '', 0, 0, 'C');
            /*--------------- FIN SECCIÓN 2-------------*/      

        /********** FIN CAPACITACIONES ***************/

        /********** IDIOMAS ***************/
            $idiomas = (isset($usuario->curriculum) && $usuario->curriculum->idiomas != null) ? json_decode($usuario->curriculum->idiomas,true): [];
            //dd($idiomas);
            //Campo:IDIOMA
            $pdf->SetFontSize('10');
            $pdf->SetXY(25, 200);
            $pdf->Cell(1, 0,(count($idiomas)>0 && $idiomas[1]['nombre'] != "")? utf8_decode($idiomas[1]['nombre']) : '', 0, 0, 'C');

            //Campo:HABLA
            $pdf->SetFontSize('10');
            $pdf->SetXY(55, 200);
            $pdf->Cell(1, 0,(count($idiomas)>0 && $idiomas[1]['habla'] != "")? utf8_decode($idiomas[1]['habla']) : '', 0, 0, 'C');

            //Campo:ESCRIBE
            $pdf->SetFontSize('10');
            $pdf->SetXY(75, 200);
            $pdf->Cell(1, 0,(count($idiomas)>0 && $idiomas[1]['escritura'] != "")? utf8_decode($idiomas[1]['escritura']) : '', 0, 0, 'C');

            //Campo:LEE
            $pdf->SetFontSize('10');
            $pdf->SetXY(97, 200);
            $pdf->Cell(1, 0,(count($idiomas)>0 && $idiomas[1]['lectura'] != "")? utf8_decode($idiomas[1]['lectura']) : '', 0, 0, 'C');

            //Campo:IDIOMA
            $pdf->SetFontSize('10');
            $pdf->SetXY(125, 200);
            $pdf->Cell(1, 0,(count($idiomas)>1 && $idiomas[2]['nombre'] != "")? utf8_decode($idiomas[2]['nombre']) : '', 0, 0, 'C');

            //Campo:HABLA
            $pdf->SetFontSize('10');
            $pdf->SetXY(150, 200);
            $pdf->Cell(1, 0,(count($idiomas)>1 && $idiomas[2]['habla'] != "")? utf8_decode($idiomas[2]['habla']) : '', 0, 0, 'C');

            //Campo:ESCRIBE
            $pdf->SetFontSize('10');
            $pdf->SetXY(175, 200);
            $pdf->Cell(1, 0,(count($idiomas)>1 && $idiomas[2]['escritura'] != "")? utf8_decode($idiomas[2]['escritura']) : '', 0, 0, 'C');

            //Campo:LEE
            $pdf->SetFontSize('10');
            $pdf->SetXY(197, 200);
            $pdf->Cell(1, 0,(count($idiomas)>1 && $idiomas[2]['lectura'] != "")? utf8_decode($idiomas[2]['lectura']) : '', 0, 0, 'C');
        /********** FIN IDIOMAS ***************/

        /********** SISTEMAS (PROGRAMAS QUE MANEJA) ***************/        
            $pdf->SetFontSize('10');
            $pdf->SetXY(100, 220);
            $pdf->Cell(1, 0,(isset($usuario->curriculum) && $usuario->curriculum->sistemas != null)? utf8_decode($usuario->curriculum->sistemas) : '', 0, 0, 'C');
        /********** FIN SISTEMAS (PROGRAMAS QUE MANEJA) ***************/

        /********** PERFIL OCUPACIONAL ***************/        
            $pdf->SetFontSize('5');
            $pdf->SetXY(100, 250);
            $pdf->Cell(1, 0,(isset($usuario->curriculum) && $usuario->curriculum->perfil_ocupacional != null)? utf8_decode($usuario->curriculum->perfil_ocupacional) : '', 0, 0, 'C');
        /********** FIN PERFIL OCUPACIONAL ***************/

    /*********** FIN PAGINA 1 **********************************************/
    
    /*********** PAGINA 2 **********************************************/
        $tp2 = $pdf->importPage(2);
        $pdf->AddPage();
        $pdf->useTemplate($tp2);
        $pdf->SetFont('Helvetica');

        /********** EXPERIENCIA LABORAL ***************/ 
            $experiencia_laboral = (isset($usuario->curriculum) && $usuario->curriculum->experiencia_laboral != null) ? json_decode($usuario->curriculum->experiencia_laboral,true): [];            
            /*------SECCIÓN 1-------*/
                //Campo: NOMBRE DE LA EMPRESA       
                $pdf->SetFontSize('10');
                $pdf->SetXY(50, 18);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['nombre'] != "")? utf8_decode($experiencia_laboral[1]['nombre']) : '', 0, 0, 'C');

                //Campo: CARGO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(60, 25);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['cargo'] != "")? utf8_decode($experiencia_laboral[1]['cargo']) : '', 0, 0, 'C');

                //Campo: FUNCIONES REALIZADAS       
                $pdf->SetFontSize('10');
                $pdf->SetXY(125, 25);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['funciones'] != "")? utf8_decode($experiencia_laboral[1]['funciones']) : '', 0, 0, 'C');

                //Campo: LOGROS       
                $pdf->SetFontSize('10');
                $pdf->SetXY(180, 25);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['logros'] != "")? utf8_decode($experiencia_laboral[1]['logros']) : '', 0, 0, 'C');

                //Campo: JEFE INMEDIATO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(25, 36);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['jefe'] != "")? utf8_decode($experiencia_laboral[1]['jefe']) : '', 0, 0, 'C');

                //Campo: CARGO      
                $pdf->SetFontSize('10');
                $pdf->SetXY(85, 36);
                $pdf->Cell(1, 0,'', 0, 0, 'C');

                //Campo: TELEFONO DE EMPRESA       
                $pdf->SetFontSize('10');
                $pdf->SetXY(125, 36);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['tipo_empresa'] != "")? utf8_decode($experiencia_laboral[1]['tipo_empresa']) : '', 0, 0, 'C');

                //Campo: FECHA INICIO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(160, 36);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['fechaini'] != "")? utf8_decode($experiencia_laboral[1]['fechaini']) : '', 0, 0, 'C');

                //Campo: FECHA FINALIZACIÓN       
                $pdf->SetFontSize('10');
                $pdf->SetXY(190, 36);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>0 && $experiencia_laboral[1]['fechafin'] != "")? utf8_decode($experiencia_laboral[1]['fechafin']) : '', 0, 0, 'C');
            /*------FIN SECCIÓN 1------*/

            /*------SECCIÓN 2-------*/
                //Campo: NOMBRE DE LA EMPRESA       
                $pdf->SetFontSize('10');
                $pdf->SetXY(50, 50);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['nombre'] != "")? utf8_decode($experiencia_laboral[2]['nombre']) : '', 0, 0, 'C');

                //Campo: CARGO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(60, 55);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['cargo'] != "")? utf8_decode($experiencia_laboral[2]['cargo']) : '', 0, 0, 'C');

                //Campo: FUNCIONES REALIZADAS       
                $pdf->SetFontSize('10');
                $pdf->SetXY(125, 55);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['funciones'] != "")? utf8_decode($experiencia_laboral[2]['funciones']) : '', 0, 0, 'C');

                //Campo: LOGROS       
                $pdf->SetFontSize('10');
                $pdf->SetXY(180, 55);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['logros'] != "")? utf8_decode($experiencia_laboral[2]['logros']) : '', 0, 0, 'C');

                //Campo: JEFE INMEDIATO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(25, 66);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['jefe'] != "")? utf8_decode($experiencia_laboral[2]['jefe']) : '', 0, 0, 'C');

                //Campo: CARGO      
                $pdf->SetFontSize('10');
                $pdf->SetXY(85, 66);
                $pdf->Cell(1, 0,'', 0, 0, 'C');

                //Campo: TELEFONO DE EMPRESA       
                $pdf->SetFontSize('10');
                $pdf->SetXY(125, 66);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['telefono'] != "")? utf8_decode($experiencia_laboral[2]['telefono']) : '', 0, 0, 'C');

                //Campo: FECHA INICIO       
                $pdf->SetFontSize('10');
                $pdf->SetXY(160, 66);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['fechaini'] != "")? utf8_decode($experiencia_laboral[2]['fechaini']) : '', 0, 0, 'C');

                //Campo: FECHA FINALIZACIÓN       
                $pdf->SetFontSize('10');
                $pdf->SetXY(190, 66);
                $pdf->Cell(1, 0,(count($experiencia_laboral)>1 && $experiencia_laboral[2]['fechafin'] != "")? utf8_decode($experiencia_laboral[2]['fechafin']) : '', 0, 0, 'C');
            /*------FIN SECCIÓN 2------*/            
        /********** FIN EXPERIENCIA LABORAL ***************/

        /********** HORARIO DISPONIBILIDAD ***************/
            $horarios = (isset($usuario->curriculum) && $usuario->curriculum->horario_disponibilidad != null) ? json_decode($usuario->curriculum->horario_disponibilidad,true): [];

            $lunes = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'LUNES');
            });
            
            if(count($lunes) > 0){
                $lunes = array_combine(range(1, count($lunes)), array_values($lunes));
                /*-------LUNES------*/
                    //Campo: LUNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 81);
                    $pdf->Cell(1, 0,(count($lunes)>0 && $lunes[1]['hora_inicio'] != "")? utf8_decode($lunes[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: LUNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 81);
                    $pdf->Cell(1, 0,(count($lunes)>0 && $lunes[1]['hora_final'] != "")? utf8_decode($lunes[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: LUNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 81);
                    $pdf->Cell(1, 0,(count($lunes)>1 && $lunes[2]['hora_inicio'] != "")? utf8_decode($lunes[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: LUNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 81);
                    $pdf->Cell(1, 0,(count($lunes)>1 && $lunes[2]['hora_final'] != "")? utf8_decode($lunes[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: LUNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 81);
                    $pdf->Cell(1, 0,(count($lunes)>2 && $lunes[3]['hora_inicio'] != "")? utf8_decode($lunes[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: LUNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 81);
                    $pdf->Cell(1, 0,(count($lunes)>2 && $lunes[3]['hora_final'] != "")? utf8_decode($lunes[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN LUNES-----------*/
            }

            $martes = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'MARTES');
            });
            
            if(count($martes) > 0){                    
                $martes = array_combine(range(1, count($martes)), array_values($martes));            
                /*-------MARTES------*/
                    //Campo: MARTES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 85);
                    $pdf->Cell(1, 0,(count($martes)>0 && $martes[1]['hora_inicio'] != "")? utf8_decode($martes[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: MARTES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 85);
                    $pdf->Cell(1, 0,(count($martes)>0 && $martes[1]['hora_final'] != "")? utf8_decode($martes[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: MARTES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 85);
                    $pdf->Cell(1, 0,(count($martes)>1 && $martes[2]['hora_inicio'] != "")? utf8_decode($martes[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: MARTES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 85);
                    $pdf->Cell(1, 0,(count($martes)>1 && $martes[2]['hora_final'] != "")? utf8_decode($martes[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: MARTES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 85);
                    $pdf->Cell(1, 0,(count($martes)>2 && $martes[3]['hora_inicio'] != "")? utf8_decode($martes[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: MARTES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 85);
                    $pdf->Cell(1, 0,(count($martes)>2 && $martes[3]['hora_final'] != "")? utf8_decode($martes[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN MARTES-----------*/
            }

            $miercoles = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'MIERCOLES');
            });
            
            
            if(count($miercoles)>0){
                $miercoles = array_combine(range(1, count($miercoles)), array_values($miercoles));
                /*-------MIERCOLES------*/
                    //Campo: MIERCOLES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 89);
                    $pdf->Cell(1, 0,(count($miercoles)>0 && $miercoles[1]['hora_inicio'] != "")? utf8_decode($miercoles[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: MIERCOLES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 89);
                    $pdf->Cell(1, 0,(count($miercoles)>0 && $miercoles[1]['hora_final'] != "")? utf8_decode($miercoles[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: MIERCOLES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 89);
                    $pdf->Cell(1, 0,(count($miercoles)>1 && $miercoles[2]['hora_inicio'] != "")? utf8_decode($miercoles[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: MIERCOLES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 89);
                    $pdf->Cell(1, 0,(count($miercoles)>1 && $miercoles[2]['hora_final'] != "")? utf8_decode($miercoles[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: MIERCOLES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 89);
                    $pdf->Cell(1, 0,(count($miercoles)>2 && $miercoles[3]['hora_inicio'] != "")? utf8_decode($miercoles[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: MIERCOLES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 90);
                    $pdf->Cell(1, 0,(count($miercoles)>2 && $miercoles[3]['hora_fin'] != "")? utf8_decode($miercoles[3]['hora_fin']) : '', 0, 0, 'C');
                /*-------FIN MIERCOLES-----------*/
            }
            
            $jueves = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'JUEVES');
            });

            
            if(count($jueves)>0){                    
                $jueves = array_combine(range(1, count($jueves)), array_values($jueves));
                /*-------JUEVES------*/
                    //Campo: JUEVES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 93);
                    $pdf->Cell(1, 0,(count($jueves)>0 && $jueves[1]['hora_inicio'] != "")? utf8_decode($jueves[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: JUEVES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 93);
                    $pdf->Cell(1, 0,(count($jueves)>0 && $jueves[1]['hora_final'] != "")? utf8_decode($jueves[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: JUEVES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 93);
                    $pdf->Cell(1, 0,(count($jueves)>1 && $jueves[2]['hora_inicio'] != "")? utf8_decode($jueves[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: JUEVES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 93);
                    $pdf->Cell(1, 0,(count($jueves)>1 && $jueves[2]['hora_final'] != "")? utf8_decode($jueves[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: JUEVES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 93);
                    $pdf->Cell(1, 0,(count($jueves)>2 && $jueves[3]['hora_inicio'] != "")? utf8_decode($jueves[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: JUEVES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 93);
                    $pdf->Cell(1, 0,(count($jueves)>2 && $jueves[3]['hora_final'] != "")? utf8_decode($jueves[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN JUEVES-----------*/
            }

            
            $viernes = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'VIERNES');
            });

            
            if(count($viernes) > 0){
                $viernes = array_combine(range(1, count($viernes)), array_values($viernes));
                /*-------VIERNES------*/
                    //Campo: VIERNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 97);
                    $pdf->Cell(1, 0,(count($viernes)>0 && $viernes[1]['hora_inicio'] != "")? utf8_decode($viernes[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: VIERNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 97);
                    $pdf->Cell(1, 0,(count($viernes)>0 && $viernes[1]['hora_final'] != "")? utf8_decode($viernes[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: VIERNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 97);
                    $pdf->Cell(1, 0,(count($viernes)>1 && $viernes[2]['hora_inicio'] != "")? utf8_decode($viernes[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: VIERNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 97);
                    $pdf->Cell(1, 0,(count($viernes)>1 && $viernes[2]['hora_final'] != "")? utf8_decode($viernes[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: VIERNES DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 97);
                    $pdf->Cell(1, 0,(count($viernes)>2 && $viernes[3]['hora_inicio'] != "")? utf8_decode($viernes[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: VIERNES HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 97);
                    $pdf->Cell(1, 0,(count($viernes)>2 && $viernes[3]['hora_final'] != "")? utf8_decode($viernes[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN VIERNES-----------*/
            }

            $sabado = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'SABADO');
            });
            
            if(count($sabado) > 0){                    
                $sabado = array_combine(range(1, count($sabado)), array_values($sabado));
                /*-------SABADO------*/
                    //Campo: SABADO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 101);
                    $pdf->Cell(1, 0,(count($sabado)>0 && $sabado[1]['hora_inicio'] != "")? utf8_decode($sabado[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: SABADO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 101);
                    $pdf->Cell(1, 0,(count($sabado)>0 && $sabado[1]['hora_final'] != "")? utf8_decode($sabado[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: SABADO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 101);
                    $pdf->Cell(1, 0,(count($sabado)>1 && $sabado[2]['hora_inicio'] != "")? utf8_decode($sabado[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: SABADO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 101);
                    $pdf->Cell(1, 0,(count($sabado)>1 && $sabado[2]['hora_final'] != "")? utf8_decode($sabado[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: SABADO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 101);
                    $pdf->Cell(1, 0,(count($sabado)>2 && $sabado[3]['hora_inicio'] != "")? utf8_decode($sabado[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: SABADO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 101);
                    $pdf->Cell(1, 0,(count($sabado)>2 && $sabado[3]['hora_final'] != "")? utf8_decode($sabado[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN SABADO-----------*/
            }
            
            $domingo = array_filter($horarios, function ($var) {
                return ($var['dia'] == 'domingo');
            });

            
            if(count($domingo)>0){
                $domingo = array_combine(range(1, count($domingo)), array_values($domingo));
                /*-------DOMINGO------*/
                    //Campo: DOMINGO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(36, 105);
                    $pdf->Cell(1, 0,(count($domingo)>0 && $domingo[1]['hora_inicio'] != "")? utf8_decode($domingo[1]['hora_inicio']) : '', 0, 0, 'C');
                    
                    //Campo: DOMINGO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(48, 105);
                    $pdf->Cell(1, 0,(count($domingo)>0 && $domingo[1]['hora_final'] != "")? utf8_decode($domingo[1]['hora_final']) : '', 0, 0, 'C');

                    //Campo: DOMINGO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(58, 105);
                    $pdf->Cell(1, 0,(count($domingo)>1 && $domingo[2]['hora_inicio'] != "")? utf8_decode($domingo[2]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: DOMINGO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(70, 105);
                    $pdf->Cell(1, 0,(count($domingo)>1 && $domingo[2]['hora_final'] != "")? utf8_decode($domingo[2]['hora_final']) : '', 0, 0, 'C');

                    //Campo: DOMINGO DE       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(81, 105);
                    $pdf->Cell(1, 0,(count($domingo)>2 && $domingo[3]['hora_inicio'] != "")? utf8_decode($domingo[3]['hora_inicio']) : '', 0, 0, 'C');

                    //Campo: DOMINGO HASTA       
                    $pdf->SetFontSize('10');
                    $pdf->SetXY(92, 105);
                    $pdf->Cell(1, 0,(count($domingo)>2 && $domingo[3]['hora_final'] != "")? utf8_decode($domingo[3]['hora_final']) : '', 0, 0, 'C');
                /*-------FIN DOMINGO-----------*/
            }       

        /**********FIN HORARIO DISPONIBILIDAD ***************/
    /*********** FIN PAGINA 2 **********************************************/        
        //$pdf->Output("D","prueba.pdf");
        $pdf->Output();
    }

    public function viewD10(){
        return view('basico.usuarios.PDF.D10BETA');
    }

}
