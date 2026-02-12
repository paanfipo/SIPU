<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//Models
use Spatie\Permission\Models\Role;
use App\Modulo;
use App\Permiso;
use App\Rol;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;


/**
 * Gestion de Roles
 * 
 * Clase que se encarga de manipular la informacion de los roles
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Roles
 */

  
class RolController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Roles'])->only(['index']);
        $this->middleware(['permission:Crear Rol'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Rol'])->only(['edit','update']);
    }

    /**
     * Muestra una lista de roles.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Permisos Rol Consulta

        $roles = Rol::all();
        return view('config.roles.index',[
            'roles'=>$roles,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('config.roles.create');
    }

    /**
     * Almacena un rol recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $role = new Rol;
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        return redirect()->route('roles.index')->with('info','El rol fue registrado con éxito');
    }

    /**
     * Muestra el rol especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Rol::find($id);
        $permisos = Permiso::orderBy('modulo_id', 'ASC')->get();
        $modulos =  $permisos->groupBy('modulo_id');

        return view('config.roles.show',[
            'rol'=>$role,
            'modulos'=>$modulos,
            'disabled' => 'disabled'
        ]);
    }

    /**
     * Muestre el formulario para editar el rol especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Rol::find($id);
        $permisos = Permiso::orderBy('modulo_id', 'ASC')->get();
        $modulos =  $permisos->groupBy('modulo_id');

        return view('config.roles.show',[
            'rol'=>$role,
            'modulos'=>$modulos
        ]);
    }

    /**
     * Actualiza el rol especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Rol::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permisos);
        return redirect()->route('roles.show',$role->id)->with('info','El rol fue actualizado con éxito');
    }

    /**
     * Elimina el rol especificado del almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
