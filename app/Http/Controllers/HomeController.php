<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Convocatoria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias = Convocatoria::all();        
        $reporte_convocatorias = [];
        $finalizados=[];
        $registrados=[];

        foreach($convocatorias as $convocatoria){
            
            $reporte_convocatorias[]=$convocatoria->nombre;
            $registrados[]=count($convocatoria->registradosfiltrados);
            $count_finalizados = 0;
            
            foreach($convocatoria->registradosfiltrados as $registrado){

                $user_finalizado = false;

                foreach($convocatoria->etapas as $etapa){
                    if(count($etapa->convocatoriaAvance()->wherePivot('convocatoria_id',$convocatoria->id)->wherePivot('user_id', $registrado->id)->wherePivot('finalizado', true)->get()) > 0){
                        $user_finalizado = true;
                    }else{
                        $user_finalizado = false;
                    }
                }

                if($user_finalizado){
                    $count_finalizados+=1;
                }
            }

            $finalizados[]=$count_finalizados;

        }

        return view('reportes.index',["datos"=>json_encode(["labels"=>$reporte_convocatorias,"registrados"=>$registrados,"finalizados"=>$finalizados]) ]);
    }


    public function email()
    {
        //dd("hola");
        return view('emprendimiento.emails.notificacion');
    }
}
