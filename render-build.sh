#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

echo "Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Ejecutando migraciones..."
php artisan migrate --force
