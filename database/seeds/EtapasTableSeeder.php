<?php

use Illuminate\Database\Seeder;
use App\Paquete;
use App\User;
use App\Modulo;
use App\Etapa;
class EtapasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::role('Administrador')->get();

        $sensibilizacion = new Etapa();
        $sensibilizacion->nombre = "SENSIBILIZACIÓN";
        $sensibilizacion->descripcion = "capturar una hoja de respuestas de excel del formulario de google drive para crear por defecto las cuentas de usuario";
        $sensibilizacion->state = true;
        $sensibilizacion->user_created_at = $admin[0]->id;
        $sensibilizacion->user_updated_at = $admin[0]->id;
        $sensibilizacion->save();

        $preincubacion = new Etapa();
        $preincubacion->nombre = "PREINCUBACIÓN";
        $preincubacion->descripcion = "Se debe mostrar el listado de las personas que asistieron a la etapa de sensibilización
        En cada asistente debe existir un botón que se llama editar. ";
        $preincubacion->state = true;
        $preincubacion->user_created_at = $admin[0]->id;
        $preincubacion->user_updated_at = $admin[0]->id;
        $preincubacion->save();

        $incubacion = new Etapa();
        $incubacion->nombre = "INCUBACIÓN (ASESORIAS)";
        $incubacion->descripcion = "En cada asesoria se debe cargar el formulario con los datos del participante mostrando
        todas las actividades en las que ha participado y las observaciones que ha realizado tanto el asesor como 
        el participante mismo.";
        $incubacion->state = false;
        $incubacion->user_created_at = $admin[0]->id;
        $incubacion->user_updated_at = $admin[0]->id;
        $incubacion->save();

        $aceleracion = new Etapa();
        $aceleracion->nombre = "ACELERACIÓN";
        $aceleracion->descripcion = "Asesorias tienen un costo y el asesor puede redirigir a otra dependencia. 
        El asesor agenda la cita y se habilitan las observaciones del asesor y del participante";
        $aceleracion->state = false;
        $aceleracion->user_created_at = $admin[0]->id;
        $aceleracion->user_updated_at = $admin[0]->id;
        $aceleracion->save();




    }
}
