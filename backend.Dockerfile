# Usa una imagen base de PHP con Alpine
FROM php:8.2-fpm-alpine

# Define variables de entorno y trabaja desde la raíz del proyecto
ARG USER_ID
ARG GROUP_ID
ARG USER_NAME
ARG GROUP_NAME

ENV TZ=America/Mexico_City

WORKDIR /var/www/

# Instala dependencias necesarias para PHP y el entorno de desarrollo
RUN apk update && apk add --no-cache \
    tzdata \
    oniguruma-dev \
    postgresql-dev \
    libzip-dev \
    vim \
    zip \
    unzip \
    shadow \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    lsof \
    bash \
    curl \
    gcc \
    g++ \
    make \
    autoconf

# Configura zona horaria
RUN cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
    echo "${TZ}" > /etc/timezone && \
    apk del tzdata

# Agrega grupo y usuario personalizados
RUN addgroup -g $GROUP_ID $GROUP_NAME && \
    adduser -D -u $USER_ID -G $GROUP_NAME $USER_NAME

# Instala extensiones de PHP requeridas
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg && \
    docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    gd

# Copia Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia archivos del proyecto
COPY ./backend /var/www/
COPY ./config/php/php.ini /usr/local/etc/php/php.ini

# Instala dependencias de PHP vía Composer
RUN composer install --no-ansi --no-dev --no-interaction --no-progress --optimize-autoloader --no-scripts

# Cambia propiedad de los archivos al usuario creado
RUN chown -R $USER_NAME:$GROUP_NAME /var/www/

# Cambia al usuario no root
USER $USER_NAME