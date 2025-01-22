FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Instalar dependencias del sistema y de PHP
RUN apk update \
    && apk add --no-cache $PHPIZE_DEPS git zip unzip libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo pdo_mysql zip

# Copiar configuración de PHP (si tienes un php.ini personalizado)
# COPY php.ini /usr/local/etc/php/conf.d/

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer

# Copiar código de la aplicación
COPY . .

# Instalar dependencias de Composer SIN los scripts
RUN composer install --no-interaction --no-dev --optimize-autoloader --prefer-dist --no-scripts

# Limpiar caché de Composer
RUN composer clear-cache

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/config

EXPOSE 80