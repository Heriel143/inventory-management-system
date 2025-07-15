# Stage 1: Composer dependencies
FROM docker.io/library/composer:2.7 AS composer-deps
WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
COPY . .

# Stage 2: Final image
FROM docker.io/library/php:8.2-fpm-alpine
RUN apk add --no-cache nginx bash curl git libzip-dev zip unzip freetype-dev libjpeg-turbo-dev libpng-dev oniguruma-dev icu-dev zlib-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl mbstring bcmath xml
WORKDIR /var/www
COPY --from=composer-deps /var/www /var/www
CMD ["php-fpm"]
