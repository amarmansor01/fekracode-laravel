FROM php:8.2-apache

# تثبيت Composer وامتدادات PHP المطلوبة
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع
COPY . /var/www/html

# إعدادات Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan migrate --force

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
