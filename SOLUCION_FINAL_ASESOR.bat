@echo off
cls
echo ========================================
echo   SOLUCION APLICADA - ASESOR
echo ========================================
echo.
echo ✓ LoginController corregido
echo   Ahora detecta: role, rol y user_type
echo.
echo ========================================
echo   LIMPIANDO TODO EL SISTEMA:
echo ========================================
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo.
echo ✓ Cache completamente limpiado
echo.
echo ========================================
echo   OPTIMIZANDO:
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Sistema optimizado
echo.
echo ========================================
echo   IMPORTANTE - HAZ ESTO AHORA:
echo ========================================
echo.
echo 1. CIERRA TODAS las ventanas del navegador
echo    (Chrome, Edge, Firefox, etc)
echo.
echo 2. Abre MODO INCOGNITO:
echo    Chrome: Ctrl + Shift + N
echo    Edge:   Ctrl + Shift + N
echo.
echo 3. Ve a: http://127.0.0.1:8000/login
echo.
echo 4. Inicia sesion con ASESOR:
echo    ┌────────────────────────────────┐
echo    │ Email:    asesor1@asesor.com   │
echo    │ Password: password123          │
echo    └────────────────────────────────┘
echo.
echo 5. DEBE redirigir a: /asesor/dashboard
echo.
echo ========================================
echo   CREDENCIALES DE TODOS LOS ROLES:
echo ========================================
echo.
echo ESTUDIANTE:
echo   Email:    carlos1@estudiante.com
echo   Password: password123
echo   URL:      /estudiante/dashboard
echo.
echo ASESOR/MAESTRO:
echo   Email:    asesor1@asesor.com
echo   Password: password123
echo   URL:      /asesor/dashboard
echo.
echo ADMIN:
echo   Email:    admin@admin.com
echo   Password: password123
echo   URL:      /admin/dashboard
echo.
echo JUEZ:
echo   Email:    juez1@juez.com
echo   Password: password123
echo   URL:      /juez/dashboard
echo.
echo ========================================
echo   SI AUN NO FUNCIONA:
echo ========================================
echo.
echo Ejecuta: DIAGNOSTICO_ASESOR.bat
echo.
echo Esto te dira exactamente cual es el problema
echo.
echo ========================================
echo   SERVIDOR LISTO:
echo ========================================
echo.
echo Asegurate de que el servidor este corriendo:
echo   php artisan serve
echo.
echo Luego accede a: http://127.0.0.1:8000
echo.
echo ========================================
pause
