<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\CrearDependenciaRequest;
use App\Http\Requests\ActualizarDependenciaRequest;

//Models
use App\Dependencia;
use App\User;

/**
 * Gestión Dependencias
 * 
 * Clase que se encarga de manipular la información de las dependencias
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Dependencias
 */
class DependenciaController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return void
     */

    public function __construct()
    {        
        $this->middleware(['permission:Listar Dependencias'])->only(['index']);
        $this->middleware(['permission:Crear Dependencia'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Dependencia'])->only(['show','update']);
        $this->middleware(['permission:Detalle Dependencia'])->only(['show']);
    }

    /**
     * Muestra una lista de las dependencias.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencias = Dependencia::all();
        return view('basico.dependencias.index',['dependencias'=>$dependencias]);
    }

   /**
     * Muestra el formulario para crear un nueva dependencia.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encargados  = User::role(['Administrador','Asesor','Coordinador de emprendimiento','Coordinador proyeccion social','Coordinador de practicas','Coordinador administrativo','Director de programa'])->get();        
        $profesoresapoyo = User::role(['Profesor de apoyo'])->get();
        $readonly = false;
        return view('basico.dependencias.create', ['encargados'=>$encargados,'profesoresapoyo' => $profesoresapoyo,'readonly' => $readonly]);
    }

    /**
     * Almacena una dependencia recién creado en el almacenamiento.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearDependenciaRequest $request)
    {
        $dependencia = new Dependencia();
        $dependencia->codigo = $request->codigo;
        $dependencia->nombre = $request->nombre;
        $dependencia->sede = $request->sede;
        $dependencia->email = $request->email;
        $dependencia->encargado = $request->encargado;
        $dependencia->profesor_apoyo = $request->profesor_apoyo;
        $dependencia->user_created_at = \Auth::user()->id;
        $dependencia->save();

        return redirect()->route('dependencias.index')->with('info','La dependencia fue registrada con éxito');
    }

    /**
     * Muestra la dependencia especificada.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependencia = Dependencia::find($id);
        $encargados = User::role(['Administrador','Asesor','Coordinador de emprendimiento','Coordinador proyeccion social','Coordinador de practicas','Coordinador administrativo','Director de programa'])->get();        
        $profesoresapoyo = User::role(['Profesor de apoyo'])->get();
        $readonly = true;
        return view('basico.dependencias.show',['dependencia' => $dependencia,'disabled' => 'disabled', 'encargados'=>$encargados,'profesoresapoyo'=>$profesoresapoyo,'readonly' => $readonly]);
    }

   /**
     * Muestra el formulario para editar la dependencia especificado.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependencia = Dependencia::find($id);
        $encargados = User::role(['Administrador','Asesor','Coordinador de emprendimiento','Coordinador proyeccion social','Coordinador de practicas','Coordinador administrativo','Director de programa'])->get();        
        $profesoresapoyo = User::role(['Profesor de apoyo'])->get();
        $readonly = true;
        return view('basico.dependencias.show',['dependencia' => $dependencia, 'encargados'=>$encargados,'profesoresapoyo'=>$profesoresapoyo,'readonly'=>$readonly]);
    }

     /**
     * Actualiza la dependencia especificada en el almacenamiento.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dependencia = Dependencia::find($id);
        $dependencia->codigo = $request->codigo;
        $dependencia->nombre = $request->nombre;
        $dependencia->sede = $request->sede;
        $dependencia->email = $request->email;
        $dependencia->encargado = $request->encargado;
        $dependencia->profesor_apoyo = $request->profesor_apoyo;
        $dependencia->user_created_at = \Auth::user()->id;
        $dependencia->save();

        return redirect()->route('dependencias.index')->with('info','La dependencia fue actualizada con éxito');
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
