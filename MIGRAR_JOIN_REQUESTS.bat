@echo off
echo ====================================
echo   AGREGAR TABLA JOIN REQUESTS
echo ====================================
echo.
echo Ejecutando migracion...
echo.
php artisan migrate
echo.
echo ✓ Migracion completada
echo.
pause
