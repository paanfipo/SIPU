<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\CrearEmpresaRequest;

//Storage
use Illuminate\Support\Facades\Storage;

//Query
use DB;

//Notificaciones
use App\Notifications\Novedades;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],[
            'first_name.required' => 'El campo nombres es requerido',
            'last_name.required' => 'El campo apellidos es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe estar en formato email',
            'email.unique' => 'El email ya se encuentra registrado',
            'password.required' => 'El campo password es requerido',
            'password.confirmed' => 'Debe confirmar password',
        ]    
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user_new = new User();
        $user_new->name = $data['first_name']." ".$data['last_name'];
        $user_new->email = $data['email'];
        $user_new->state = true;
        $user_new->password = Hash::make($data['password']);
        $user_new->save();

        $user_new->assignRole('General');

        return $user_new;
    }

    /**
     * Registro empresa
     * 
     * Formulario registro empresa
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @package Básicos
     * @subpackage Auth
    */
    protected function empresa()
    {
        return view('auth.empresa');
    }

    /**
     * Registro empresa
     * 
     * Crea un usuario con el rol empresa y guarda la documentación e iformación solicitada en el formulario
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @package Básicos
     * @subpackage Auth
    */
    protected function registroEmpresa(CrearEmpresaRequest $request)
    {
        DB::beginTransaction();
        try{

            $user_new = new User();
            $user_new->name = $request->first_name." ".$request->last_name;
            $user_new->email = $request->email;
            $user_new->password = Hash::make($request->password);
            //$user_new->email_verified_at = now();
            $user_new->save();            

            $user_new->assignRole('Empresa');

            $user_info = new UserInfo();
            $user_info->nombre_empresa = $request->nombre_empresa;
            $user_info->nit_empresa = $request->nit_empresa;
            $user_info->user_id = $user_new->id;
            $user_info->direccion = $request->direccion;
            $user_info->telefonos = (isset($request->phone_numbers) && count($request->phone_numbers) > 0)? json_encode($request->phone_numbers) : null;

            $user_info->save();
           
            $user_info = UserInfo::find($user_info->id);

            //Insert Doc
            if($request->hasFile('file_rut'))
            {
                $file_rut = $request->file('file_rut');

                $extension = $file_rut->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$file_rut->getClientOriginalName());
                $name_file = "file_rut_".$user_info->id.".".$extension;
                $path_rut = Storage::disk('public')->putFileAs('users/'.$user_new->id,$file_rut,$name_file);            
               
                $user_info->file_rut = $path_rut; 
                      
            }

            if($request->hasFile('file_camara_comercio'))
            {
                $file_camara_comercio = $request->file('file_camara_comercio');

                $extension = $file_camara_comercio->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$file_camara_comercio->getClientOriginalName());
                $name_file = "file_camara_comercio".$user_info->id.".".$extension;
                $path_camara_comercio = Storage::disk('public')->putFileAs('users/'.$user_new->id,$file_camara_comercio,$name_file);            
               
                $user_info->file_camara_comercio = $path_camara_comercio; 
                      
            }

            if($request->hasFile('file_representante'))
            {
                $file_representante = $request->file('file_representante');

                $extension = $file_representante->getClientOriginalExtension();            
                $nombre = str_replace(" ","",$file_representante->getClientOriginalName());
                $name_file = "file_representante".$user_info->id.".".$extension;
                $path_representante = Storage::disk('public')->putFileAs('users/'.$user_new->id,$file_representante,$name_file);            
               
                $user_info->file_representante = $path_representante; 
                      
            }

            $user_info->save();

            //Envio notificación de registro empresa al usuario de coordinador de proyección social
            $collection = collect([
                "type"=>"Novedades Registro Empresa",
                "user_empresa"=> $user_new->id,
                "message"=>'Haga click aquí, para revisar la documentación e información del usuario empresa, puede activar su ingreso activando el usuario!',
            ]);

            $para =  User::role('Coordinador proyeccion social')->get();
            \Notification::send($para,new Novedades($collection));

            DB::commit();
        }catch(\Exception $e){
            return back()
            ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }catch(\Throwable $e){
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }        
        
        return redirect()->route('login')->with('info', 'Registro exitoso, porfavor ingrese con sus credenciales y verifique el email  !!');   ;   
       
    }


}
