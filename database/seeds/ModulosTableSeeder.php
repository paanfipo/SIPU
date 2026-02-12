<?php

use Illuminate\Database\Seeder;
use App\Paquete;
use App\User;
use App\Modulo;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::role('Administrador')->get();

        //Paquete: Config
        DB::table('modulos')->insert([
            'name' => 'Roles',
            'url' => 'roles',
            'paquete_id' => 1,
            'icon' => 'fa fa-tag',
            'observation' => 'nada',
            'position' => 1,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Paquetes',
            'url' => 'paquetes',
            'paquete_id' => 1,
            'icon' => 'fa fa-th-large',
            'observation' => 'nada',
            'position' => 2,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Modulos',
            'url' => 'modulos',
            'paquete_id' => 1,
            'icon' => 'fa fa-th',
            'observation' => 'nada',
            'position' => 3,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Permisos',
            'url' => 'permisos',
            'paquete_id' => 1,
            'icon' => 'fa fa-id-badge',
            'observation' => 'nada',
            'position' => 4,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Maestro e Items',
            'url' => 'tiposmaestro',
            'paquete_id' => 2,
            'icon' => 'fa fa-circle',
            'observation' => 'nada',
            'position' => 5,
            'state' => true,
        ]);



        //Paquete: Basicos

        "DB::table('modulos')->insert([
            'name' => 'Tipo Maestro Item',
            'url' => 'tiposmaestroitem',
            'paquete_id' => 2,
            'icon' => 'fa fa-list-ol',
            'observation' => 'nada',
            'position' => 1,
            'state' => true,
        ]);";

        DB::table('modulos')->insert([
            'name' => 'Paises',
            'url' => 'paises',
            'paquete_id' => 2,
            'icon' => 'fa fa-globe',
            'observation' => 'nada',
            'position' => 2,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Departamentos',
            'url' => 'departamentos',
            'paquete_id' => 2,
            'icon' => 'fa fa-map',
            'observation' => 'nada',
            'position' => 3,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Ciudades',
            'url' => 'ciudades',
            'paquete_id' => 2,
            'icon' => 'fa fa-flag',
            'observation' => 'nada',
            'position' => 4,
            'state' => true,
        ]);

        DB::table('modulos')->insert([
            'name' => 'Usuario',
            'url' => 'usuarios',
            'paquete_id' => 2,
            'icon' => 'fa fa-user',
            'observation' => 'nada',
            'position' => 5,
            'state' => true,
        ]);

        //Emprendimeinto
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $convocatoria = new Modulo();
        $convocatoria->name = 'Convocatorias';
        $convocatoria->url = 'convocatorias';
        $convocatoria->paquete_id = $emprendimiento->id;
        $convocatoria->icon = 'fa fa-bullhorn';
        $convocatoria->observation = 'Convocatorias';
        $convocatoria->position = 1;
        $convocatoria->state = true;
        $convocatoria->user_created_at = $admin[0]->id;
        $convocatoria->user_updated_at = $admin[0]->id;
        $convocatoria->save();

        //Etapas
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $etapa = new Modulo();
        $etapa->name = 'Etapas';
        $etapa->url = 'etapas';
        $etapa->paquete_id = $emprendimiento->id;
        $etapa->icon = 'fa fa-clone';
        $etapa->observation = 'Etapas de etapa';
        $etapa->position = 2;
        $etapa->state = true;
        $etapa->user_created_at = $admin[0]->id;
        $etapa->user_updated_at = $admin[0]->id;
        $etapa->save();

        //Carreras
        $basicos = Paquete::where('url','basicos')->first();

        $carrera = new Modulo();
        $carrera->name = 'Carreras';
        $carrera->url = 'carreras';
        $carrera->paquete_id = $basicos->id;
        $carrera->icon = 'fa fa-university';
        $carrera->observation = 'Carreras';
        $carrera->position = 7;
        $carrera->state = true;
        $carrera->user_created_at = $admin[0]->id;
        $carrera->user_updated_at = $admin[0]->id;
        $carrera->save();

        //Dependencias
        $basicos = Paquete::where('url','basicos')->first();

        $dependencia = new Modulo();
        $dependencia->name = 'Dependencias';
        $dependencia->url = 'dependencias';
        $dependencia->paquete_id = $basicos->id;
        $dependencia->icon = 'fa fa-bars';
        $dependencia->observation = 'Dependencias';
        $dependencia->position = 8;
        $dependencia->state = true;
        $dependencia->user_created_at = $admin[0]->id;
        $dependencia->user_updated_at = $admin[0]->id;
        $dependencia->save();

        //Actividades
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $actividades = new Modulo();
        $actividades->name = 'Actividades';
        $actividades->url = 'actividades';
        $actividades->paquete_id = $emprendimiento->id;
        $actividades->icon = 'fas fa-snowboarding';
        $actividades->observation = 'Actividades';
        $actividades->position = 3;
        $actividades->state = true;
        $actividades->user_created_at = $admin[0]->id;
        $actividades->user_updated_at = $admin[0]->id;
        $actividades->save();

        //Cronogramas
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $cronograma = new Modulo();
        $cronograma->name = 'Cronogramas';
        $cronograma->url = 'cronogramas';
        $cronograma->paquete_id = $emprendimiento->id;
        $cronograma->icon = 'fas fa-calendar-alt';
        $cronograma->observation = 'Cronogramas';
        $cronograma->position = 4;
        $cronograma->state = true;
        $cronograma->user_created_at = $admin[0]->id;
        $cronograma->user_updated_at = $admin[0]->id;
        $cronograma->save();

        //Asistencia
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $cronograma = new Modulo();
        $cronograma->name = 'Asistencia';
        $cronograma->url = 'asistencias';
        $cronograma->paquete_id = $emprendimiento->id;
        $cronograma->icon = 'fas fa-clipboard-check';
        $cronograma->observation = 'Asistencia';
        $cronograma->position = 5;
        $cronograma->state = true;
        $cronograma->user_created_at = $admin[0]->id;
        $cronograma->user_updated_at = $admin[0]->id;
        $cronograma->save();

        //Gestiones
        $emprendimiento = Paquete::where('url','emprendimiento')->first();

        $cronograma = new Modulo();
        $cronograma->name = 'Gestiones';
        $cronograma->url = 'gestiones';
        $cronograma->paquete_id = $emprendimiento->id;
        $cronograma->icon = 'fas fa-shoe-prints';
        $cronograma->observation = 'Gestiones';
        $cronograma->position = 6;
        $cronograma->state = true;
        $cronograma->user_created_at = $admin[0]->id;
        $cronograma->user_updated_at = $admin[0]->id;
        $cronograma->save();

        
        
        //Paquete de Vacantes
        $vacante = Paquete::where('url','vacantes')->first();

        //Laborales
        $laboral = new Modulo();
        $laboral->name = 'Ofertas';
        $laboral->url = 'ofertas';
        $laboral->paquete_id = $vacante->id;
        $laboral->icon = 'fas fa-clipboard-check';
        $laboral->observation = 'Ofertas Laborales';
        $laboral->position = 1;
        $laboral->state = true;
        $laboral->user_created_at = $admin[0]->id;
        $laboral->user_updated_at = $admin[0]->id;
        $laboral->save();       

        $tramite = new Modulo();
        $tramite->name = 'Trámites';
        $tramite->url = 'tramites';
        $tramite->paquete_id = $vacante->id;
        $tramite->icon = 'fas fa-shoe-prints';
        $tramite->observation = 'Trámites';
        $tramite->position = 4;
        $tramite->state = true;
        $tramite->user_created_at = $admin[0]->id;
        $tramite->user_updated_at = $admin[0]->id;
        $tramite->save();

        $programacion = Paquete::where('url','programacion')->first();

        $salones = new Modulo();
        $salones->name = 'Salones';
        $salones->url = 'salones';
        $salones->paquete_id = $programacion->id;
        $salones->icon = 'fa fa-tags';
        $salones->observation = 'Salones';
        $salones->position = 1;
        $salones->state = true;
        $salones->user_created_at = $admin[0]->id;
        $salones->user_updated_at = $admin[0]->id;
        $salones->save();

        /*modulo de programas academicos*/
        $programa = new Modulo();
        $programa->name = 'Programas';
        $programa->url = 'programas';
        $programa->paquete_id = $programacion->id;
        $programa->icon = 'fa fa-list-alt';
        $programa->observation = 'Programas academíco';
        $programa->position = 2;
        $programa->state = true;
        $programa->user_created_at = $admin[0]->id;
        $programa->user_updated_at = $admin[0]->id;
        $programa->save();
    }
}
