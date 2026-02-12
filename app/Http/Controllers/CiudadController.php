<?php

namespace App\Http\Controllers;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\CiudadRequest;

//Models
use App\Departamento;
use App\Ciudad;

//Query
use DB;

/**
 * Gestion Ciudades
 * 
 * Clase que se encarga de manipular la información de las ciudades
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Ciudades
 */
class CiudadController extends Controller
{
    /**
     * Cree una nueva instancia del controlador y se le asigna los permisos a cada metodo.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['permission:Listar Ciudad'])->only(['index']);
        $this->middleware(['permission:Crear Ciudad'])->only(['create','store']);
        $this->middleware(['permission:Actualizar Ciudad'])->only(['edit','update']);
    }

     /**
     * Muestra una lista de las ciudades.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        return view('basico.ciudades.index',['ciudades'=>$ciudades]);
    }

    /**
     * Muestra el formulario para crear un nueva ciudad.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all();
        $readonly = false;
        return view('basico.ciudades.create',['departamentos'=>$departamentos, 'readonly'=>$readonly]);
    }

    /**
     * Almacena una ciudad recién creado en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CiudadRequest $request)
    {
        $ciudad = new Ciudad;
        $ciudad->nombre = $request->nombre;
        $ciudad->codigo_dane = $request->codigo_dane;
        $ciudad->observacion = $request->observacion;
        $ciudad->departamento_id = $request->departamento_id;
        $ciudad->estado = $request->estado;
        $ciudad->user_created_at = \Auth::user()->id;
        $ciudad->save();

        return redirect()->route('ciudades.index')->with('info','La ciudad fue registrada con éxito');
    }

    /**
     * Muestra la ciudad  especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudad = Ciudad::find($id);
        $departamentos = Departamento::all();
        $readonly = true;
        return view('basico.ciudades.show',[
            'ciudad'=>$ciudad,
            'departamentos'=>$departamentos, 
            'disabled' => 'disabled',
            'readonly'=>$readonly
        ]);
    }

    /**
     * Muestra el formulario para editar la ciudad especificada.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudad = Ciudad::find($id);
        $departamentos = Departamento::all();
        $readonly = true;
        return view('basico.ciudades.show',[
            'ciudad'=>$ciudad,
            'departamentos'=>$departamentos,
            'readonly'=>$readonly
        ]);
    }

     /**
     * Actualiza la ciudad especificada en el almacenamiento.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ciudad = Ciudad::find($id);
       // $ciudad->nombre = $request->nombre;
       // $ciudad->codigo_dane = $request->codigo_dane;
        $ciudad->observacion = $request->observacion;
        $ciudad->departamento_id = $request->departamento_id;
        $ciudad->estado = $request->estado;
        $ciudad->user_updated_at = \Auth::user()->id;
        $ciudad->save();

        return redirect()->route('ciudades.index')->with('info','La ciudad fue actualizada con éxito');
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

    /**
     * Lista todas las ciudades de  un país
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Json Ciudades
     */
    public  function ajaxCiudadesPais(Request $request){

        $ciudades = DB::table('ciudades')->select("ciudades.*")
            ->join('departamentos as dep', 'ciudades.departamento_id','=','dep.id')
            ->join('paises as pais', 'dep.pais_id','=','pais.id')
            ->where('pais.id','=',$request->pais)
            ->orderBy('ciudades.nombre','ASC')
            ->get();

        return response()->json([
            'ciudades' => $ciudades,
        ]);
    }

    /**
     * Lista todas las ciudades de  un departamento
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Json Ciudades html<selected - option>
     */
    public function getAjaxCiudadesDepartamento(Request $request){
        
        $ciudades = Ciudad::select("*")->where("departamento_id",$request->departamento_id)->get();
        $ciudad_old = (isset($request->ciudad_old))? $request->ciudad_old : null;

        $html = "<option value='' >Seleccione una opción</option>";

        foreach($ciudades as $ciudad){
            if($ciudad_old == $ciudad->id){
                $html .= "<option value='".$ciudad->id."' selected>".$ciudad->nombre."</option>";
            }else{
                $html .= "<option value='".$ciudad->id."' >".$ciudad->nombre."</option>";
            }            
        }
        
        return response()->json([
            'ciudades' => $ciudades,
            'html' => $html,
        ]);
    }
}
