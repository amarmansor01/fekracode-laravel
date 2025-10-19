#!/bin/sh

# تنظيف الكاش
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# تشغيل المايغريشن
php artisan migrate --force

# تشغيل السيرفر على البورت اللي Render يمرره
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
