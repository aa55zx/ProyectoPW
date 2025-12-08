@echo off
cls
echo ========================================
echo   SOLUCION: ERROR 419 PAGE EXPIRED
echo ========================================
echo.
echo Este error ocurre cuando:
echo   - El token CSRF expiro
echo   - La sesion caduco
echo   - Cache de navegador desactualizado
echo.
echo ========================================
echo   PASO 1: LIMPIANDO SESIONES
echo ========================================
echo.
REM Eliminar todas las sesiones
del /f /q "storage\framework\sessions\*" 2>nul
echo ✓ Sesiones eliminadas
echo.
echo ========================================
echo   PASO 2: LIMPIANDO CACHE LARAVEL
echo ========================================
echo.
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.
echo ✓ Cache Laravel limpiado
echo.
echo ========================================
echo   PASO 3: REGENERANDO CLAVES
echo ========================================
echo.
php artisan config:cache
echo.
echo ✓ Configuracion regenerada
echo.
echo ========================================
echo   PASO 4: VERIFICANDO .ENV
echo ========================================
echo.
findstr /i "SESSION_DRIVER SESSION_LIFETIME" .env
echo.
echo Debe decir:
echo   SESSION_DRIVER=file
echo   SESSION_LIFETIME=120
echo.
echo ========================================
echo   AHORA HAZ ESTO (IMPORTANTE):
echo ========================================
echo.
echo 1. CIERRA COMPLETAMENTE el navegador
echo    (Todas las pestañas de Chrome/Edge)
echo.
echo 2. BORRA cookies y cache del navegador:
echo    Chrome:
echo      - Presiona: Ctrl + Shift + Delete
echo      - Selecciona: "Todo el tiempo"
echo      - Marca: Cookies y Cache
echo      - Click: "Borrar datos"
echo.
echo 3. CIERRA el navegador de nuevo
echo.
echo 4. Abre NUEVA ventana en modo incognito
echo    - Presiona: Ctrl + Shift + N
echo.
echo 5. Ve a: http://127.0.0.1:8000/login
echo.
echo 6. Inicia sesion con ASESOR:
echo    Email:    asesor1@asesor.com
echo    Password: password123
echo.
echo ========================================
echo   SI EL ERROR PERSISTE:
echo ========================================
echo.
echo 1. Detiene el servidor (Ctrl + C)
echo.
echo 2. Ejecuta: php artisan serve
echo.
echo 3. Abre NUEVO navegador incognito
echo.
echo 4. Intenta de nuevo
echo.
echo ========================================
echo   ALTERNATIVA: USAR OTRO NAVEGADOR
echo ========================================
echo.
echo Si usas Chrome, prueba con:
echo   - Edge
echo   - Firefox
echo   - Brave
echo.
echo En modo incognito
echo.
echo ========================================
pause
