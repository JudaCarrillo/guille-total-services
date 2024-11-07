# Partimos de la imagen php en su versión
FROM php:8.2.17-fpm

ARG app
ENV COMPOSER_ALLOW_SUPERUSER=1

# Creamos la carpeta /var/www/app/@microservices/${app}
RUN mkdir -p /var/www/app/@microservices/${app}

# Copiamos todos los archivos de la carpeta actual de nuestra
COPY ./ /var/www/app/@microservices/${app}

# Nos movemos a /var/www/
WORKDIR /var/www/app/@microservices/${app}

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git \
    curl

# Instalamos extensiones de PHP
RUN docker-php-ext-install pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Instalamos composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalamos dependendencias de composer
RUN composer clear-cache
RUN composer install --no-interaction --optimize-autoloader

# Cambiar el propietario de los archivos a www-data
RUN chown -R www-data:www-data /var/www/app/@microservices/${app}

# Exponemos el puerto 80 a la network
EXPOSE 80

# Corremos el comando php-fpm para ejecutar PHP
CMD ["php-fpm"]
