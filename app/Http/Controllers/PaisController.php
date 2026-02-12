<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\PaisRequest;

//Model
use App\Pais;

/**
 * Gestion Paises
 * 
 * Clase que se encarga de manipular la informacion de los paises
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Paises
 */
class PaisController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Paises'])->only(['index']);
        $this->middleware(['permission:Crear Pais'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Pais'])->only(['edit','update']);
    }

   /**
     * Muestra una lista de los paises.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::all();
        return view('basico.paises.index',['paises'=>$paises]);
    }

    /**
     * Muestra el formulario para crear un nuevo país.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $readonly = false;
        return view('basico.paises.create',['readonly'=>$readonly]);
    }

    /**
     * Almacena un país recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaisRequest $request)
    {
        $pais = new Pais;
        $pais->nombre = $request->nombre;
        $pais->codigo_dane = $request->codigo_dane;
        $pais->codigo_iso = $request->codigo_iso;
        $pais->estado = $request->estado;
        $pais->user_created_at = \Auth::user()->id;
        $pais->save();
        return redirect()->route('paises.index')->with('info','El pais fue registrado con éxito');
    }

    /**
     * Muestra el país  especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pais = Pais::find($id);
        $readonly = false;
        return view('basico.paises.show',['pais'=>$pais, 'disabled' => 'disabled','readonly'=>$readonly]);
    }

    /**
     * Muestra el formulario para editar el país especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pais = Pais::find($id);
        $readonly = true;
        return view('basico.paises.show',['pais'=>$pais,'readonly'=>$readonly]);
    }

    /**
     * Actualiza el país especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pais = Pais::find($id);
        $pais->nombre = $request->nombre;
        //$pais->codigo_dane = $request->codigo_dane;
        //$pais->codigo_iso = $request->codigo_iso;
        $pais->estado = $request->estado;
        $pais->user_updated_at = \Auth::user()->id;
        $pais->save();
        return redirect()->route('paises.index')->with('info','El pais fue actualizado con éxito');
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
