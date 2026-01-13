@REM composer dump-autoload --optimize
@REM composer install --optimize-autoloader --no-dev
@REM composer update --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
