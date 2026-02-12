<?php

namespace App\Http\Controllers;

//Request
use App\Http\Requests\TipoMaestroItemRequest;
use Illuminate\Http\Request;

//Model
use App\TipoMaestroItem;
use App\TipoMaestro;

/**
 * Gestion de Maestros Item
 * 
 * Clase que se encarga de manipular la informacion de los items maestros
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo maestro item
 */

class TipoMaestroItemController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Tipo Maestro Item'])->only(['index']);
        $this->middleware(['permission:Crear Tipo Maestro Item'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Tipo Maestro Item'])->only(['edit','update']);
    }

    /**
     * Muestra una lista de los items maestros.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposmaestroitem = TipoMaestroItem::all();
        return view('basico.tiposmaestroitem.index',[
            'tiposmaestroitem'=>$tiposmaestroitem,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo item.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposmaestro = TipoMaestro::all();
        return view('basico.tiposmaestroitem.create',['tiposmaestro'=>$tiposmaestro]);
    }

    /**
     * Almacena un item recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMaestroItemRequest $request)
    {
        $tipomaestroitem = new TipoMaestroItem;
        $tipomaestroitem->nombre = $request->nombre;
        $tipomaestroitem->numitem = $request->numitem;
        $tipomaestroitem->observacion = $request->observacion;
        $tipomaestroitem->estado = $request->estado;
        $tipomaestroitem->tipomaestro_id = $request->tipomaestro_id;
        $tipomaestroitem->user_created_at = \Auth::user()->id;
        $tipomaestroitem->save();
        return redirect()->route('tiposmaestroitem.index')->with('info','El tipo maestro item fue registrado con éxito');
    }

    /**
     * Muestra el item  especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipomaestroitem = TipoMaestroItem::find($id);
        $tiposmaestro = TipoMaestro::all();
        return view('basico.tiposmaestroitem.show',[
            'tipomaestroitem'=>$tipomaestroitem,
            'tiposmaestro'=>$tiposmaestro,
            'disabled' => 'disabled'
        ]);
    }

    /**
     * Muestra el formulario para editar el item especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomaestroitem = TipoMaestroItem::find($id);
        $tiposmaestro = TipoMaestro::all();
        return view('basico.tiposmaestroitem.show',[
            'tipomaestroitem'=>$tipomaestroitem,
            'tiposmaestro'=>$tiposmaestro,
        ]);
    }

    /**
     * Actualiza el item especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoMaestroItemRequest $request, $id)
    {
        $tipomaestroitem = TipoMaestroItem::find($id);
        $tipomaestroitem->nombre = $request->nombre;
        $tipomaestroitem->numitem = $request->numitem;
        $tipomaestroitem->observacion = $request->observacion;
        $tipomaestroitem->estado = $request->estado;
        $tipomaestroitem->tipomaestro_id = $request->tipomaestro_id;
        $tipomaestroitem->user_updated_at = \Auth::user()->id;
        $tipomaestroitem->save();
        return redirect()->route('tiposmaestroitem.index')->with('info','El tipo maestro item fue actualizado con éxito');

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
