# --- STAGE 1: Frontend Asset Compilation ---
FROM node:20-alpine AS frontend_builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- STAGE 2: PHP Production Environment ---
FROM php:8.3-apache AS runtime

# 1. Install system dependencies & PHP extensions for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring bcmath intl zip gd opcache

# 2. Configure production PHP settings (Opcache)
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# 3. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 4. Change Apache document root to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Bind Apache to Render's dynamic $PORT environment variable
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# 6. Set up project workspace
WORKDIR /var/www/html
COPY . .

# 7. Copy compiled assets from Stage 1
COPY --from=frontend_builder /app/public/build ./public/build

# 8. Install Composer dependencies securely for production
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Set correct permissions for Apache user
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Expose the port (Render detects this automatically, but uses $PORT at runtime)
EXPOSE 80

# Run the deploy script first, then launch Apache
CMD ["/bin/sh", "-c", "./deploy.sh && apache2-foreground"]
