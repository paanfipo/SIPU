<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\CrearEtapaRequest;
use App\Http\Requests\ActualizarEtapasRequest;

//Models
use App\Etapa;

/**
 * Gestion Etapas 
 * 
 * Clase que se encarga de manipular la información de la etapa y demas acciones que procede de ella.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Etapas
 */

class EtapaController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co> 
     * @return void
     */

    public function __construct()
    {        
        $this->middleware(['permission:Listar Etapas'])->only(['index']);
        $this->middleware(['permission:Crear Etapa'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Etapa'])->only(['edit','update']);
        $this->middleware(['permission:Detalle Etapa'])->only(['show']);
    }
    
    /**
     * Muestra una lista de las etapas.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etapas = Etapa::all();
        return view('emprendimiento.etapas.index',['etapas'=>$etapas]);
    }

    /**
     * Muestra el formulario para crear un nueva etapa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emprendimiento.etapas.create');
    }

    /**
     * Almacena una etapa recién creada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEtapaRequest $request)
    {
        $etapa = new Etapa();
        $etapa->nombre = $request->nombre;
        $etapa->descripcion = $request->descripcion;
        $etapa->state = $request->state;
        $etapa->user_created_at = \Auth::user()->id;
        $etapa->save();

        return redirect()->route('etapas.index')->with('info','La etapa fue registrada con éxito');  

    }

    /**
     * Muestra la etapa especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $etapa = Etapa::find($id);
        return view('emprendimiento.etapas.show',['etapa' => $etapa,'disabled' => 'disabled']);
    }

    /**
     * Muestra el formulario para editar la etapa especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $etapa = Etapa::find($id);
        return view('emprendimiento.etapas.show',['etapa' => $etapa]);
    }

     /**
     * Actualiza la etapa especificada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\ActualizarEtapasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarEtapasRequest $request, $id)
    {
        $etapa = Etapa::find($id);
        $etapa->nombre = $request->nombre;
        $etapa->descripcion = $request->descripcion;
        $etapa->state = $request->state;
        $etapa->user_updated_at = \Auth::user()->id;
        $etapa->save();

        return redirect()->route('etapas.index')->with('info','La etapa fue actualizada con éxito');
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
