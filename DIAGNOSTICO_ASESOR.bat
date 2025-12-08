@echo off
cls
echo ========================================
echo   DIAGNOSTICO ESPECIFICO - ASESOR
echo ========================================
echo.
echo Verificando por que asesor no funciona...
echo.
echo ========================================
echo   1. VERIFICANDO RUTAS DE ASESOR:
echo ========================================
echo.
php artisan route:list | findstr /i "asesor" > rutas_asesor.txt
type rutas_asesor.txt
echo.
if not exist rutas_asesor.txt (
    echo ✗ NO HAY RUTAS DE ASESOR REGISTRADAS
    echo   PROBLEMA: web.php no tiene rutas de asesor
) else (
    echo ✓ Rutas encontradas (ver arriba)
)
echo.
echo ========================================
echo   2. VERIFICANDO CONTROLADOR:
echo ========================================
echo.
if exist "app\Http\Controllers\Asesor\DashboardController.php" (
    echo ✓ DashboardController de asesor EXISTE
) else (
    echo ✗ DashboardController de asesor NO EXISTE
    echo   PROBLEMA: Falta el controlador
)
echo.
echo ========================================
echo   3. VERIFICANDO VISTA:
echo ========================================
echo.
if exist "resources\views\asesor\dashboard.blade.php" (
    echo ✓ Vista dashboard de asesor EXISTE
) else (
    echo ✗ Vista dashboard de asesor NO EXISTE
    echo   PROBLEMA: Falta la vista
)
echo.
echo ========================================
echo   4. VERIFICANDO MIDDLEWARE:
echo ========================================
echo.
if exist "app\Http\Middleware\RoleMiddleware.php" (
    echo ✓ RoleMiddleware EXISTE
    echo.
    echo Verificando roles permitidos:
    findstr /i "asesor" "app\Http\Middleware\RoleMiddleware.php"
) else (
    echo ✗ RoleMiddleware NO EXISTE
)
echo.
echo ========================================
echo   5. VERIFICANDO USUARIO EN BD:
echo ========================================
echo.
echo Ejecutando query SQL...
php artisan tinker --execute="echo \App\Models\User::where('email', 'asesor1@asesor.com')->first();"
echo.
echo ========================================
echo   6. VERIFICANDO LAYOUT DE ASESOR:
echo ========================================
echo.
if exist "resources\views\layouts\asesor.blade.php" (
    echo ✓ Layout de asesor EXISTE
) else (
    echo ✗ Layout de asesor NO EXISTE
    echo   PROBLEMA: Falta el layout
)
echo.
echo ========================================
echo   RESULTADO DEL DIAGNOSTICO:
echo ========================================
echo.
echo Revisa los puntos marcados con ✗
echo.
echo Si TODO tiene ✓ pero aun no funciona:
echo   1. Limpia cache: php artisan optimize:clear
echo   2. Cierra navegador completamente
echo   3. Abre en incognito
echo   4. Prueba login asesor
echo.
echo Si hay ✗ en algun punto:
echo   Ese es el problema - Necesitas crear ese archivo
echo.
echo ========================================
echo   LOGS DE ERROR:
echo ========================================
echo.
if exist "storage\logs\laravel.log" (
    echo Ultimas 20 lineas del log:
    powershell -Command "Get-Content 'storage\logs\laravel.log' -Tail 20"
) else (
    echo No hay archivo de logs
)
echo.
echo ========================================
pause
