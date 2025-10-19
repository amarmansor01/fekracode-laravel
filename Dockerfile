FROM php:8.2-cli

# تثبيت المكتبات المطلوبة + دعم PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install -j$(nproc) mbstring exif pcntl bcmath gd \
    && docker-php-ext-install -j$(nproc) pdo_pgsql pgsql

# تثبيت Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# نسخ المشروع
COPY . .

# تثبيت مكتبات PHP
RUN composer install --no-dev --optimize-autoloader

# تثبيت Node.js وبناء الواجهة (Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm ci \
    && npm run build \
    && rm -rf node_modules

# إعطاء صلاحيات للمجلدات
RUN chmod -R 775 storage bootstrap/cache

# Render يمرر البورت عبر متغير PORT
EXPOSE 10000

# استدعاء سكربت التشغيل
CMD ["sh", "entrypoint.sh"]
