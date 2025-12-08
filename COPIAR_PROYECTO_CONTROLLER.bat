@echo off
cls
echo ========================================
echo   COPIANDO ProyectoController MODIFICADO
echo ========================================
echo.
echo Este archivo contiene:
echo   ✓ solicitarAsesor()
echo   ✓ cancelarSolicitudAsesor()
echo   ✓ show() modificado con $solicitudAsesor
echo.
pause
echo.
echo Copiando archivo...
echo.
copy /Y "ProyectoController_TEMP.php" "app\Http\Controllers\Estudiante\ProyectoController.php"
echo.
if %errorlevel% equ 0 (
    echo ✓ Archivo copiado exitosamente
) else (
    echo ✗ Error al copiar
)
echo.
echo ========================================
echo   LIMPIANDO CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   PROBANDO
echo ========================================
echo.
echo Verifica que exista la ruta:
php artisan route:list | findstr "solicitar-asesor"
echo.
echo ========================================
pause
