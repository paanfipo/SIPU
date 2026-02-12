#Tener varios host locales:
https://victorroblesweb.es/2016/03/26/crear-varios-hosts-virtuales-en-wampserver/

Git:
git init 
git config --global user.name "nombre usuario"
git config --global user.email "email usuario"
git remote add origin //LINK SSH
git pull origin
git checkout dev

Comandos Para Iniciar el proyecto:
composer install
php artisan key:generate
composer update 

# problemas corriendo los seed
php artisan migrate:reset
php artisan migrate
composer dumpautoload //para nuevos seeders
php artisan db:seed 

# Credenciales user default
email: admin@gmail.com
password: admin

# Crear migration rename colum 
composer require doctrine/dbal

# Correr seeders
php artisan db:seed
php artisan db:seed --class=UsersTableSeeder

# Reiniciar contadores en las tablas
ALTER SEQUENCE departamentos_id_seq RESTART WITH 1; 

# Borrar cache si se hace un cambio en el archivo .env
php artisan config:cache;
php artisan config:clear;
php artisan storage:link


# Correr migraciones en el creador de clientes
php artisan migrate --database=pgsql
php artisan migrate:reset --database=pgsql
php artisan db:seed --class=DatabaseSeeder --database=pgsql

# Borra cache larvel permission -- se debe correr cade vez que se crea un cliente
php artisan cache:forget spatie.permission.cache

# Crea migracion de una tabla
php artisan make:migration nombre_migracion --create=nombre_tabla

# Crea controlador
php artisan make:controller ConvocatoriaController --resource

# Crea el modelo 
php artisan make:model Convocatoria

# Crear Request Validación
php artisan make:request CrearPastelesRequest

# crear seeder
php artisan make:seeder NombreTableSeeder

# Correr migracion seleccionando BD y archivo migrate
php artisan migrate:reset --path=database/migrations/tenant 2019_12_27_223142_create_tipomaestroitem_table.php --database=pgsql_tenant

# Comandos Laravel
php artisan migrate --seed
php artisan migrate:fresh --seed
php artisan optimize:clear

php artisan      auth:clear-resets
php artisan      cache:clear
php artisan      config:clear
php artisan      route:clear
php artisan      view:clear

composer diagnose
composer self-update
composer clear-cache
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
composer dumpautoload
php artisan make:model Salones -m -c -r

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=proyectouni2017@gmail.com
MAIL_PASSWORD=Univ@lle.2017
MAIL_ENCRYPTION=ssl

# Comandos postgres
sudo service postgresql restart
systemctl restart postgresql.service
systemctl status postgresql.service

\q
\l
\s

# Comandos artisan call
\Artisan::call('db:seed', array('--class' => "AdminSeeder"));
\Artisan::call(config:clear);
Artisan::call('make:migration', ['name' => 'migration_name']);
chmod 777 database/migrations
chmod 777 app/database/migrations
  Artisan::call('make:migration', ['name' => $name, '--create' => upperToUnderscore($name)]);
   Artisan::call('module:seed', ['module' => $request->module], $output);
