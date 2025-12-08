# Base image PHP
FROM php:8.2-fpm

# Install dependencies + Node.js + PHP MySQL extension
RUN apt-get update && apt-get install -y \
    curl git unzip zip libpng-dev libonig-dev libxml2-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php \
    && composer install --no-dev --no-interaction --optimize-autoloader

# Clear old build & Laravel cache
RUN rm -rf storage/framework/views/* \
    && rm -rf storage/framework/cache/* \
    && rm -rf public/build

# NPM install + Vite build
RUN npm ci --only=production
RUN npm run build

# Verify build folder exists
RUN ls -la public/build && cat public/build/manifest.json || echo "❌ Build failed!"

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port (sesuai Railway)
EXPOSE 8080

# Start container with entrypoint
ENTRYPOINT ["/entrypoint.sh"]