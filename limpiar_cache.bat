@echo off
chcp 65001 >nul
cls
echo.
echo ========================================
echo   LIMPIANDO CACHE DE LARAVEL
echo ========================================
echo.

echo [1/4] Limpiando configuracion...
php artisan config:clear
echo    ✓ Listo

echo.
echo [2/4] Limpiando cache...
php artisan cache:clear
echo    ✓ Listo

echo.
echo [3/4] Limpiando rutas...
php artisan route:clear
echo    ✓ Listo

echo.
echo [4/4] Limpiando vistas...
php artisan view:clear
echo    ✓ Listo

echo.
echo ========================================
echo   CACHE LIMPIADO
echo ========================================
echo.
echo Ahora puedes iniciar el servidor con:
echo    php artisan serve
echo.
echo O ejecutar: start_sqlite.bat
echo.
pause
