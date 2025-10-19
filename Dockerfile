FROM php:8.2-fpm

# تثبيت المكتبات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# نسخ المشروع
COPY . .

# تثبيت مكتبات PHP
RUN composer install --no-dev --optimize-autoloader

# تثبيت Node وبناء الواجهة (إذا عندك Vite أو Mix)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install && npm run build

# إعطاء صلاحيات للمجلدات
RUN chmod -R 775 storage bootstrap/cache

# Render لازم يشتغل على بورت 10000
EXPOSE 10000

# استدعاء سكربت التشغيل
CMD ["sh", "entrypoint.sh"]
