FROM php:7.4-apache

# 1. Dependencias del sistema
RUN apt-get update -y && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libpq-dev zip unzip git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql zip

# 3. LIMPIEZA TOTAL DE MPM: 
# Desactivamos módulos conflictivos y forzamos prefork a nivel de configuración de Apache
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Habilitar Apache Rewrite para Laravel
RUN a2enmod rewrite

# 5. Directorio de trabajo y código
WORKDIR /var/www/html
COPY . .
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# 6. Instalación de dependencias (sin scripts para evitar el error 255)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 7. Crear carpetas necesarias y dar permisos
RUN mkdir -p /var/www/html/storage/framework/cache/data \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/testing \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Configurar el puerto y el DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 9. VARIABLE DE ENTORNO CRÍTICA PARA APACHE
# Esto le dice a Apache que no intente cargar nada extra por su cuenta
ENV APACHE_ARGUMENTS="-D FOREGROUND"

EXPOSE 80
CMD ["apache2-foreground"]