<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'General',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Asesor',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Coordinador de emprendimiento',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Estudiante',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Coordinador proyeccion social',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Coordinador de practicas',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Coordinador administrativo',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Empresa',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Director de programa',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Profesor de apoyo',
            'guard_name' => 'web',
        ]);

    }
}
