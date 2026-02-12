<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\DepartamentoRequest;

//Models
use App\Departamento;
use App\Pais;


/**
 * Gestion Departamentos
 * 
 * Clase que se encarga de manipular la información de los departamentos
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Departamentos
 */
class DepartamentoController extends Controller
{

    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Departamentos'])->only(['index']);
        $this->middleware(['permission:Crear Departamento'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Departamento'])->only(['edit','update']);
    }

    /**
     * Muestra una lista de los departamentos.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();
        return view('basico.departamentos.index',['departamentos'=>$departamentos]);
    }

    /**
     * Muestra el formulario para crear un nuevo departamento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        $readonly=false;
        return view('basico.departamentos.create',['paises'=>$paises,'readonly'=>$readonly]);
    }

    /**
     * Almacena un departamento recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        $departamento = new Departamento;
        $departamento->nombre = $request->nombre;
        $departamento->codigo_dane = $request->codigo_dane;
        $departamento->observacion = $request->observacion;
        $departamento->pais_id = $request->pais_id;
        $departamento->estado = $request->estado;
        $departamento->user_created_at = \Auth::user()->id;
        $departamento->save();

        return redirect()->route('departamentos.index')->with('info','El departamento fue registrado con éxito');
    }

    /**
     * Muestra el departamento  especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamento::find($id);
        $paises = Pais::all();
        $readonly=false;
        return view('basico.departamentos.show',[
            'departamento'=>$departamento,
            'paises'=>$paises,
            'disabled' => 'disabled',
            'readonly'=>$readonly
        ]);
    }

     /**
     * Muestra el formulario para editar el departamento especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::find($id);
        $paises = Pais::all();
        $readonly=true;
        return view('basico.departamentos.show',[
            'departamento'=>$departamento,
            'paises'=>$paises,
            'readonly'=>$readonly                        
        ]);
    }

    /**
     * Actualiza el departamento especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);
        //$departamento->nombre = $request->nombre;
        //$departamento->codigo_dane = $request->codigo_dane;
        $departamento->observacion = $request->observacion;
        $departamento->pais_id = $request->pais_id;
        $departamento->estado = $request->estado;
        $departamento->user_updated_at = \Auth::user()->id;
        $departamento->save();

        return redirect()->route('departamentos.index')->with('info','El departamento fue actualizado con éxito');
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
