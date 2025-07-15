# Stage 1: Build dependencies using Composer
FROM composer:2 AS composer-deps

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .

# Stage 2: Laravel App with PHP-FPM and Nginx
FROM php:8.2-fpm-alpine

# Install PHP extensions and system tools
RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    git \
    libzip-dev \
    zip \
    unzip \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev \
    zlib-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl mbstring bcmath xml

# Set working directory
WORKDIR /var/www

# Copy app from builder stage
COPY --from=composer-deps /var/www /var/www

# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copy custom php.ini if needed
COPY docker/php.ini /usr/local/etc/php/php.ini

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 80 for Nginx
EXPOSE 80

# Start both PHP-FPM and Nginx
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"
