<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\ModuloRequest;

//Models
use App\Paquete;
use App\Modulo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//Query
use DB;

use Illuminate\Support\Facades\Storage;
use File;

/**
 * Gestion de Modulos
 * 
 * Clase que se encarga de manipular la informacion de los modulos
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Modulos
 */

class ModuloController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Modulos'])->only(['index']);
        $this->middleware(['permission:Crear Modulo'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Modulo'])->only(['show','update']);
    }

    /**
     * Muestra una lista de modulos.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::all();
        return view('config.modulos.index',[
            'modulos'=>$modulos,
        ]);
    }

     /**
     * Muestra el formulario para crear un nuevo modulo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paquetes = Paquete::all();
        return view('config.modulos.create',[
            'paquetes'=>$paquetes,
        ]);
    }
    
    /**
     * Almacena un modulo recién creado en el almacenamiento y se crea unos permisos predeterminados para el modulo asignandolos al rol administrador.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuloRequest $request)
    {
        DB::beginTransaction();
        try{        
                //Artisan::call();
                $modulo = new Modulo;
                $modulo->name = $request->name;
                $modulo->url = $request->url;
                //$modulo->url = 'base';
                $modulo->icon = $request->icon;
                $modulo->observation = $request->observation;
                $modulo->state = $request->state;
                $modulo->paquete_id = $request->paquete_id;
                $modulo->user_created_at = \Auth::user()->id;
                $modulo->position = 6;
                $modulo->save();
                
                $role = Role::findByName('Administrador');
                
                $array_permisos = array();
                
                $permiso_crear = new Permission;
                $permiso_crear->name = "Crear ".ucwords(strtolower ( $request->name));
                $permiso_crear->guard_name = 'web';
                $permiso_crear->modulo_id = $modulo->id;
                $permiso_crear->save();
                
                array_push($array_permisos,$permiso_crear->name);
                
                $permiso_actualizar = new Permission;
                $permiso_actualizar->name = "Actualizar ".ucwords(strtolower ( $request->name));
                $permiso_actualizar->guard_name = 'web';
                $permiso_actualizar->modulo_id = $modulo->id;
                $permiso_actualizar->save();
                
                array_push($array_permisos,$permiso_actualizar->name);
                
                $permiso_listar = new Permission;
                $permiso_listar->name = "Listar ".ucwords(strtolower ( $request->name));
                $permiso_listar->guard_name = 'web';
                $permiso_listar->modulo_id = $modulo->id;
                $permiso_listar->save();
                
                array_push($array_permisos,$permiso_listar->name);
                
                if(count($array_permisos) > 0){
                    $role->givePermissionTo($array_permisos);
                }

                $paquete = Paquete::find($modulo->paquete_id);
                
                Artisan::call('make:migration', ['name' => 'create_'.ucfirst(strtolower(str_replace(" ","",$request->name))).'_table', '--create' => strtolower(str_replace(" ","",$request->name))]);
                Artisan::call('make:model',['name' => ucfirst(strtolower(str_replace(" ","",$request->name)))]);
                Artisan::call('make:controller',['name' => ucfirst(strtolower(str_replace(" ","",$request->name)))."Controller", '--resource' => true]);
                Artisan::call('make:view '.$paquete->name.'.'.ucfirst(strtolower(str_replace(" ","",$modulo->name))).' --resource --extends=dashboard --section="title_dashboard:'.ucfirst(strtolower(str_replace(" ","",$modulo->name))).'" --section=breadcrumbs');
                //Artisan::call('make:crud '.$paquete->name.'.'.$modulo->name.' --resource');
                $config = base_path('routes/web.php');
                File::append($config,"Route::resource('".strtolower(str_replace(" ","",$modulo->url))."','".ucfirst(strtolower(str_replace(" ","",$request->name)))."Controller');");
                
                $breadcrumbs_config = base_path('routes/breadcrumbs.php');
                File::append($breadcrumbs_config,'Breadcrumbs::register("'.strtolower(str_replace(" ","",$modulo->url)).'.index", function ($breadcrumbs) {$breadcrumbs->parent("home");$breadcrumbs->push("'.str_replace(" ","",$modulo->name).'", route("'.strtolower(str_replace(" ","",$modulo->url)).'.index"));});');

                DB::commit();

                return redirect()->route('modulos.index')->with('info','El modulo fue registrado con éxito');                            
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error al registrar el los datos, comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
            ->with('error', "Hubo un error al registrar los datos, comuniquese con soporte!!<br>".$e->getMessage())->withInput();        
        }
    }

    /**
     * Muestra el modulo  especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modulo = Modulo::find($id);
        $paquetes = Paquete::all();
        return view('config.modulos.show',[
            'modulo'=>$modulo,
            'paquetes'=>$paquetes,
            'disabled' => 'disabled'
        ]);
    }


    /**
     * Muestra el formulario para editar el modulo especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulo = Modulo::find($id);
        $paquetes = Paquete::all();
        return view('config.modulos.show',[
            'modulo'=>$modulo,
            'paquetes'=>$paquetes,
        ]);
    }

    /**
     * Actualiza el modulo especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuloRequest $request, $id)
    {
        $modulo = Modulo::find($id);
        $modulo->name = $request->name;
        $modulo->url = $request->url;
        $modulo->icon = $request->icon;
        $modulo->observation = $request->observation;
        $modulo->state = $request->state;
        $modulo->paquete_id = $request->paquete_id;
        $modulo->user_updated_at = \Auth::user()->id;
        $modulo->save();
        return redirect()->route('modulos.index')->with('info','El modulo fue actualizado con éxito');
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
