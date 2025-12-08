@echo off
cls
echo ========================================
echo   DIAGNOSTICO DE ROLES
echo ========================================
echo.
echo Verificando sistema...
echo.
echo ========================================
echo   VERIFICANDO RUTAS:
echo ========================================
echo.
echo Rutas de ESTUDIANTE:
php artisan route:list | findstr "estudiante"
echo.
echo Rutas de ASESOR:
php artisan route:list | findstr "asesor"
echo.
echo Rutas de ADMIN:
php artisan route:list | findstr "admin"
echo.
echo ========================================
echo   VERIFICANDO MIDDLEWARE:
echo ========================================
echo.
if exist "app\Http\Middleware\RoleMiddleware.php" (
    echo ✓ RoleMiddleware existe
    echo Contenido:
    type "app\Http\Middleware\RoleMiddleware.php" | findstr "role"
) else (
    echo ✗ RoleMiddleware NO existe
)
echo.
echo ========================================
echo   VERIFICANDO CONTROLADORES:
echo ========================================
echo.
if exist "app\Http\Controllers\Estudiante\DashboardController.php" (
    echo ✓ Estudiante\DashboardController existe
) else (
    echo ✗ Estudiante\DashboardController NO existe
)
echo.
if exist "app\Http\Controllers\Asesor\DashboardController.php" (
    echo ✓ Asesor\DashboardController existe
) else (
    echo ✗ Asesor\DashboardController NO existe
)
echo.
if exist "app\Http\Controllers\Admin\DashboardController.php" (
    echo ✓ Admin\DashboardController existe
) else (
    echo ✗ Admin\DashboardController NO existe
)
echo.
echo ========================================
echo   VERIFICANDO VISTAS:
echo ========================================
echo.
if exist "resources\views\estudiante\dashboard.blade.php" (
    echo ✓ Vista estudiante\dashboard existe
) else (
    echo ✗ Vista estudiante\dashboard NO existe
)
echo.
if exist "resources\views\asesor\dashboard.blade.php" (
    echo ✓ Vista asesor\dashboard existe
) else (
    echo ✗ Vista asesor\dashboard NO existe
)
echo.
if exist "resources\views\admin\dashboard.blade.php" (
    echo ✓ Vista admin\dashboard existe
) else (
    echo ✗ Vista admin\dashboard NO existe
)
echo.
echo ========================================
echo   VERIFICANDO BASE DE DATOS:
echo ========================================
echo.
if exist "database\database.sqlite" (
    echo ✓ Base de datos existe
) else (
    echo ✗ Base de datos NO existe
    echo   Ejecuta: php artisan migrate
)
echo.
echo ========================================
echo   SOLUCION RAPIDA:
echo ========================================
echo.
echo Si solo estudiante funciona, ejecuta:
echo.
echo 1. Limpia cache:
echo    php artisan optimize:clear
echo.
echo 2. Verifica web.php:
echo    Abre: routes\web.php
echo    Busca: Route::middleware(['auth', 'role:asesor'])
echo.
echo 3. Cierra sesion y prueba con:
echo    asesor1@asesor.com / password123
echo.
echo 4. Si da error 403 o 404:
echo    - Error 403: Middleware bloqueando
echo    - Error 404: Ruta no existe
echo.
echo ========================================
echo   LOGS DEL SERVIDOR:
echo ========================================
echo.
echo Revisa: storage\logs\laravel.log
echo Busca errores recientes
echo.
echo ========================================
pause
