@echo off
echo ========================================
echo LIMPIANDO CACHE
echo ========================================
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear

echo.
echo ========================================
echo Reiniciando servidor...
echo ========================================
echo.
echo Presiona Ctrl+C para detener el servidor
echo Luego ejecuta: php artisan serve
echo.
pause
