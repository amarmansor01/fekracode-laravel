#!/bin/sh

# تنظيف الكاش
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# تشغيل المايغريشن (إجباري في production)
php artisan migrate --force

# تشغيل السيرفر على Render (البورت 10000)
php artisan serve --host=0.0.0.0 --port=10000
