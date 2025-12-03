@echo off
cls
echo ========================================
echo   EventTec - Inicio con SQLite
echo ========================================
echo.

echo [1/8] Deteniendo servidor anterior...
taskkill /F /IM php.exe >nul 2>&1
timeout /t 1 >nul
echo ✓ Servidor detenido
echo.

echo [2/8] Eliminando cache...
if exist bootstrap\cache\config.php del /F /Q bootstrap\cache\config.php >nul 2>&1
if exist bootstrap\cache\packages.php del /F /Q bootstrap\cache\packages.php >nul 2>&1
if exist bootstrap\cache\routes-v7.php del /F /Q bootstrap\cache\routes-v7.php >nul 2>&1
if exist bootstrap\cache\services.php del /F /Q bootstrap\cache\services.php >nul 2>&1
call php artisan config:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
call php artisan route:clear >nul 2>&1
call php artisan view:clear >nul 2>&1
call php artisan optimize:clear >nul 2>&1
echo ✓ Cache eliminado
echo.

echo [3/8] Eliminando base de datos anterior...
if exist database\database.sqlite del /F /Q database\database.sqlite >nul 2>&1
echo ✓ BD eliminada
echo.

echo [4/8] Creando base de datos SQLite...
type nul > database\database.sqlite
echo ✓ BD creada (database\database.sqlite)
echo.

echo [5/8] Creando tablas...
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

echo [6/8] Insertando datos de prueba...
echo    (Esto puede tardar 1-2 minutos...)
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

echo [7/8] Optimizando Laravel...
call php artisan config:cache >nul 2>&1
call php artisan route:cache >nul 2>&1
call php artisan view:cache >nul 2>&1
echo ✓ Optimizado
echo.

echo [8/8] Verificando instalacion...
php artisan tinker --execute="echo '✓ Usuarios: ' . \App\Models\User::count() . PHP_EOL; echo '✓ Eventos: ' . \App\Models\Event::count() . PHP_EOL; echo '✓ Equipos: ' . \App\Models\Team::count() . PHP_EOL;"
echo.

echo ========================================
echo   INSTALACION COMPLETADA
echo ========================================
echo.
echo ✅ Base de datos: SQLite (database/database.sqlite)
echo ✅ 17 usuarios creados
echo ✅ 4 eventos disponibles
echo ✅ 2 equipos con miembros
echo ✅ 2 proyectos evaluados
echo ✅ Sistema listo para usar
echo.
echo ========================================
echo   ACCEDE AL SISTEMA
echo ========================================
echo.
echo 🌐 URL: http://127.0.0.1:8000/login
echo.
echo 👤 ESTUDIANTE:
echo    Email: carlos@estudiante.com
echo    Password: password123
echo.
echo 👤 MAESTRO:
echo    Email: juan@maestro.com
echo    Password: password123
echo.
echo 👤 JUEZ:
echo    Email: maria@juez.com
echo    Password: password123
echo.
echo 👤 ADMIN:
echo    Email: admin@eventec.com
echo    Password: admin123
echo.
echo ========================================
echo   Iniciando servidor Laravel...
echo ========================================
echo.
echo Presiona Ctrl+C para detener el servidor
echo.
call php artisan serve
