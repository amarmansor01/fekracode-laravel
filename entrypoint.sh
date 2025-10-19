#!/bin/sh
set -e

# تنظيف الكاشات
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# تثبيت مكتبات Node وبناء الأصول (Vite)
if [ -f package.json ]; then
  npm ci
  npm run build
fi

# تشغيل الهجرات
php artisan migrate --force

# تشغيل السيرفر
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
