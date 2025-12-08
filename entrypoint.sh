#!/bin/sh
set -e

echo "Menunggu database MySQL ready..."
while ! mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    sleep 2
done

echo "Database siap, jalankan migrate dan optimize"
php artisan migrate --force
php artisan optimize

echo "Menjalankan Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8080
