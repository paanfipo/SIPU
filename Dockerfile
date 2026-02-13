FROM php:7.4-cli

# 1) Dependencias del sistema + curl (para instalar Node) + libs para extensiones
RUN apt-get update -y && apt-get install -y \
    git unzip zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2) Extensiones PHP (gd, zip, pgsql)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql zip

# 3) Node.js (Laravel Mix 4 / Webpack 4 suele ser más estable con Node 16)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
 && apt-get update -y && apt-get install -y nodejs \
 && node -v && npm -v \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# 4) Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# 5) Copiar proyecto
WORKDIR /app
COPY . .

# 6) Dependencias PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 7) Dependencias JS + build de producción (Laravel Mix)
RUN npm install
RUN npm run production

# 8) Carpetas y permisos típicos de Laravel (reforzado para auth/sesiones/cache)
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
 && chmod -R ug+rwx storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# 9) Railway expone un PORT dinámico
EXPOSE 8080

# 10) Servir Laravel desde /public
CMD php -S 0.0.0.0:${PORT:-8080} -t public
