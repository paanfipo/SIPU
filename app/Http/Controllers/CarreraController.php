<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\CrearCarreraRequest;
use App\Http\Requests\ActualizarCarreraRequest;

//Models
use App\Carrera;

/**
 * Gestión Carreras
 * 
 * Clase que se encarga de manipular la información de las carreras
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Carreras
 */

class CarreraController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return void
     */

    public function __construct()
    {        
        $this->middleware(['permission:Listar Carreras'])->only(['index']);
        $this->middleware(['permission:Crear Carrera'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Carrera'])->only(['show','update']);
        $this->middleware(['permission:Detalle Carrera'])->only(['show']);
    }

    /**
     * Muestra una lista de las carreras.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::all();
        return view('basico.carreras.index',['carreras'=>$carreras]);
    }

    /**
     * Muestra el formulario para crear un nueva carrera.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $readonly = false;
        return view('basico.carreras.create',['readonly' => $readonly]);
    }

     /**
     * Almacena una carrera recién creado en el almacenamiento.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearCarreraRequest $request)
    {
        $carrera = new Carrera();
        $carrera->codigo = $request->codigo;
        $carrera->nombre = $request->nombre;
        $carrera->email = $request->email;
        $carrera->user_created_at = \Auth::user()->id;
        $carrera->save();

        return redirect()->route('carreras.index')->with('info','La carrera fue registrada con éxito');
    }

    /**
     * Muestra la carrera especificada.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrera = Carrera::find($id);
        $readonly = true;
        return view('basico.carreras.show',['carrera' => $carrera,'disabled' => 'disabled','readonly' => $readonly]);
    }

   /**
     * Muestra el formulario para editar la carrera especificado.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrera = Carrera::find($id);
        $readonly = true;
        return view('basico.carreras.show',['carrera' => $carrera,'readonly' => $readonly]);
    }

    /**
     * Actualiza la carrera especificada en el almacenamiento.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);
        //$carrera->codigo = $request->codigo;
        $carrera->nombre = $request->nombre;
        $carrera->email = $request->email;
        $carrera->user_updated_at = \Auth::user()->id;
        $carrera->save();

        return redirect()->route('carreras.index')->with('info','La carrera fue actualizada con éxito');
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
