FROM php:8.2-fpm

# Install dependencies + Node.js
RUN apt-get update && apt-get install -y \
    curl git unzip zip libpng-dev libonig-dev libxml2-dev npm default-mysql-client \
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

# Clear Laravel cache (tanpa optimize:clear)
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan route:clear

# Copy entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

# Jalankan entrypoint
ENTRYPOINT ["/entrypoint.sh"]
