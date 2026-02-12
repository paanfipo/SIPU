<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\PermisosRequest;

//Models
use Spatie\Permission\Models\Permission;
use App\Modulo;
use App\Permiso;
use App\Rol;

//Query
use DB;



/**
 * Gestion de Permisos
 * 
 * Clase que se encarga de manipular la informacion de los permisos
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Permisos
 */

class PermisoController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Permisos'])->only(['index']);
        $this->middleware(['permission:Crear Permiso'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Permiso'])->only(['show','update']);
    }

    /**
     * Muestra una lista de permisos.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();

        return view('config.permisos.index',[
            'permisos'=>$permisos,
        ]);
    }

     /**
     * Muestra el formulario para crear un nuevo permiso.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = Modulo::all();
        return view('config.permisos.create',[
            'modulos'=>$modulos,
        ]);
    }

    /**
     * Almacena un permiso recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermisosRequest $request)
    {        
        DB::beginTransaction();
        try {
                $permiso = new Permiso;
                $permiso->name = $request->name;
                $permiso->guard_name = 'web';
                $permiso->modulo_id = $request->modulo_id;
                $permiso->save();
                DB::commit();
        }catch (\Exception $e) {
            return back()
            ->with('error', "Hubo un error al registrar los datos, comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
            ->with('error', "Hubo un error al registrar los datos, comuniquese con soporte!!<br>".$e->getMessage())->withInput();        
        }
            return redirect()->route('permisos.index')->with('info','El permiso fue registrado con éxito');            
    }

    /**
     * Muestra el permiso especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permiso = Permiso::find($id);
        $modulos = Modulo::all();
        return view('config.permisos.show',[
            'permiso'=>$permiso,
            'modulos'=>$modulos,
            'disabled' => 'disabled'
        ]);
    }

    /**
     * Muestra el formulario para editar el permiso especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permiso = Permiso::find($id);
        $modulos = Modulo::all();
        return view('config.permisos.show',[
            'permiso'=>$permiso,
            'modulos'=>$modulos,
        ]);
    }

    /**
     * Actualiza el permiso especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermisosRequest $request, $id)
    {
        $permiso = Permiso::find($id);
        $permiso->name = $request->name;
        $permiso->guard_name = 'web';
        $permiso->modulo_id = $request->modulo_id;
        $permiso->save();
        return redirect()->route('permisos.index')->with('info','El permiso fue actualizado con éxito');
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
