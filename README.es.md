# SIPU

SIPU es un sistema de información web modular para la gestión de procesos universitarios. Su primera implementación funcional apoya la gestión de convocatorias de emprendimiento, incluyendo configuración de convocatorias, etapas, actividades, cronogramas, inscripción de participantes, control de asistencia, avance entre etapas, notificaciones y reportes.

La documentación en inglés está disponible en [README.md](README.md).

## Descripción

SIPU ofrece una plataforma configurable para organizar procesos universitarios mediante paquetes, módulos, roles y permisos. El paquete de emprendimiento permite administrar convocatorias, etapas del proceso, actividades programadas, registro público y masivo de participantes, asistencia, documentación, notificaciones y reportes por convocatoria.

Este repositorio está preparado para reutilización pública y publicación académica de software. No incluye credenciales reales, archivos de entorno privados ni secretos de producción.

## Características principales

- Gestión de paquetes y módulos.
- Control de acceso basado en roles y permisos.
- Menú dinámico según los permisos del usuario autenticado.
- Registro y autenticación de usuarios.
- Verificación de correo electrónico y recuperación de contraseña.
- Gestión de convocatorias de emprendimiento.
- Configuración de etapas y actividades.
- Asignación de cronogramas.
- Registro público de participantes.
- Registro masivo de participantes.
- Control de asistencia.
- Avance entre etapas.
- Gestión de novedades, actualizaciones y documentación.
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

- PHP compatible con la versión de Laravel usada por el proyecto.
- Composer.
- PostgreSQL.
- Servidor local o remoto compatible con Laravel.
- Extensiones PHP requeridas por Laravel y por las dependencias del proyecto.

## Instalación

Clonar el repositorio.

```bash
git clone https://github.com/paanfipo/SIPU.git
cd SIPU
```

Instalar dependencias PHP.

```bash
composer install
```

Crear el archivo de entorno local.

```bash
cp .env.example .env
```

Generar la llave de aplicación.

```bash
php artisan key:generate
```

Configurar las variables de base de datos y correo en `.env`. No se deben confirmar credenciales reales ni secretos de producción.

Ejecutar migraciones y seeders.

```bash
php artisan migrate --seed
```

Limpiar caché de Laravel.

```bash
php artisan optimize:clear
```

Ejecutar el servidor local.

```bash
php artisan serve
```

Por defecto, la aplicación estará disponible en `http://localhost:8000`.

## Configuración de entorno

Use `.env.example` como plantilla. El repositorio mantiene vacíos los valores sensibles y excluye `.env` del control de versiones.

```env
APP_NAME=SIPU
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

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

## Documentación

Documentación en español:

- [Manual de usuario](docs/es/manual_usuario.md)
- [Instalación](docs/es/instalacion.md)
- [Arquitectura](docs/es/arquitectura.md)
- [Requerimientos](docs/es/requerimientos.md)
- [Pruebas funcionales](docs/es/pruebas.md)

Documentación en inglés:

- [README.md](README.md)
- [User manual](docs/en/user_manual.md)
- [Installation](docs/en/installation.md)
- [Architecture](docs/en/architecture.md)
- [Requirements](docs/en/requirements.md)
- [Functional tests](docs/en/tests.md)

## Citación

Si utiliza este software, cite el proyecto usando la información disponible en [CITATION.cff](CITATION.cff).

## Licencia

Este proyecto se distribuye bajo la licencia MIT. Consulte [LICENSE](LICENSE).

## Notas de seguridad

No publique credenciales SMTP reales, contraseñas de base de datos, llaves de aplicación ni valores de configuración de producción. Use archivos `.env` locales o variables de entorno del servidor para la configuración privada.
