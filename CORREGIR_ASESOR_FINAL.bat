@echo off
cls
echo ========================================
echo   SOLUCION: Error advisor_requests
echo ========================================
echo.
echo PROBLEMA ENCONTRADO:
echo   ✗ AsesorController intenta usar tabla "advisor_requests"
echo   ✗ Esa tabla NO existe en tu base de datos
echo.
echo CORRECCION APLICADA:
echo   ✓ AsesorController actualizado
echo   ✓ Eliminadas consultas a advisor_requests
echo   ✓ Dashboard funcionará sin esa tabla
echo.
echo ========================================
echo   LIMPIANDO CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   REGENERANDO CONFIGURACION
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Configuracion actualizada
echo.
echo ========================================
echo   AHORA PRUEBA ESTO:
echo ========================================
echo.
echo 1. DETIENE el servidor (Ctrl + C)
echo.
echo 2. REINICIA el servidor:
echo    php artisan serve
echo.
echo 3. En el navegador:
echo    - Ctrl + Shift + Delete
echo    - Borrar cookies y cache
echo    - Cerrar navegador
echo    - Abrir modo incognito (Ctrl + Shift + N)
echo.
echo 4. Ve a: http://127.0.0.1:8000/login
echo.
echo 5. Inicia sesion con MAESTRO:
echo    Email:    juan@maestro.com
echo    Password: password123
echo.
echo 6. DEBE funcionar y mostrar el dashboard
echo.
echo ========================================
echo   SERVIDOR LISTO
echo ========================================
echo.
echo Iniciando servidor...
echo.
php artisan serve
