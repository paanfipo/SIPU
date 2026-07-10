<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetAccessPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sipu:reset-access-passwords {password? : Nueva clave para los usuarios base}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restablece la clave, activa y verifica los usuarios base de acceso.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $plainPassword = $this->argument('password') ?: $this->secret('Nueva clave para los usuarios base');

        if (! is_string($plainPassword) || strlen($plainPassword) < 8) {
            $this->error('La clave debe tener al menos 8 caracteres.');

            return 1;
        }

        $password = bcrypt($plainPassword);
        $now = now();

        $users = [
            [
                'name' => 'Soporte Norte Cauca',
                'email' => 'soporte.nortecauca@correounivalle.edu.co',
                'roles' => ['Administrador'],
            ],
            [
                'name' => 'Karem Michell Cantillo',
                'email' => 'coordinadoremprendimiento@gmail.com',
                'roles' => ['Coordinador de emprendimiento'],
            ],
            [
                'name' => 'Tatiana Racines',
                'email' => 'emprender.nortedelcauca@correounivalle.edu.co',
                'roles' => ['Coordinador de emprendimiento'],
            ],
            [
                'name' => 'Rafael Guauna',
                'email' => 'rafael.guauna@correounivalle.edu.com',
                'roles' => ['Coordinador de emprendimiento', 'Asesor'],
            ],
            [
                'name' => 'Coordinador de proyeccion social',
                'email' => 'coordinadordeproyeccionsocial@gmail.com',
                'roles' => ['Coordinador proyeccion social'],
            ],
            [
                'name' => 'Coordinador de practicas',
                'email' => 'coordinadordepracticas@gmail.com',
                'roles' => ['Coordinador de practicas'],
            ],
            [
                'name' => 'Empresa',
                'email' => 'empresa@gmail.com',
                'roles' => ['Empresa'],
            ],
            [
                'name' => 'Director de programa',
                'email' => 'directordeprograma@gmail.com',
                'roles' => ['Director de programa'],
            ],
            [
                'name' => 'Profesor de apoyo',
                'email' => 'profesordeapoyo@gmail.com',
                'roles' => ['Profesor de apoyo'],
            ],
            [
                'name' => 'General User',
                'email' => 'generaluser@gmail.com',
                'roles' => ['General'],
            ],
        ];

        $result = [];

        DB::transaction(function () use ($users, $password, $now, &$result) {
            foreach ($users as $user) {
                $userId = DB::table('users')->where('email', $user['email'])->value('id');
                $action = 'actualizado';

                if ($userId) {
                    DB::table('users')
                        ->where('id', $userId)
                        ->update([
                            'name' => $user['name'],
                            'password' => $password,
                            'state' => true,
                            'email_verified_at' => $now,
                            'updated_at' => $now,
                        ]);
                } else {
                    $action = 'creado';
                    $userId = DB::table('users')->insertGetId([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => $password,
                        'state' => true,
                        'email_verified_at' => $now,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }

                foreach ($user['roles'] as $roleName) {
                    $roleId = DB::table('roles')->where('name', $roleName)->value('id');

                    if (! $roleId) {
                        $result[] = [$user['email'], $action, 'rol faltante: '.$roleName];
                        continue;
                    }

                    $roleRelation = [
                        'role_id' => $roleId,
                        'model_type' => 'App\User',
                        'model_id' => $userId,
                    ];

                    if (! DB::table('model_has_roles')->where($roleRelation)->exists()) {
                        DB::table('model_has_roles')->insert($roleRelation);
                    }
                }

                $result[] = [$user['email'], $action, 'activo y verificado'];
            }
        });

        $this->table(['Email', 'Accion', 'Estado'], $result);
        $this->info('Contraseñas restablecidas correctamente.');

        return 0;
    }
}
