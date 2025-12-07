# Base image PHP
FROM php:8.2-fpm

# Install dependencies + Node.js
RUN apt-get update && apt-get install -y \
    curl git unzip zip libpng-dev libonig-dev libxml2-dev npm \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --optimize-autoloader

# Install NPM & build Vite
RUN npm install
RUN npm run build

# Clear Laravel cache
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan optimize:clear

# Expose port Laravel
EXPOSE 8080

# Start Laravel server
CMD php artisan serve --host=0.0.0.
