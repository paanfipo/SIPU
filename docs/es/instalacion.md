# Instalación

## Requisitos

- PHP compatible con Laravel 6.
- Composer.
- PostgreSQL.
- Extensiones PHP requeridas por Laravel y por las dependencias del proyecto.
- Servidor local o remoto compatible con Laravel.

## Pasos

1. Clonar el repositorio.

```bash
git clone https://github.com/paanfipo/SIPU.git
cd SIPU
```

2. Instalar dependencias PHP.

```bash
composer install
```

3. Crear el archivo de entorno.

```bash
cp .env.example .env
```

4. Generar la llave de aplicación.

```bash
php artisan key:generate
```

5. Configurar PostgreSQL en `.env`.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sipu
DB_USERNAME=
DB_PASSWORD=
```

6. Configurar el correo solo si se requieren notificaciones por email.

```env
MAIL_DRIVER=smtp
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
```

7. Ejecutar migraciones y seeders.

```bash
php artisan migrate --seed
```

8. Limpiar caché de Laravel.

```bash
php artisan optimize:clear
```

9. Iniciar el servidor local.

```bash
php artisan serve
```

## Verificación básica

Abrir `http://localhost:8000` en un navegador y verificar que cargue la pantalla de acceso. Cualquier cuenta inicial de prueba debe revisarse y cambiarse antes de demostraciones públicas o despliegues en producción.
