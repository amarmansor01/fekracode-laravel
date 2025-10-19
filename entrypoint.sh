#!/bin/sh

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# شغل السيرفر من مجلد public
php artisan serve --host 0.0.0.0 --port $PORT --public public
