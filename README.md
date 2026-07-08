# SIPU

SIPU is a modular web based information system for university process management. Its first functional implementation supports entrepreneurship calls, including call configuration, stages, activities, schedules, participant registration, attendance tracking, stage progression, notifications and reports.

Spanish documentation is available in [README.es.md](README.es.md).

## Overview

SIPU provides a configurable platform for organizing university workflows through packages, modules, roles and permissions. The entrepreneurship package supports the management of calls for participants, process stages, scheduled activities, public and bulk registration, attendance records, documentation, notifications and call reports.

This repository is prepared for public reuse and academic software publication. It does not include real credentials, private environment files or production secrets.

## Main Features

- Package and module management.
- Role and permission based access control.
- Dynamic menu according to authenticated user permissions.
- User registration and authentication.
- Email verification and password recovery workflows.
- Entrepreneurship call management.
- Stage and activity configuration.
- Schedule assignment.
- Public participant registration.
- Bulk participant registration.
- Attendance tracking.
- Stage progression.
- Management of notes, updates and documentation.
- Internal and email notifications.
- Reports by call.

## Technologies

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

## Requirements

- PHP compatible with the Laravel version used by the project.
- Composer.
- PostgreSQL.
- A local or remote server compatible with Laravel.
- PHP extensions required by Laravel and by the project dependencies.

## Installation

Clone the repository.

```bash
git clone https://github.com/paanfipo/SIPU.git
cd SIPU
```

Install PHP dependencies.

```bash
composer install
```

Create the local environment file.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

Configure the database and mail variables in `.env`. Do not commit real credentials or production secrets.

Run migrations and seeders.

```bash
php artisan migrate --seed
```

Clear Laravel caches.

```bash
php artisan optimize:clear
```

Run the local development server.

```bash
php artisan serve
```

The application will be available at `http://localhost:8000` by default.

## Environment Configuration

Use `.env.example` as a template. The repository keeps sensitive values empty and excludes `.env` from version control.

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

## Documentation

English documentation:

- [User manual](docs/en/user_manual.md)
- [Installation](docs/en/installation.md)
- [Architecture](docs/en/architecture.md)
- [Requirements](docs/en/requirements.md)
- [Functional tests](docs/en/tests.md)

Spanish documentation:

- [README.es.md](README.es.md)
- [Manual de usuario](docs/es/manual_usuario.md)
- [Instalación](docs/es/instalacion.md)
- [Arquitectura](docs/es/arquitectura.md)
- [Requerimientos](docs/es/requerimientos.md)
- [Pruebas funcionales](docs/es/pruebas.md)

## Citation

If you use this software, please cite it using the metadata provided in [CITATION.cff](CITATION.cff).

## License

This project is distributed under the MIT License. See [LICENSE](LICENSE).

## Security Notes

Do not publish real SMTP credentials, database passwords, application keys or production configuration values. Use local `.env` files or deployment environment variables for private configuration.
