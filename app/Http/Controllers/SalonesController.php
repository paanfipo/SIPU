<?php

namespace App\Http\Controllers;

//Request
use DB;

//Models
use App\TipoMaestro;
use App\Salones;

//Query
use Illuminate\Http\Request;
use App\Http\Requests\CrearSalonRequest;
use App\Http\Requests\UpdateSalonRequest;

/**
 * Gestion Salones
 * 
 * Clase que se encarga de manipular la información de los salones 
 * 
 * @author Freddy Popo <jhon.popo@correounivalle.edu.co>
 * @package Programación
 * @subpackage Salones
 */
class SalonesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salones = Salones::all();
        return view('programacion.salones.index', compact('salones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $universidad = TipoMaestro::where('nombre','Universidad')->first()->tiposmaestroitem;
        return view('programacion.salones.create',compact('universidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearSalonRequest $request)
    {
        DB::beginTransaction();

        try{
            $salon = new Salones;
            $salon->numero          = $request->numero;
            $salon->capacidad       = $request->capacidad;
            $salon->estado          = ($request->estado == 1) ? true : false;
            $salon->universidad     = $request->universidad;
            $salon->user_created_at = \Auth::user()->id;
            $salon->save();
            DB::commit();//confirmar la peticion si todo esta bien
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();        
        }
        return redirect()->route('salones.index')->with('info','Salón fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $salon     = Salones::find($id);
        $universidad = TipoMaestro::where('nombre','Universidad')->first()->tiposmaestroitem;
        $disabled = 'disabled';
        return view('programacion.salones.show',compact('salon','universidad','disabled'));
    }

    /**
     * Muestra el formulario para editar un salón.
     * @author Jhon Popo <jhon.popo@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $salon     = Salones::find($id);
        $universidad = TipoMaestro::where('nombre','Universidad')->first()->tiposmaestroitem;
        return view('programacion.salones.show', compact('salon','universidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalonRequest $request, $id)
    {
        //
        DB::beginTransaction();        

        try{

            $salon                  = Salones::find($id);
            $salon->numero          = $request->numero;
            $salon->capacidad       = $request->capacidad;
            $salon->estado          = ($request->estado == 1) ? true : false;
            $salon->universidad     = $request->universidad;
            $salon->observacion     = $request->observacion;
            $salon->user_updated_at = \Auth::user()->id;
            $salon->save(); 
            DB::commit();

        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }
        return redirect()->route('salones.index')->with('info','Salón fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salones  $salones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salones $salones)
    {
        //
    }
}
