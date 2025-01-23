FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Instalar dependencias del sistema y de PHP
RUN apk update \
    && apk add --no-cache $PHPIZE_DEPS git zip unzip libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev icu-dev mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo pdo_mysql zip

# Copiar configuración de PHP (si tienes un php.ini personalizado)
# COPY php.ini /usr/local/etc/php/conf.d/

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer
# COPY composer.json composer.lock ./

# RUN composer install --no-interaction --no-dev --optimize-autoloader --prefer-dist

# Copiar código de la aplicación
COPY . .

# Instalar dependencias de Composer (AHORA CON LOS SCRIPTS)
RUN composer install --no-interaction --no-dev --optimize-autoloader --prefer-dist

# Instalar los assets (AHORA SÍ)
RUN php bin/console assets:install --relative

# Cambiar la propiedad y permisos del directorio var (DESPUÉS DE LA INSTALACIÓN DE COMPOSER)
RUN chown -R www-data:www-data /var/www/html/var
RUN chmod -R g+w /var/www/html/var

# Limpiar caché de Composer (opcional, pero buena práctica)
RUN composer clear-cache

EXPOSE 80