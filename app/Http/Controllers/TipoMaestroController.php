<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\TipoMaestroRequest;

//Models
use App\TipoMaestro;
use App\TipoMaestroItem;

//Query
use DB;

/**
 * Gestion Tipo Maestro
 * 
 * Clase que se encarga de manipular la información de los tipos maestros
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo Maestro
 */
class TipoMaestroController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Tipo Maestro'])->only(['index']);
        $this->middleware(['permission:Crear Tipo Maestro'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Tipo Maestro'])->only(['edit','update']);
    }

    /**
     * Muestra una lista de los maestros.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposmaestro = TipoMaestro::all();
        return view('basico.tiposmaestro.index',[
            'tiposmaestro'=>$tiposmaestro,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo maestro.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $readonly = false;
        return view('basico.tiposmaestro.create',['readonly' => $readonly]);
    }

    /**
     * Almacena un maestro recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMaestroRequest $request)
    {
        DB::beginTransaction();

        try{

            $tipomaestro = new TipoMaestro;
            $tipomaestro->nombre = $request->nombre;
            $tipomaestro->observacion = $request->observacion;
            $tipomaestro->estado = $request->estado;
            $tipomaestro->user_created_at = \Auth::user()->id;
            $tipomaestro->save();           
            
            $items = $request->items;
            foreach($items as $item){
                //dd($item);
                $tipomaestroitem = new TipoMaestroItem;
                $tipomaestroitem->nombre = $item["name"];
                $tipomaestroitem->numitem = $item["num"];
                $tipomaestroitem->observacion = $item["note"];
                $tipomaestroitem->estado = $item["state"];
                $tipomaestroitem->tipomaestro_id = $tipomaestro->id;
                $tipomaestroitem->user_created_at = \Auth::user()->id;                
                $tipomaestroitem->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('tiposmaestro.index')->with('info','El tipo maestro fue registrado con éxito');
        
    }

    /**
     * Muestra el maestro especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipomaestro = TipoMaestro::find($id);
        return view('basico.tiposmaestro.show',[
            'tipomaestro'=>$tipomaestro,
            'disabled' => 'disabled'
        ]);
    }

    /**
     * Muestra el formulario para editar el maestro especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomaestro = TipoMaestro::find($id);
        $readonly = true;
        return view('basico.tiposmaestro.show',[
            'tipomaestro'=>$tipomaestro,
            'readonly' => $readonly

        ]);
    }

     /**
     * Actualiza el maestro especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        DB::beginTransaction();

        try{
            
            $tipomaestro = TipoMaestro::find($id);
            //$tipomaestro->nombre = $request->nombre;
            $tipomaestro->observacion = $request->observacion;
            $tipomaestro->estado = $request->estado;
            $tipomaestro->user_updated_at = \Auth::user()->id;
            $tipomaestro->save(); 

            DB::commit();
        } catch (\Exception $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();

        } catch (\Throwable $e) {
            return back()
                ->with('error', "Hubo un error comuniquese con soporte!!<br>".$e->getMessage())->withInput();
        }

        return redirect()->route('tiposmaestro.index')->with('info','El tipo maestro fue actualizado con éxito');
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
