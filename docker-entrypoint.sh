#!/usr/bin/env bash
set -e

# Configurar el puerto de Apache al puerto proporcionado por Render ($PORT)
if [ -n "$PORT" ]; then
    sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
fi

echo "Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Iniciando Apache..."
# Arranca el servidor apache en foreground
exec apache2-foreground
