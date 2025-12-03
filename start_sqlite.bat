@echo off
chcp 65001 >nul
cls
echo.
echo ========================================
echo   CONFIGURACION RAPIDA - SQLite
echo ========================================
echo.

echo [1/6] Creando base de datos SQLite...
if exist database\database.sqlite (
    echo    ✓ Base de datos ya existe, eliminando...
    del database\database.sqlite
)
type nul > database\database.sqlite
echo    ✓ Base de datos creada

echo.
echo [2/6] Limpiando cache de configuracion...
php artisan config:clear >nul 2>&1
echo    ✓ Config limpiado

echo.
echo [3/6] Limpiando cache general...
php artisan cache:clear >nul 2>&1
echo    ✓ Cache limpiado

echo.
echo [4/6] Limpiando rutas...
php artisan route:clear >nul 2>&1
echo    ✓ Rutas limpiadas

echo.
echo [5/6] Ejecutando migraciones...
php artisan migrate:fresh --force
if errorlevel 1 (
    echo    ✗ Error en migraciones
    pause
    exit /b 1
)
echo    ✓ Tablas creadas

echo.
echo [6/6] Ejecutando seeders (esto puede tardar)...
php artisan db:seed --force
if errorlevel 1 (
    echo    ✗ Error en seeders
    pause
    exit /b 1
)
echo    ✓ Datos insertados

echo.
echo ========================================
echo   CONFIGURACION COMPLETADA
echo ========================================
echo.
echo 🎉 Tu aplicacion esta lista!
echo.
echo 📧 Usuarios de prueba:
echo.
echo   [ESTUDIANTE]
echo   Email: carlos@estudiante.com
echo   Password: password123
echo.
echo   [MAESTRO]
echo   Email: juan@maestro.com
echo   Password: password123
echo.
echo   [JUEZ]
echo   Email: maria@juez.com
echo   Password: password123
echo.
echo   [ADMIN]
echo   Email: admin@eventec.com
echo   Password: admin123
echo.
echo ========================================
echo.
echo Presiona Ctrl+C para detener el servidor
echo.
echo Iniciando servidor en http://127.0.0.1:8000
echo ========================================
echo.
php artisan serve
