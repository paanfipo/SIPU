# Installation

## Requirements

- PHP compatible with Laravel 6.
- Composer.
- PostgreSQL.
- PHP extensions required by Laravel and by the project dependencies.
- A local or remote server compatible with Laravel.

## Steps

1. Clone the repository.

```bash
git clone https://github.com/paanfipo/SIPU.git
cd SIPU
```

2. Install PHP dependencies.

```bash
composer install
```

3. Create the environment file.

```bash
cp .env.example .env
```

4. Generate the application key.

```bash
php artisan key:generate
```

5. Configure PostgreSQL in `.env`.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sipu
DB_USERNAME=
DB_PASSWORD=
```

6. Configure email delivery only if notifications by email are required.

```env
MAIL_DRIVER=smtp
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
```

7. Run migrations and seeders.

```bash
php artisan migrate --seed
```

8. Clear Laravel caches.

```bash
php artisan optimize:clear
```

9. Start the local server.

```bash
php artisan serve
```

## Basic Verification

Open `http://localhost:8000` in a browser and verify that the application login page loads. Any initial testing accounts must be reviewed and changed before public demonstrations or production deployments.
