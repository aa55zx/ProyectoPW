@echo off
cls
echo ========================================
echo   RESTAURACION TOTAL - SOLUCION
echo ========================================
echo.
echo Este script va a:
echo   1. Limpiar TODO el cache
echo   2. Verificar sintaxis
echo   3. Reiniciar servidor
echo.
pause
echo.
echo ========================================
echo   PASO 1: MATANDO SERVIDOR
echo ========================================
echo.
taskkill /F /IM php.exe 2>nul
timeout /t 2 /nobreak >nul
echo ✓ Servidor detenido
echo.
echo ========================================
echo   PASO 2: LIMPIANDO CACHE PROFUNDO
echo ========================================
echo.
del /Q bootstrap\cache\*.php 2>nul
del /Q storage\framework\cache\data\* 2>nul
del /Q storage\framework\sessions\* 2>nul
del /Q storage\framework\views\* 2>nul
echo.
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
echo.
echo ✓ Cache eliminado
echo.
echo ========================================
echo   PASO 3: VERIFICANDO SINTAXIS
echo ========================================
echo.
php -l app\Http\Controllers\Estudiante\ProyectoController.php
echo.
if %errorlevel% neq 0 (
    echo ✗ ERROR DE SINTAXIS DETECTADO
    echo El archivo tiene errores
    pause
    exit /b 1
)
echo.
echo ✓ Sintaxis correcta
echo.
echo ========================================
echo   PASO 4: REGENERANDO CACHE
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache regenerado
echo.
echo ========================================
echo   PASO 5: INICIANDO SERVIDOR
echo ========================================
echo.
echo Servidor iniciado en http://127.0.0.1:8000
echo.
start /B php artisan serve
timeout /t 3 /nobreak >nul
echo.
echo ========================================
echo   LISTO
echo ========================================
echo.
echo Ahora abre: http://127.0.0.1:8000/estudiante/proyectos
echo.
echo Si sigue sin funcionar, presiona CTRL+C
echo y dame el error EXACTO que aparece
echo.
pause
