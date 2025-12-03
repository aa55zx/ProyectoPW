@echo off
echo ====================================
echo   LIMPIANDO CACHE DE LARAVEL
echo ====================================
echo.
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.
echo ====================================
echo   CACHE LIMPIADO!
echo ====================================
echo.
echo Ahora ejecuta INICIAR.bat
pause
