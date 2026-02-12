<?php

namespace App\Http\Controllers;

//Request
use DB;

//Models
use App\User;

//Query
use App\Programas;
use Illuminate\Http\Request;
use App\Http\Requests\CrearProgramaRequest;
use App\Http\Requests\UpdateProgramaRequest;

/**
* Gestion programas academicos
* 
* Clase que se encarga de manipular la información de los programas academicos 
* 
* @author Freddy Popo <jhon.popo@correounivalle.edu.co>
* @package Programación
* @subpackage Programas
*/
class ProgramasController extends Controller
{
    
    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
    */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Salones'])->only(['index']);
        $this->middleware(['permission:Crear Salones'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Salones'])->only(['edit','update']);
    }
    
    
    /**
     * Muestra una lista de programas academicos que hay.
     * @author Freddy Popo <jhon.popo@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        $programas = Programas::all();
        return view('programacion.programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $coordinador = User::all(['id','name']);
        //dd($cordinador);
        return view('programacion.programas.create', compact('coordinador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearProgramaRequest $request)
    {
        //
        DB::beginTransaction();

        try{
            $programa = new Programas;
            $programa->codigo          = $request->codigo;
            $programa->nombre          = $request->nombre;
            $programa->email           = $request->email;
            $programa->coordinador_id  = $request->coordinador_id;
            $programa->estado          = ($request->estado == 1) ? true : false;
            $programa->user_created_at = \Auth::user()->id;
            $programa->save();
            DB::commit();//confirmar la peticion si todo esta bien
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();        
        }
        return redirect()->route('programas.index')->with('info','Programa Academico fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $programas     = Programas::findOrFail($id);
        $coordinador  = User::all(['id','name']);
        $disabled      = 'disabled';
        return view('programacion.programas.show',compact('programas','disabled','coordinador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $programas    = Programas::findOrFail($id);
        $coordinador  = User::all(['id','name']);
        return view('programacion.programas.show', compact('programas','coordinador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramaRequest $request, $id)
    {
        //
        DB::beginTransaction();        

        try{

            $programa                  = Programas::findOrFail($id);
            $programa->codigo          = $request->codigo;
            $programa->nombre          = $request->nombre;
            $programa->email           = $request->email;
            $programa->coordinador_id  = $request->coordinador_id;
            $programa->estado          = ($request->estado == 1) ? true : false;
            $programa->user_updated_at = \Auth::user()->id;
            $programa->save(); 
            DB::commit();//confirmar la peticion si todo esta bien

        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }
        return redirect()->route('programas.index')->with('info','Programa academico fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programas $programas)
    {
        //
    }
}
