@echo off
cls
echo CREANDO TABLA advisor_requests
echo.
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
echo.
if %errorlevel% neq 0 (
    echo Error en migracion - intentando forzar...
    php artisan migrate:refresh --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
)
echo.
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.
php artisan config:cache
php artisan route:cache
echo.
echo LISTO
pause
