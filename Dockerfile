FROM php:8.2-fpm

# Instalar dependencias del sistema, PHP y Node.js
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    gnupg2 \
    lsb-release \
    ca-certificates \
    nginx \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configurar Git
RUN git config --global --add safe.directory /var/www/html

# Crear y asignar permisos
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Copiar el resto del código
COPY . .

# Instalar dependencias PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copiar configuración de nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Exponer el puerto HTTP
EXPOSE 80

# Comando final: inicia nginx y PHP-FPM
CMD service nginx start && php-fpm && php artisan storage:link
