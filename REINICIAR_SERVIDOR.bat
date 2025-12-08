@echo off
cls
echo ========================================
echo   SOLUCION RAPIDA - ERROR 419
echo ========================================
echo.
echo Aplicando solucion...
echo.
echo ========================================
echo   1. DETENIENDO SERVIDOR
echo ========================================
echo.
echo IMPORTANTE: Si tienes el servidor corriendo
echo             presiona Ctrl+C en esa ventana
echo.
pause
echo.
echo ========================================
echo   2. LIMPIANDO TODO
echo ========================================
echo.
REM Limpiar sesiones
if exist "storage\framework\sessions" (
    del /f /q "storage\framework\sessions\*" 2>nul
    echo ✓ Sesiones eliminadas
)

REM Limpiar cache
if exist "storage\framework\cache\data" (
    del /f /q "storage\framework\cache\data\*" 2>nul
    echo ✓ Cache eliminado
)

REM Limpiar vistas compiladas
if exist "storage\framework\views" (
    del /f /q "storage\framework\views\*" 2>nul
    echo ✓ Vistas eliminadas
)

echo.
echo ========================================
echo   3. LIMPIANDO CACHE ARTISAN
echo ========================================
echo.
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
echo.
echo ✓ Artisan limpiado
echo.
echo ========================================
echo   4. REGENERANDO CONFIGURACION
echo ========================================
echo.
php artisan config:cache
echo ✓ Config regenerado
echo.
echo ========================================
echo   5. INICIANDO SERVIDOR LIMPIO
echo ========================================
echo.
echo Servidor iniciando en: http://127.0.0.1:8000
echo.
echo ========================================
echo   AHORA HAZ ESTO EN TU NAVEGADOR:
echo ========================================
echo.
echo 1. CIERRA todas las ventanas del navegador
echo.
echo 2. ABRE el navegador de nuevo
echo.
echo 3. Presiona: Ctrl + Shift + Delete
echo.
echo 4. Selecciona:
echo    [✓] Cookies y datos de sitios
echo    [✓] Imagenes y archivos en cache
echo    Tiempo: "Desde siempre" o "Todo"
echo.
echo 5. Click en "Borrar datos"
echo.
echo 6. CIERRA el navegador completamente
echo.
echo 7. ABRE modo incognito: Ctrl + Shift + N
echo.
echo 8. Ve a: http://127.0.0.1:8000/login
echo.
echo 9. Inicia sesion:
echo    Email:    asesor1@asesor.com
echo    Password: password123
echo.
echo ========================================
echo   INICIANDO SERVIDOR...
echo ========================================
echo.
php artisan serve
