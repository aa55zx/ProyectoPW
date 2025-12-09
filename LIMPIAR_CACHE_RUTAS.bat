@echo off
echo ========================================
echo  LIMPIAR CACHE DE RUTAS
echo ========================================
echo.

php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo Cache limpiado exitosamente
echo.
pause
