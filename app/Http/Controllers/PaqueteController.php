<?php

namespace App\Http\Controllers;

//Requests
use App\Http\Requests\PaqueteRequest;
use Illuminate\Http\Request;

//Models
use App\Paquete;


/**
 * Gestion de Paquetes
 * 
 * Clase que se encarga de manipular la informacion de los paquetes
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Paquetes
 */
class PaqueteController extends Controller
{

   /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Paquetes'])->only(['index']);
        $this->middleware(['permission:Crear Paquete'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Paquete'])->only(['show','update']);
    }

   /**
     * Muestra una lista de paquetes.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = Paquete::all();
        return view('config.paquetes.index',[
            'paquetes'=>$paquetes,
        ]);
    }

     /**
     * Muestra el formulario para crear un nuevo paquete.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('config.paquetes.create');
    }

    /**
     * Almacena un paquete recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaqueteRequest $request)
    {
        $paquete = new Paquete;
        $paquete->name = $request->name;
        $paquete->url = $request->url;
        $paquete->icon = $request->icon;
        $paquete->observation = $request->observation;
        $paquete->state = $request->state;
        $paquete->user_created_at = \Auth::user()->id;
        $paquete->save();
        return redirect()->route('paquetes.index')->with('status','El paquete fue registrado con éxito');
    }

    /**
     * Muestra el paquete  especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paquete = Paquete::find($id);
        return view('config.paquetes.show',[
            'paquete'=>$paquete,
            'disabled' => 'disabled'
        ]);
    }

    /**
     * Muestre el formulario para editar el paquete especificado.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paquete = Paquete::find($id);
        return view('config.paquetes.show',[
            'paquete'=>$paquete,
        ]);
    }

   /**
     * Actualiza el paquete especificado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaqueteRequest $request, $id)
    {
        $paquete = Paquete::find($id);
        $paquete->name = $request->name;
        //$paquete->url = $request->url;
        $paquete->icon = $request->icon;
        $paquete->observation = $request->observation;
        $paquete->state = $request->state;
        $paquete->user_updated_at = \Auth::user()->id;
        $paquete->save();
        return redirect()->route('paquetes.index')->with('info','El paquete fue actualizado con éxito');
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
