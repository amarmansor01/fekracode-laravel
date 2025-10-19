FROM php:8.2-fpm

# تثبيت المكتبات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# تثبيت مكتبات PHP
RUN composer install --no-dev --optimize-autoloader

# تثبيت Node وبناء الواجهة
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install && npm run build

# Render لازم يشتغل على بورت 10000
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000


RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear
RUN chmod -R 775 storage bootstrap/cache

