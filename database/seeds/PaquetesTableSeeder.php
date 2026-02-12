<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Paquete;

class PaquetesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::role('Administrador')->get();

        DB::table('paquetes')->insert([
            'name' => 'Config',
            'icon' => 'fa fa-cog',
            'url' => 'config',
            'observation' => 'nada',
            'state' => true,
        ]);

        DB::table('paquetes')->insert([
            'name' => 'Básicos',
            'icon' => 'fa fa-bars',
            'url' => 'basicos',
            'observation' => 'nada',
            'state' => true,
        ]);


        //Paquete de Emprendimiento
        $emprendimiento = new Paquete();
        $emprendimiento->name = "Emprendimiento";
        $emprendimiento->icon = "fa fa-briefcase";
        $emprendimiento->url = "emprendimiento";
        $emprendimiento->observation = "Emprendimiento";
        $emprendimiento->state = true;
        $emprendimiento->user_created_at = $admin[0]->id;
        $emprendimiento->user_updated_at = $admin[0]->id;
        $emprendimiento->save();   
        
        
        //Paquete de Vacantes
        $vacante = new Paquete();
        $vacante->name = "Vacantes";
        $vacante->icon = "fas fa-user-plus";
        $vacante->url = "vacantes";
        $vacante->observation = "Ofertas";
        $vacante->state = false;
        $vacante->user_created_at = $admin[0]->id;
        $vacante->user_updated_at = $admin[0]->id;
        $vacante->save();   


        //Paquete de Porgramación
        $vacante = new Paquete();
        $vacante->name = "Programción";
        $vacante->icon = "fa fa-folder-open";
        $vacante->url = "programacion";
        $vacante->observation = "programación academica";
        $vacante->state = false;
        $vacante->user_created_at = $admin[0]->id;
        $vacante->user_updated_at = $admin[0]->id;
        $vacante->save();   
        
        

    }
}
