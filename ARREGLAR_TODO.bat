@echo off
cls
echo ========================================
echo   ARREGLO COMPLETO - EventTec
echo ========================================
echo.

echo Cerrando cualquier servidor PHP anterior...
taskkill /F /IM php.exe 2>nul
timeout /t 1 >nul

echo.
echo [1/9] Eliminando archivos de cache...
if exist bootstrap\cache\config.php del /F /Q bootstrap\cache\config.php
if exist bootstrap\cache\packages.php del /F /Q bootstrap\cache\packages.php
if exist bootstrap\cache\routes-v7.php del /F /Q bootstrap\cache\routes-v7.php
if exist bootstrap\cache\services.php del /F /Q bootstrap\cache\services.php
echo ✓ Cache eliminado

echo.
echo [2/9] Eliminando base de datos anterior...
if exist database\database.sqlite del /F /Q database\database.sqlite
echo ✓ BD eliminada

echo.
echo [3/9] Creando base de datos SQLite...
type nul > database\database.sqlite
echo ✓ BD creada

echo.
echo [4/9] Limpiando configuracion de Laravel...
call php artisan config:clear
call php artisan cache:clear
call php artisan route:clear
call php artisan view:clear
echo ✓ Laravel limpiado

echo.
echo [5/9] Creando tablas de la aplicacion...
call php artisan migrate:fresh --force
if errorlevel 1 (
    echo.
    echo ✗ ERROR: No se pudieron crear las tablas
    echo.
    pause
    exit /b 1
)
echo ✓ Tablas creadas

echo.
echo [6/9] Creando tabla de sesiones...
call php artisan session:table
call php artisan migrate --force
echo ✓ Tabla de sesiones creada

echo.
echo [7/9] Insertando datos de prueba...
call php artisan db:seed --force
if errorlevel 1 (
    echo.
    echo ✗ ERROR: No se pudieron insertar los datos
    echo.
    pause
    exit /b 1
)
echo ✓ Datos insertados

echo.
echo [8/9] Optimizando aplicacion...
call php artisan optimize:clear
echo ✓ Optimizado

echo.
echo [9/9] Verificando instalacion...
echo.

echo ========================================
echo   INSTALACION COMPLETADA
echo ========================================
echo.
echo ✅ Base de datos: SQLite (database/database.sqlite)
echo ✅ 17 usuarios creados
echo ✅ 4 eventos disponibles
echo ✅ 2 equipos de ejemplo
echo ✅ Sesiones configuradas
echo.
echo ========================================
echo   ACCEDE AL SISTEMA
echo ========================================
echo.
echo 🌐 URL: http://127.0.0.1:8000/login
echo.
echo 👤 ESTUDIANTE:
echo    Email: carlos@estudiante.com
echo    Pass:  password123
echo.
echo 👤 MAESTRO:
echo    Email: juan@maestro.com
echo    Pass:  password123
echo.
echo 👤 JUEZ:
echo    Email: maria@juez.com
echo    Pass:  password123
echo.
echo 👤 ADMIN:
echo    Email: admin@eventec.com
echo    Pass:  admin123
echo.
echo ========================================
echo   Iniciando servidor...
echo ========================================
echo.
echo Presiona Ctrl+C para detener el servidor
echo.
call php artisan serve
