#!/bin/sh
set -e

# تنظيف الكاش
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# ربط التخزين
php artisan storage:link || true

# تشغيل المايغريشن
php artisan migrate --force
php artisan db:seed --force

# إعادة بناء الكاش بعد تمرير env
php artisan config:cache
php artisan route:cache
php artisan view:cache

# تشغيل السيرفر
php artisan serve --host 0.0.0.0 --port $PORT
