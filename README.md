# SIPU

Sistema de Información para Procesos Universitarios.

## Descripción

SIPU es una plataforma web modular para la gestión de procesos universitarios. Su primera implementación funcional corresponde al paquete de emprendimiento, orientado a la administración de convocatorias, etapas, actividades, cronogramas, inscripción de emprendedores, control de asistencia, avance entre etapas, notificaciones y reportes.

## Características principales

- Gestión de paquetes y módulos.
- Control de roles y permisos.
- Menú dinámico según permisos.
- Registro y autenticación de usuarios.
- Verificación de correo electrónico.
- Gestión de convocatorias de emprendimiento.
- Configuración de etapas y actividades.
- Asignación de cronogramas.
- Registro público y registro masivo de participantes.
- Control de asistencia.
- Avance automático entre etapas.
- Gestión de novedades y documentación.
- Notificaciones internas y por correo electrónico.
- Reportes por convocatoria.

## Tecnologías

- PHP.
- Laravel.
- Blade.
- JavaScript.
- HTML.
- CSS.
- Bootstrap.
- Composer.
- Artisan.
- PostgreSQL.
- Git.

## Requisitos

- PHP compatible con la versión del proyecto.
- Composer.
- PostgreSQL.
- Servidor local o remoto compatible con Laravel.
- Extensiones PHP requeridas por Laravel.

## Instalación

Clonar el repositorio.

```bash
git clone https://github.com/paanfipo/SIPU.git
cd SIPU
```

Instalar dependencias.

```bash
composer install
```

Crear el archivo de entorno.

```bash
cp .env.example .env
```

Generar la llave de aplicación.

```bash
php artisan key:generate
```

## Configuración

Editar el archivo `.env` y configurar las variables de base de datos y correo electrónico. El proyecto usa PostgreSQL como motor de base de datos principal.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sipu
DB_USERNAME=
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
```

No se deben publicar credenciales reales en el repositorio. Las contraseñas, usuarios y llaves de aplicación deben mantenerse únicamente en archivos `.env` locales o en variables de entorno del servidor.

## Migraciones y seeders

Ejecutar migraciones y datos iniciales.

```bash
php artisan migrate --seed
```

Limpiar caché de configuración, rutas y vistas.

```bash
php artisan optimize:clear
```

## Ejecución local

Iniciar el servidor local de Laravel.

```bash
php artisan serve
```

Después de iniciar el servidor, la aplicación estará disponible en `http://localhost:8000`.

## Credenciales de prueba

Las credenciales de prueba iniciales se generan mediante los seeders del proyecto.

- Correo: `admin@gmail.com`
- Contraseña: `admin`

Estas credenciales deben cambiarse antes de usar SIPU en ambientes de producción o demostraciones públicas.

## Documentación

La documentación complementaria se encuentra en la carpeta `docs`.

- [Manual de usuario](docs/manual_usuario.md)
- [Instalación](docs/instalacion.md)
- [Arquitectura](docs/arquitectura.md)
- [Requerimientos](docs/requerimientos.md)
- [Pruebas funcionales](docs/pruebas.md)

## Licencia

Este proyecto se distribuye bajo la licencia MIT. Consulte el archivo [LICENSE](LICENSE).

## Citación

Si utiliza este software, cite el proyecto usando la información disponible en [CITATION.cff](CITATION.cff).
