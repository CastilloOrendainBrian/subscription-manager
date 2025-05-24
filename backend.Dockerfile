# Use a PHP base image with Alpine
FROM php:8.4-fpm-alpine

# Define environment variables and work from the project root
ARG USER_ID
ARG GROUP_ID
ARG USER_NAME
ARG GROUP_NAME

WORKDIR /var/www/

# Install required dependencies for PHP and the development environment
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

ENV TZ=America/Mexico_City

# Set timezone
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo "$TZ" > /etc/timezone

# Add custom group and user
RUN addgroup -g $GROUP_ID $GROUP_NAME && \
    adduser -D -u $USER_ID -G $GROUP_NAME $USER_NAME

# Install required PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg && \
    docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    gd

# Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY ./backend /var/www/
COPY ./config/php/php.ini /usr/local/etc/php/php.ini

# Install PHP dependencies via Composer
RUN composer install --no-ansi --no-dev --no-interaction --no-progress --optimize-autoloader --no-scripts

# Change ownership of the files to the created user
RUN chown -R $USER_NAME:$GROUP_NAME /var/www/

# Switch to non-root user
USER $USER_NAME