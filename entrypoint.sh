#!/bin/bash

echo "🚀 Starting deployment process..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan migrate:status 2>/dev/null; do
    echo "Database not ready yet, waiting 2 seconds..."
    sleep 2
done

echo "✅ Database is ready!"

# Jalankan migrate:fresh --seed
echo "📦 Running migrate:fresh --seed..."
php artisan migrate:fresh --seed --force

# Cek apakah admin user berhasil dibuat
echo "🔍 Checking admin user..."
USER_COUNT=$(php artisan tinker --execute="echo App\Models\User::count();" 2>/dev/null || echo "0")
echo "Total users in database: $USER_COUNT"

if [ "$USER_COUNT" = "0" ]; then
    echo "❌ No users found! Running AdminSeeder again..."
    php artisan db:seed --class=AdminSeeder --force
fi

# Clear permission cache
echo "🔑 Clearing permission cache..."
php artisan permission:cache-reset 2>/dev/null || true

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

# Display admin credentials
echo ""
echo "════════════════════════════════════════"
echo "🔐 ADMIN CREDENTIALS:"
echo "Email: admin@dlh.go.id"
echo "Password: password"
echo "════════════════════════════════════════"
echo ""

# Start PHP server
echo "🎉 Starting server on port 8080..."
php artisan serve --host=0.0.0.0 --port=8080