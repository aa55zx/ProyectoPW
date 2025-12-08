@echo off
cls
echo ========================================
echo   PERFIL ACTUALIZADO
echo   Eliminada tab de Notificaciones
echo ========================================
echo.
echo CAMBIOS APLICADOS:
echo   ✓ Eliminado tab "Notificaciones"
echo   ✓ Solo quedan: Historial y Cuenta
echo   ✓ Interfaz mas limpia
echo.
echo ========================================
echo   LIMPIANDO CACHE
echo ========================================
echo.
php artisan view:clear
php artisan cache:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Ve a: /estudiante/perfil
echo 2. DEBE mostrar solo 2 tabs:
echo    - Historial
echo    - Cuenta
echo.
echo ========================================
pause
