<?php

use Illuminate\Database\Seeder;
use App\Paquete;
use App\User;
use App\Carrera;
use App\Modulo;

class CarrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::role('Administrador')->get();


        //pregrados 
        $administracion_Empresa = new Carrera();
        $administracion_Empresa->codigo = '3845';
        $administracion_Empresa->nombre = 'Administración de Empresas';
        $administracion_Empresa->email = 'administracion.empresas.ncauca@correounivalle.edu.co ';
        $administracion_Empresa->user_created_at = $admin[0]->id;
        $administracion_Empresa->user_updated_at = $admin[0]->id;
        $administracion_Empresa->save();

        $contaduria = new Carrera();
        $contaduria->codigo = '3841';
        $contaduria->nombre = 'Contaduría';
        $contaduria->email = 'contaduria.ncauca@correounivalle.edu.co ';
        $contaduria->user_created_at = $admin[0]->id;
        $contaduria->user_updated_at = $admin[0]->id;
        $contaduria->save();

        $licenciatura_Matematicas = new Carrera();
        $licenciatura_Matematicas->codigo = '3469';
        $licenciatura_Matematicas->nombre = 'Licenciatura en Educación Básica con énfasis en Matemáticas';
        $licenciatura_Matematicas->email = 'licenciatura.matematicas.ncauca@correounivalle.edu.co';
        $licenciatura_Matematicas->user_created_at = $admin[0]->id;
        $licenciatura_Matematicas->user_updated_at = $admin[0]->id;
        $licenciatura_Matematicas->save();

        $tecnologia_Sistemas = new Carrera();
        $tecnologia_Sistemas->codigo = '2711';
        $tecnologia_Sistemas->nombre = 'Tecnología en Sistemas de Información';
        $tecnologia_Sistemas->email = 'programa.tsi.ncauca@correounivalle.edu.co';
        $tecnologia_Sistemas->user_created_at = $admin[0]->id;
        $tecnologia_Sistemas->user_updated_at = $admin[0]->id;
        $tecnologia_Sistemas->save();

        $trabajo_Social = new Carrera();
        $trabajo_Social->codigo = '3249';
        $trabajo_Social->nombre = 'Trabajo Social';
        $trabajo_Social->email = 'trabajo.social.ncauca@correounivalle.edu.co';
        $trabajo_Social->user_created_at = $admin[0]->id;
        $trabajo_Social->user_updated_at = $admin[0]->id;
        $trabajo_Social->save();

        $talento_Humano = new Carrera();
        $talento_Humano->codigo = '2838';
        $talento_Humano->nombre = 'Tecnología en Gestión del Talento Humano';
        $talento_Humano->email = '0'; //Se desconoce la información
        $talento_Humano->user_created_at = $admin[0]->id;
        $talento_Humano->user_updated_at = $admin[0]->id;
        $talento_Humano->save();

        $tecnologia_Calidad = new Carrera();
        $tecnologia_Calidad->codigo = '2837';
        $tecnologia_Calidad->nombre = 'Tecnología en Gestión de la Calidad';
        $tecnologia_Calidad->email = 'gestiondelacalidad.nortedelcauca@correounivalle.edu.co';
        $tecnologia_Calidad->user_created_at = $admin[0]->id;
        $tecnologia_Calidad->user_updated_at = $admin[0]->id;
        $tecnologia_Calidad->save();

        $tecnologia_Logistica = new Carrera();
        $tecnologia_Logistica->codigo = '2839';
        $tecnologia_Logistica->nombre = 'Tecnología en Gestión Logística';
        $tecnologia_Logistica->email = '0'; //Se desconoce la información
        $tecnologia_Logistica->user_created_at = $admin[0]->id;
        $tecnologia_Logistica->user_updated_at = $admin[0]->id;
        $tecnologia_Logistica->save();

        $estudios_Politicos = new Carrera();
        $estudios_Politicos->codigo = '3489';
        $estudios_Politicos->nombre = 'Programa Estudios Políticos y Resolución de Conflictos.';
        $estudios_Politicos->email = '0'; //Se desconoce la información
        $estudios_Politicos->user_created_at = $admin[0]->id;
        $estudios_Politicos->user_updated_at = $admin[0]->id;
        $estudios_Politicos->save();


        //Postgrados

        $politicas_Publicas = new Carrera();
        $politicas_Publicas->codigo = '7879';
        $politicas_Publicas->nombre = 'Maestría en Políticas Públicas';
        $politicas_Publicas->email = '0'; //Se desconoce la información
        $politicas_Publicas->user_created_at = $admin[0]->id;
        $politicas_Publicas->user_updated_at = $admin[0]->id;
        $politicas_Publicas->save();

        $maestria_Educacion = new Carrera();
        $maestria_Educacion->codigo = '0'; //Se desconoce la información
        $maestria_Educacion->nombre = 'Maestría en Educación';
        $maestria_Educacion->email = '0'; //Se desconoce la información
        $maestria_Educacion->user_created_at = $admin[0]->id;
        $maestria_Educacion->user_updated_at = $admin[0]->id;
        $maestria_Educacion->save();
/**

*/

    }
}
