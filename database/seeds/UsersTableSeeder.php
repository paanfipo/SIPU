<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Soporte Norte Cauca';
        $user->email = 'soporte.nortecauca@correounivalle.edu.co';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Administrador');

        //Coordinador de emprendimiento
        $user = new User;
        $user->name = 'Karem Michell Cantillo';
        $user->email = 'coordinadoremprendimiento@gmail.com';
        $user->password = bcrypt('emprendimiento2021');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Coordinador de emprendimiento');
        

        //Coordinador de emprendimiento
        $user = new User;
        $user->name = 'Tatiana Racines';
        $user->email = 'emprender.nortedelcauca@correounivalle.edu.co';
        $user->password = bcrypt('emprendimiento2021');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Coordinador de emprendimiento');

        //Coordinador de emprendimiento
        $user = new User;
        $user->name = 'Rafael Guauna';
        $user->email = 'rafael.guauna@correounivalle.edu.com';
        $user->password = bcrypt('emprendimiento2021');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole(['Coordinador de emprendimiento', 'Asesor']);


        //Coordinador de proyección social
        $user = new User;
        $user->name = 'Coordinador de proyección social';
        $user->email = 'coordinadordeproyeccionsocial@gmail.com';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Coordinador proyeccion social');

        //Coordinador de practicas
        $user = new User;
        $user->name = 'Coordinador de practicas';
        $user->email = 'coordinadordepracticas@gmail.com';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Coordinador de practicas');
        
        //Empresa
        $user = new User;
        $user->name = 'Empresa';
        $user->email = 'empresa@gmail.com';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Empresa');

        //Director de programa
        $user = new User;
        $user->name = 'Director de programa';
        $user->email = 'directordeprograma@gmail.com';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Director de programa');

        //Profesor de apoyo
        $user = new User;
        $user->name = 'Profesor de apoyo';
        $user->email = 'profesordeapoyo@gmail.com';
        $user->password = bcrypt('g3st10n21cauc4');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('Profesor de apoyo');

        $user = new User;
        $user->name = 'General User';
        $user->email = 'generaluser@gmail.com';
        $user->password = bcrypt('123');
        $user->state = true;
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('General');

    }
}
