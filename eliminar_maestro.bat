@echo off
echo ============================================
echo    LIMPIANDO CACHE Y ELIMINANDO MAESTRO
echo ============================================
echo.

echo Limpiando rutas...
php artisan route:clear

echo Limpiando configuracion...
php artisan config:clear

echo Limpiando cache general...
php artisan cache:clear

echo Limpiando vistas compiladas...
php artisan view:clear

echo.
echo ============================================
echo    CAMBIOS APLICADOS EXITOSAMENTE
echo ============================================
echo.
echo AHORA:
echo 1. Cierra sesion si estas logueado
echo 2. Inicia sesion nuevamente con:
echo    Email: ana.garcia@asesor.com
echo    Password: password123
echo.
echo 3. Seras redirigido automaticamente a:
echo    http://localhost:8000/asesor/dashboard
echo.
pause
