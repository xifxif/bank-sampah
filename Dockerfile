FROM php:8.2-fpm

# Install dependencies + Node.js + PHP MySQL extension
RUN apt-get update && apt-get install -y \
    curl git unzip zip libpng-dev libonig-dev libxml2-dev npm default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . .

# Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --optimize-autoloader

# NPM install + build Vite
RUN npm install
RUN npm run build

# Clear Laravel cache
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan route:clear

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
