FROM php:7.4-apache

# 1. Instalación de dependencias del sistema
RUN apt-get update -y && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libpq-dev zip unzip git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql zip

# 3. Habilitar Apache Rewrite
RUN a2enmod rewrite

# 4. Copiar código y Composer
WORKDIR /var/www/html
COPY . .
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# 5. Instalación de dependencias SIN ejecutar scripts automáticos
# El flag --no-scripts evita el error 255 que tuviste
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 6. Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Configuración de Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]