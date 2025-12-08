@echo off
cls
echo ========================================
echo   DIAGNOSTICO DE ERROR
echo ========================================
echo.
echo Revisando logs de Laravel...
echo.
type storage\logs\laravel.log | findstr /C:"ERROR" /C:"Exception" /C:"Fatal" | more
echo.
echo ========================================
echo   LIMPIANDO CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   VERIFICANDO SINTAXIS
echo ========================================
echo.
php -l app\Http\Controllers\Estudiante\ProyectoController.php
echo.
if %errorlevel% equ 0 (
    echo ✓ Sintaxis correcta
) else (
    echo ✗ Error de sintaxis detectado
)
echo.
echo ========================================
echo   REGENERANDO
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo Intenta acceder de nuevo
echo.
pause
