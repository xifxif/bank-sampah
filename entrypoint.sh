#!/bin/bash

echo "🚀 Starting deployment process..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan migrate:status 2>/dev/null; do
    echo "Database not ready yet, waiting 2 seconds..."
    sleep 2
done

echo "✅ Database is ready!"

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Run seeders (TAMBAHKAN INI!)
echo "🌱 Running seeders..."
php artisan db:seed --force

# Clear all cache
echo "🧹 Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache optimization for production
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Start PHP server
echo "🎉 Starting server on port 8080..."
php artisan serve --host=0.0.0.0 --port=8080