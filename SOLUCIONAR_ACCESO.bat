@echo off
cls
echo ========================================
echo   SOLUCION: PROBLEMA DE ACCESO
echo   SOLO ESTUDIANTE FUNCIONA
echo ========================================
echo.
echo Este script solucionara el problema
echo.
pause
echo.
echo ========================================
echo   PASO 1: LIMPIANDO TODO
echo ========================================
echo.
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   PASO 2: VERIFICANDO SESION
echo ========================================
echo.
php artisan session:table 2>nul
if %errorlevel% neq 0 (
    echo ✓ Usando sesiones de archivo
) else (
    echo ✓ Tabla de sesiones disponible
)
echo.
echo ========================================
echo   PASO 3: OPTIMIZANDO
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Sistema optimizado
echo.
echo ========================================
echo   PASO 4: INSTRUCCIONES
echo ========================================
echo.
echo IMPORTANTE - Haz esto ahora:
echo.
echo 1. Cierra TODAS las ventanas del navegador
echo    (Incluyendo Chrome, Edge, Firefox, etc)
echo.
echo 2. Abre una ventana NUEVA en modo incognito:
echo    Chrome: Ctrl + Shift + N
echo    Edge:   Ctrl + Shift + N
echo    Firefox: Ctrl + Shift + P
echo.
echo 3. Ve a: http://127.0.0.1:8000
echo.
echo 4. Prueba iniciar sesion con ASESOR:
echo    Email:    asesor1@asesor.com
echo    Password: password123
echo.
echo 5. Si funciona: ✓ Problema resuelto
echo    Si no funciona: Ejecuta DIAGNOSTICO_ROLES.bat
echo.
echo ========================================
echo   CREDENCIALES DE PRUEBA:
echo ========================================
echo.
echo ESTUDIANTE:
echo   Email:    carlos1@estudiante.com
echo   Password: password123
echo   URL:      /estudiante/dashboard
echo.
echo ASESOR:
echo   Email:    asesor1@asesor.com
echo   Password: password123
echo   URL:      /asesor/dashboard
echo.
echo ADMIN:
echo   Email:    admin@admin.com
echo   Password: password123
echo   URL:      /admin/dashboard
echo.
echo ========================================
echo   QUE HACER SI AUN FALLA:
echo ========================================
echo.
echo Si asesor o admin NO funcionan:
echo.
echo 1. Ejecuta: DIAGNOSTICO_ROLES.bat
echo    Esto te mostrara donde esta el problema
echo.
echo 2. Comparte la info:
echo    - Mensaje de error exacto
echo    - URL que muestra el navegador
echo    - Si muestra 403, 404, o redirige
echo.
echo 3. Verifica el archivo web.php:
echo    Abre: routes\web.php
echo    Busca las rutas de asesor y admin
echo.
echo ========================================
pause
