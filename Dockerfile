# Stage 1: Build application using Composer
FROM php:8.2-fpm-alpine AS build
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist
COPY . .

# Stage 2: Production image with PHP and Nginx
FROM php:8.2-fpm-alpine
# Install system dependencies
RUN apk add --no-cache \
    nginx \
    curl \
    bash \
    git \
    libpng \
    libjpeg-turbo \
    libwebp \
    freetype \
    libzip-dev \
    zip \
    unzip \
    supervisor
# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip intl mbstring bcmath xml
# Configure PHP
COPY docker/php.ini /usr/local/etc/php/php.ini
# Copy built app from builder stage
COPY --from=build /app /var/www
# Set working directory
WORKDIR /var/www
# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf
# Copy Supervisor config
COPY docker/supervisord.conf /etc/supervisord.conf
# Set correct permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage
# Expose ports
EXPOSE 80
# Start PHP-FPM and Nginx via Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
