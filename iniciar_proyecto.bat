@echo off
echo ========================================
echo   SOLUCION COMPLETA - EventTec SQLite
echo ========================================
echo.

echo [PASO 1] Deteniendo servidor si esta corriendo...
taskkill /F /IM php.exe 2>nul
timeout /t 2 >nul
echo    ✓ Procesos detenidos

echo.
echo [PASO 2] Eliminando cache y archivos temporales...
if exist bootstrap\cache\config.php del /F /Q bootstrap\cache\config.php
if exist bootstrap\cache\packages.php del /F /Q bootstrap\cache\packages.php
if exist bootstrap\cache\routes-v7.php del /F /Q bootstrap\cache\routes-v7.php
if exist bootstrap\cache\services.php del /F /Q bootstrap\cache\services.php
echo    ✓ Cache eliminado

echo.
echo [PASO 3] Eliminando base de datos anterior...
if exist database\database.sqlite del /F /Q database\database.sqlite
echo    ✓ Base de datos eliminada

echo.
echo [PASO 4] Creando nueva base de datos SQLite...
type nul > database\database.sqlite
echo    ✓ Base de datos creada

echo.
echo [PASO 5] Limpiando configuracion de Laravel...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo    ✓ Configuracion limpiada

echo.
echo [PASO 6] Creando tablas (esto puede tardar un poco)...
php artisan migrate:fresh
if errorlevel 1 (
    echo.
    echo    ✗ Error al crear tablas
    echo    Revisa que el archivo .env tenga: DB_CONNECTION=sqlite
    pause
    exit /b 1
)
echo    ✓ Tablas creadas

echo.
echo [PASO 7] Insertando datos de prueba (17 usuarios, 4 eventos)...
php artisan db:seed
if errorlevel 1 (
    echo.
    echo    ✗ Error al insertar datos
    pause
    exit /b 1
)
echo    ✓ Datos insertados

echo.
echo [PASO 8] Verificando base de datos...
php artisan tinker --execute="echo 'Usuarios: ' . \App\Models\User::count() . PHP_EOL; echo 'Eventos: ' . \App\Models\Event::count() . PHP_EOL;"
echo    ✓ Verificacion completa

echo.
echo ========================================
echo   CONFIGURACION COMPLETADA
echo ========================================
echo.
echo Tu aplicacion esta lista para usar!
echo.
echo 📍 URL: http://127.0.0.1:8000/login
echo.
echo 👤 USUARIOS DE PRUEBA:
echo.
echo   ESTUDIANTE:
echo   📧 Email: carlos@estudiante.com
echo   🔑 Password: password123
echo.
echo   MAESTRO:
echo   📧 Email: juan@maestro.com
echo   🔑 Password: password123
echo.
echo   JUEZ:
echo   📧 Email: maria@juez.com
echo   🔑 Password: password123
echo.
echo   ADMIN:
echo   📧 Email: admin@eventec.com
echo   🔑 Password: admin123
echo.
echo ========================================
echo   Iniciando servidor...
echo   Presiona Ctrl+C para detener
echo ========================================
echo.
php artisan serve
