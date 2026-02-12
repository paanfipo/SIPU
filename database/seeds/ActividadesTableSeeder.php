<?php

use Illuminate\Database\Seeder;
use App\Paquete;
use App\User;
use App\Modulo;
use App\Etapa;
use App\Actividad;

class ActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::role('Administrador')->get();

        //---------------------Sensibilización - 1 ---------------------
        $sensibilizacion =  Etapa::where('nombre','SENSIBILIZACIÓN')->get();

        $sensibilizacionAc = new Actividad();
        $sensibilizacionAc->nombre = "Bienvenido";
        $sensibilizacionAc->descripcion = "Bienevenido";
        $sensibilizacionAc->etapa_id = $sensibilizacion[0]->id;
        $sensibilizacionAc->personalizacion = false;
        $sensibilizacionAc->user_created_at = $admin[0]->id;
        $sensibilizacionAc->user_updated_at = $admin[0]->id;
        $sensibilizacionAc->save();

        $inscripciones = new Actividad();
        $inscripciones->nombre = "Inscripciones (Software)";
        $inscripciones->descripcion = "descripción";
        $inscripciones->etapa_id = $sensibilizacion[0]->id;
        $inscripciones->personalizacion = false;
        $inscripciones->user_created_at = $admin[0]->id;
        $inscripciones->user_updated_at = $admin[0]->id;
        $inscripciones->save();

        /*$seleccion = new Actividad();
        $seleccion ->nombre = "Selección";
        $seleccion ->descripcion = "descripción";
        $seleccion ->etapa_id = $sensibilizacion[0]->id;
        $seleccion->personalizacion = false;
        $seleccion ->user_created_at = $admin[0]->id;
        $seleccion ->user_updated_at = $admin[0]->id;
        $seleccion ->save();*/

        //---------------------PREINCUBACIÓN - 2 ---------------------
        $preincubacion =  Etapa::where('nombre','PREINCUBACIÓN')->get();

        $dIniciativaE = new Actividad();
        $dIniciativaE->nombre = "Diagnóstico de la iniciativa E";
        $dIniciativaE->descripcion = "descripción";
        $dIniciativaE->etapa_id = $preincubacion[0]->id;
        $dIniciativaE->user_created_at = $admin[0]->id;
        $dIniciativaE->user_updated_at = $admin[0]->id;
        $dIniciativaE->save();

        /*$valoracion = new Actividad();
        $valoracion->nombre = "Valoración Equipo de trabajo";
        $valoracion->descripcion = "descripción";
        $valoracion->etapa_id = $preincubacion[0]->id;
        $valoracion->user_created_at = $admin[0]->id;
        $valoracion->user_updated_at = $admin[0]->id;
        $valoracion->save();

        $vIniciativaE = new Actividad();
        $vIniciativaE->nombre = "Valoración iniciativa E";
        $vIniciativaE->descripcion = "descripción";
        $vIniciativaE->etapa_id = $preincubacion[0]->id;
        $vIniciativaE->user_created_at = $admin[0]->id;
        $vIniciativaE->user_updated_at = $admin[0]->id;
        $vIniciativaE->save();

        $habilidadesB = new Actividad();
        $habilidadesB->nombre = "Habilidades blandas";
        $habilidadesB->descripcion = "descripción";
        $habilidadesB->etapa_id = $preincubacion[0]->id;
        $habilidadesB->user_created_at = $admin[0]->id;
        $habilidadesB->user_updated_at = $admin[0]->id;
        $habilidadesB->save();

        $ideacion = new Actividad();
        $ideacion->nombre = "Ideación";
        $ideacion->descripcion = "descripción";
        $ideacion->etapa_id = $preincubacion[0]->id;
        $ideacion->user_created_at = $admin[0]->id;
        $ideacion->user_updated_at = $admin[0]->id;
        $ideacion->save();

        $validacion = new Actividad();
        $validacion->nombre = "Validación";
        $validacion->descripcion = "descripción";
        $validacion->etapa_id = $preincubacion[0]->id;
        $validacion->user_created_at = $admin[0]->id;
        $validacion->user_updated_at = $admin[0]->id;
        $validacion->save();

        $protipado = new Actividad();
        $protipado->nombre = "Prototipado";
        $protipado->descripcion = "descripción";
        $protipado->etapa_id = $preincubacion[0]->id;
        $protipado->user_created_at = $admin[0]->id;
        $protipado->user_updated_at = $admin[0]->id;
        $protipado->save();

        $mNegocio = new Actividad();
        $mNegocio->nombre = "Modelo de negocio";
        $mNegocio->descripcion = "descripción";
        $mNegocio->etapa_id = $preincubacion[0]->id;
        $mNegocio->user_created_at = $admin[0]->id;
        $mNegocio->user_updated_at = $admin[0]->id;
        $mNegocio->save();*/


        //---------------------INCUBACIÓN - 3 -----------------------
        $incubacion =  Etapa::where('nombre','INCUBACIÓN (ASESORIAS)')->get();

        $pitch = new Actividad();
        $pitch->nombre = "Presentación Pitch";
        $pitch->descripcion = "descripción";
        $pitch->etapa_id = $incubacion[0]->id;
        $pitch->user_created_at = $admin[0]->id;
        $pitch->user_updated_at = $admin[0]->id;
        $pitch->save();

        /*$dMDM = new Actividad();
        $dMDM->nombre = "Diagnóstico MDN";
        $dMDM->descripcion = "descripción";
        $dMDM->etapa_id = $incubacion[0]->id;
        $dMDM->user_created_at = $admin[0]->id;
        $dMDM->user_updated_at = $admin[0]->id;
        $dMDM->save();

        $diseñoPA = new Actividad();
        $diseñoPA->nombre = "Diseño plan acción";
        $diseñoPA->descripcion = "descripción";
        $diseñoPA->etapa_id = $incubacion[0]->id;
        $diseñoPA->user_created_at = $admin[0]->id;
        $diseñoPA->user_updated_at = $admin[0]->id;
        $diseñoPA->save();

        $ejecucionPA = new Actividad();
        $ejecucionPA->nombre = "Ejecución plan";
        $ejecucionPA->descripcion = "descripción";
        $ejecucionPA->etapa_id = $incubacion[0]->id;
        $ejecucionPA->user_created_at = $admin[0]->id;
        $ejecucionPA->user_updated_at = $admin[0]->id;
        $ejecucionPA->save();

        $fortalecimientoPA = new Actividad();
        $fortalecimientoPA->nombre = "Fortalecimiento del proceso administrativo";
        $fortalecimientoPA->descripcion = "descripción";
        $fortalecimientoPA->etapa_id = $incubacion[0]->id;
        $fortalecimientoPA->user_created_at = $admin[0]->id;
        $fortalecimientoPA->user_updated_at = $admin[0]->id;
        $fortalecimientoPA->save();

        $trabajoRed = new Actividad();
        $trabajoRed->nombre = "Trabajo en Red";
        $trabajoRed->descripcion = "descripción";
        $trabajoRed->etapa_id = $incubacion[0]->id;
        $trabajoRed->user_created_at = $admin[0]->id;
        $trabajoRed->user_updated_at = $admin[0]->id;
        $trabajoRed->save();

        $gestionFF = new Actividad();
        $gestionFF->nombre = "Gestión fuente de financiación";
        $gestionFF->descripcion = "descripción";
        $gestionFF->etapa_id = $incubacion[0]->id;
        $gestionFF->user_created_at = $admin[0]->id;
        $gestionFF->user_updated_at = $admin[0]->id;
        $gestionFF->save();*/

        //---------------------ACELERACIÓN - 4 -----------------------
        $aceleracion =  Etapa::where('nombre','ACELERACIÓN')->get();

        $innovacion = new Actividad();
        $innovacion->nombre = "Innovación";
        $innovacion->descripcion = "descripción";
        $innovacion->etapa_id = $aceleracion[0]->id;
        $innovacion->user_created_at = $admin[0]->id;
        $innovacion->user_updated_at = $admin[0]->id;
        $innovacion->save();

        /*$gestionAlianzas = new Actividad();
        $gestionAlianzas->nombre = "Generación de alianzas";
        $gestionAlianzas->descripcion = "descripción";
        $gestionAlianzas->etapa_id = $aceleracion[0]->id;
        $gestionAlianzas->user_created_at = $admin[0]->id;
        $gestionAlianzas->user_updated_at = $admin[0]->id;
        $gestionAlianzas->save();

        $alianzaClusters = new Actividad();
        $alianzaClusters->nombre = "Alianza con Clústers";
        $alianzaClusters->descripcion = "descripción";
        $alianzaClusters->etapa_id = $aceleracion[0]->id;
        $alianzaClusters->user_created_at = $admin[0]->id;
        $alianzaClusters->user_updated_at = $admin[0]->id;
        $alianzaClusters->save();

        $fortalecimientoAso = new Actividad();
        $fortalecimientoAso->nombre = "Fortalecimiento de la asociatividad";
        $fortalecimientoAso->descripcion = "descripción";
        $fortalecimientoAso->etapa_id = $aceleracion[0]->id;
        $fortalecimientoAso->user_created_at = $admin[0]->id;
        $fortalecimientoAso->user_updated_at = $admin[0]->id;
        $fortalecimientoAso->save();*/

        
    }
}
