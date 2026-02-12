<?php

use Illuminate\Database\Seeder;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paises')->insert([
            'nombre' => 'COLOMBIA',
            'codigo_dane' => '',
            'codigo_iso' => '',
            'estado' => true,
        ]);

        DB::table('paises')->insert([
            'nombre' => 'Ecuador',
            'codigo_dane' => '',
            'codigo_iso' => '',
            'estado' => true,
        ]);

        DB::table('paises')->insert([
            'nombre' => 'Perú',
            'codigo_dane' => '',
            'codigo_iso' => '',
            'estado' => true,
        ]);

        DB::table('paises')->insert([
            'nombre' => 'Estados Unidos',
            'codigo_dane' => '',
            'codigo_iso' => '',
            'estado' => true,
        ]);

        DB::table('paises')->insert([
            'nombre' => 'España',
            'codigo_dane' => '',
            'codigo_iso' => '',
            'estado' => true,
        ]);
    }
}
