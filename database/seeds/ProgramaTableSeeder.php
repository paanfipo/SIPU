<?php

use Illuminate\Database\Seeder;

class ProgramaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('programas')->insert([
            'codigo'  => '2711',
            'nombre'  => 'TECNOLOGIA EN SISTEMAS DE LA INFORMACIÓN',
            'email'   => 'programa.tsi.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2711',
            'nombre'  => 'TECNOLOGIA EN SISTEMAS DE LA INFORMACIÓN',
            'email'   => 'programa.tsi.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2724',
            'nombre'  => 'TECNOLOGÍA EN DESARROLLO DE SOFTWARE',
            'email'   => 'programa.tsi.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2724',
            'nombre'  => 'TECNOLOGÍA EN DESARROLLO DE SOFTWARE',
            'email'   => 'programa.tsi.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2837',
            'nombre'  => 'TECNOLOGIA EN GESTIÓN DE LA CALIDAD',
            'email'   => 'gestiondelacalidad.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2837',
            'nombre'  => 'TECNOLOGIA EN GESTIÓN DE LA CALIDAD',
            'email'   => 'gestiondelacalidad.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2838',
            'nombre'  => 'TECNOLOGÍA EN GESTIÓN DEL TALENTO HUMANO',
            'email'   => 'talentohumano.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2838',
            'nombre'  => 'TECNOLOGÍA EN GESTIÓN DEL TALENTO HUMANO',
            'email'   => 'talentohumano.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2839',
            'nombre'  => 'TECNOLOGIA EN GESTIÓN LOGÍSTICA',
            'email'   => 'talentohumano.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '2839',
            'nombre'  => 'TECNOLOGIA EN GESTIÓN LOGÍSTICA',
            'email'   => 'talentohumano.nortedelcauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3249',
            'nombre'  => 'TRABAJO SOCIAL',
            'email'   => 'trabajo.social.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3249',
            'nombre'  => 'TRABAJO SOCIAL',
            'email'   => 'trabajo.social.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3469',
            'nombre'  => 'LIC. EN  MATEMÁTICAS',
            'email'   => 'licenciatura.matematicas.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3469',
            'nombre'  => 'LIC. EN  MATEMÁTICAS',
            'email'   => 'licenciatura.matematicas.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3489',
            'nombre'  => 'ESTUDIOS POLITICOS Y RESOLUCIÓN DE CONFLICTOS',
            'email'   => 'estudiospoliticos.nortecauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3489',
            'nombre'  => 'ESTUDIOS POLITICOS Y RESOLUCIÓN DE CONFLICTOS',
            'email'   => 'estudiospoliticos.nortecauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3841',
            'nombre'  => 'CONTADURIA PÚBLICA',
            'email'   => 'contaduria.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3841',
            'nombre'  => 'CONTADURIA PÚBLICA',
            'email'   => 'contaduria.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3845',
            'nombre'  => 'ADMINISTRACIÓN DE EMPRESAS',
            'email'   => 'administracion.empresas.ncauca@correounivalle.edu.co',
            'jornada' => 'DIU',
            'estado'  => true,
        ]);

        DB::table('programas')->insert([
            'codigo'  => '3845',
            'nombre'  => 'ADMINISTRACIÓN DE EMPRESAS',
            'email'   => 'administracion.empresas.ncauca@correounivalle.edu.co',
            'jornada' => 'NOC',
            'estado'  => true,
        ]);
    }
}
