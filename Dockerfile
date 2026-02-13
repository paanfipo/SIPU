FROM php:7.4-cli

# Dependencias del sistema
RUN apt-get update -y && apt-get install -y \
    git unzip zip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Extensiones PHP necesarias (gd, zip, pgsql)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql zip

# Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Dependencias PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# Carpetas y permisos típicos de Laravel
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Railway expone un PORT dinámico
EXPOSE 8080

CMD php -S 0.0.0.0:${PORT:-8080} -t public
