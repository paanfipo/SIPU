<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PaquetesTableSeeder::class,
            ModulosTableSeeder::class,
            PaisesTableSeeder::class,
            DepartamentosTableSeeder::class,
            CiudadesTableSeeder::class,
            TipomaestroTableSeeder::class,
            PermisosTableSeeder::class,
            CarrerasTableSeeder::class,
            DependenciasTableSeeder::class,
            EtapasTableSeeder::class,
            ActividadesTableSeeder::class,
            ProgramaTableSeeder::class,
            
        ]);
    }
}