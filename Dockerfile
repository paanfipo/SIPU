FROM php:7.4-apache

# Actualizar repositorios y forzar la instalación de dependencias básicas
RUN apt-get update -y && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configurar e instalar extensiones de PHP (GD para imágenes, PDO para la base de datos)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql zip

# Habilitar el módulo rewrite de Apache (vital para las rutas de Laravel)
RUN a2enmod rewrite

# Copiar el código al servidor
COPY . /var/www/html

# Instalar Composer de forma segura
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Ejecutar instalación de dependencias (ignorando restricciones de versión)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Dar permisos a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apuntar Apache a la carpeta /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80