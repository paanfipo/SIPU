<?php

use Illuminate\Database\Seeder;
use App\Paquete;
use App\User;
use App\Dependencia;
use App\Modulo;
class DependenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::role('Administrador')->get();

        $financiera = new Dependencia();
        $financiera->codigo = "0001";
        $financiera->sede = "Sede Norte del Cauca";
        $financiera->nombre = "FINANCIERA";
        $financiera->user_created_at = $admin[0]->id;
        $financiera->user_updated_at = $admin[0]->id;
        $financiera->save();
         
        $bienes = new Dependencia();
        $bienes->codigo = "0002";
        $bienes->sede = "Sede Norte del Cauca";
        $bienes->nombre = "BIENES Y SERVICIOS";
        $bienes->user_created_at = $admin[0]->id;
        $bienes->user_updated_at = $admin[0]->id;
        $bienes->save();

        $direccion = new Dependencia();
        $direccion->codigo = "0003";
        $direccion->sede = "Sede Norte del Cauca";
        $direccion->nombre = "DIRECCIÓN";
        $direccion->user_created_at = $admin[0]->id;
        $direccion->user_updated_at = $admin[0]->id;
        $direccion->save();

        $calidad = new Dependencia();
        $calidad->codigo = "0004";
        $calidad->sede = "Sede Norte del Cauca";
        $calidad->nombre = "CALIDAD";
        $calidad->user_created_at = $admin[0]->id;
        $calidad->user_updated_at = $admin[0]->id;
        $calidad->save();       

        $gestion_documental = new Dependencia();
        $gestion_documental->codigo = "0005";
        $gestion_documental->sede = "Sede Norte del Cauca";
        $gestion_documental->nombre = "GESTION DOCUMENTAL";
        $gestion_documental->user_created_at = $admin[0]->id;
        $gestion_documental->user_updated_at = $admin[0]->id;
        $gestion_documental->save();

        $gestion_tic = new Dependencia();
        $gestion_tic->codigo = "0006";
        $gestion_tic->sede = "Sede Norte del Cauca";
        $gestion_tic->nombre = "GESTIÓN TIC";
        $gestion_tic->user_created_at = $admin[0]->id;
        $gestion_tic->user_updated_at = $admin[0]->id;
        $gestion_tic->save();       

        $recepcion = new Dependencia();
        $recepcion->codigo = "0007";
        $recepcion->sede = "Sede Norte del Cauca";
        $recepcion->nombre = "RECEPCIÓN";
        $recepcion->user_created_at = $admin[0]->id;
        $recepcion->user_updated_at = $admin[0]->id;
        $recepcion->save();      

        $practicas = new Dependencia();
        $practicas->codigo = "0008";
        $practicas->sede = "Sede Norte del Cauca";
        $practicas->nombre = "PRACTICAS";
        $practicas->user_created_at = $admin[0]->id;
        $practicas->user_updated_at = $admin[0]->id;
        $practicas->save();

        $apoyo_aux = new Dependencia();
        $apoyo_aux->codigo = "0009";
        $apoyo_aux->sede = "Sede Norte del Cauca";
        $apoyo_aux->nombre = "TECNICOS DE APOYO AUX";
        $apoyo_aux->user_created_at = $admin[0]->id;
        $apoyo_aux->user_updated_at = $admin[0]->id;
        $apoyo_aux->save();

        $secretaria = new Dependencia();
        $secretaria->codigo = "0010";
        $secretaria->sede = "Sede Norte del Cauca";
        $secretaria->nombre = "SECRETARIA ACADEMICA";
        $secretaria->user_created_at = $admin[0]->id;
        $secretaria->user_updated_at = $admin[0]->id;
        $secretaria->save();

        $pro_social = new Dependencia();
        $pro_social->codigo = "0011";
        $pro_social->sede = "Sede Norte del Cauca";
        $pro_social->nombre = "EXTENSIÓN Y PROYECCIÓN SOCIAL";
        $pro_social->user_created_at = $admin[0]->id;
        $pro_social->user_updated_at = $admin[0]->id;
        $pro_social->save();

        $biblioteca = new Dependencia();
        $biblioteca->codigo = "0012";
        $biblioteca->sede = "Sede Norte del Cauca";
        $biblioteca->nombre = "BIBLIOTECA";
        $biblioteca->user_created_at = $admin[0]->id;
        $biblioteca->user_updated_at = $admin[0]->id;
        $biblioteca->save();

        $bienestar = new Dependencia();
        $bienestar->codigo = "0013";
        $bienestar->sede = "Sede Norte del Cauca";
        $bienestar->nombre = "BIENESTAR";
        $bienestar->user_created_at = $admin[0]->id;
        $bienestar->user_updated_at = $admin[0]->id;
        $bienestar->save();
        
        /*Dependencias Carreras**/
        $tecnologias = new Dependencia();
        $tecnologias->codigo = "1001";
        $tecnologias->sede = "Sede Norte del Cauca";
        $tecnologias->nombre = "TECNOLOGÍA EN SISTEMAS";
        $tecnologias->user_created_at = $admin[0]->id;
        $tecnologias->user_updated_at = $admin[0]->id;
        $tecnologias->save();

        $matematicas = new Dependencia();
        $matematicas->codigo = "1002";
        $matematicas->sede = "Sede Norte del Cauca";
        $matematicas->nombre = "LICENCIATURA EN MATEMATICAS";
        $matematicas->user_created_at = $admin[0]->id;
        $matematicas->user_updated_at = $admin[0]->id;
        $matematicas->save();


        $tra_social = new Dependencia();
        $tra_social->codigo = "1003";
        $tra_social->sede = "Sede Norte del Cauca";
        $tra_social->nombre = "TRABAJO SOCIAL";
        $tra_social->user_created_at = $admin[0]->id;
        $tra_social->user_updated_at = $admin[0]->id;
        $tra_social->save();

        $cont_publica = new Dependencia();
        $cont_publica->codigo = "1004";
        $cont_publica->sede = "Sede Norte del Cauca";
        $cont_publica->nombre = "CONTADURIA PUBLICA";
        $cont_publica->user_created_at = $admin[0]->id;
        $cont_publica->user_updated_at = $admin[0]->id;
        $cont_publica->save();

        $ad_empresas = new Dependencia();
        $ad_empresas->codigo = "1005";
        $ad_empresas->sede = "Sede Norte del Cauca";
        $ad_empresas->nombre = "ADMINISTRACIÓN DE EMPRESAS";
        $ad_empresas->user_created_at = $admin[0]->id;
        $ad_empresas->user_updated_at = $admin[0]->id;
        $ad_empresas->save();
    }
}
