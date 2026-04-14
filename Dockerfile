FROM php:8.2-apache

# Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# Instalar dependencias del sistema, incluyendo Tesseract OCR
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    tesseract-ocr \
    tesseract-ocr-spa \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath zip gd

# Actualizar el DocumentRoot de Apache a la carpeta public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto
COPY . .

# Instalar las dependencias de Composer (ignorar las de desarrollo)
RUN composer install --no-dev --optimize-autoloader

# Asignar permisos correctos a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Cambiar permisos al script de entrada
RUN chmod +x docker-entrypoint.sh

# Exponer el puerto (Render usa la variable PORT dinámicamente, usaremos un script para configurarlo)
# Se define como ENTRYPOINT
ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
