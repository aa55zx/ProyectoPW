@echo off
cls
echo ========================================
echo   SOLUCION FINAL - TODOS LOS ROLES
echo ========================================
echo.
echo PROBLEMA IDENTIFICADO:
echo   - El campo correcto es: user_type
echo   - NO es: role o rol
echo.
echo CORRECCION APLICADA:
echo   ✓ LoginController actualizado
echo   ✓ Usa user_type correctamente
echo   ✓ Agregado logging para debug
echo.
echo ========================================
echo   LIMPIANDO SISTEMA COMPLETO
echo ========================================
echo.
REM Cambiar SESSION_DRIVER a file
echo Corrigiendo SESSION_DRIVER...
powershell -Command "(Get-Content .env) -replace 'SESSION_DRIVER=database', 'SESSION_DRIVER=file' | Set-Content .env" 2>nul
echo ✓ SESSION_DRIVER = file

echo.
echo Limpiando sesiones antiguas...
if exist "storage\framework\sessions" (
    del /f /q "storage\framework\sessions\*" 2>nul
)
echo ✓ Sesiones eliminadas

echo.
echo Limpiando cache...
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo ✓ Cache limpiado

echo.
echo Regenerando configuracion...
php artisan config:cache
php artisan route:cache
echo ✓ Configuracion actualizada

echo.
echo ========================================
echo   CREDENCIALES SEGUN TU BD:
echo ========================================
echo.
echo ESTUDIANTES (@estudiante.com):
echo   - camila24@estudiante.com / password123
echo   - javier25@estudiante.com / password123
echo   user_type: estudiante
echo.
echo MAESTROS/ASESORES (@maestro.com):
echo   - juan@maestro.com / password123
echo   - roberto@maestro.com / password123
echo   - gabriela@maestro.com / password123
echo   user_type: maestro
echo.
echo JUECES (@juez.com):
echo   - maria@juez.com / password123
echo   - fernando@juez.com / password123
echo   - patricia@juez.com / password123
echo   user_type: juez
echo.
echo ADMIN (@eventec.com):
echo   - admin@eventec.com / password123
echo   user_type: admin
echo.
echo ========================================
echo   IMPORTANTE - LIMPIA EL NAVEGADOR
echo ========================================
echo.
echo 1. CIERRA todas las ventanas del navegador
echo.
echo 2. ABRE el navegador
echo.
echo 3. Presiona: Ctrl + Shift + Delete
echo.
echo 4. Selecciona:
echo    [✓] Cookies y datos de sitios
echo    [✓] Imagenes y archivos en cache
echo    Tiempo: Desde siempre
echo.
echo 5. Click "Borrar datos"
echo.
echo 6. CIERRA el navegador completamente
echo.
echo 7. ABRE modo incognito: Ctrl + Shift + N
echo.
echo ========================================
echo   PRUEBA CADA USUARIO:
echo ========================================
echo.
echo ESTUDIANTE:
echo   http://127.0.0.1:8000/login
echo   camila24@estudiante.com / password123
echo   → Debe ir a: /estudiante/dashboard
echo.
echo MAESTRO/ASESOR:
echo   http://127.0.0.1:8000/login
echo   juan@maestro.com / password123
echo   → Debe ir a: /asesor/dashboard
echo.
echo JUEZ:
echo   http://127.0.0.1:8000/login
echo   maria@juez.com / password123
echo   → Debe ir a: /juez/dashboard
echo.
echo ADMIN:
echo   http://127.0.0.1:8000/login
echo   admin@eventec.com / password123
echo   → Debe ir a: /admin/dashboard
echo.
echo ========================================
echo   SI SALE ERROR 419:
echo ========================================
echo.
echo 1. Asegurate de haber borrado cookies
echo 2. Usa modo incognito
echo 3. Cierra y abre el navegador de nuevo
echo 4. Prueba con otro navegador (Edge, Firefox)
echo.
echo ========================================
echo   VERIFICAR LOGS:
echo ========================================
echo.
echo Si algun usuario no funciona:
echo   1. Intenta iniciar sesion
echo   2. Ve a: storage\logs\laravel.log
echo   3. Busca: "Login exitoso"
echo   4. Veras el user_type detectado
echo.
echo ========================================
echo   SERVIDOR LISTO
echo ========================================
echo.
echo Iniciando servidor en: http://127.0.0.1:8000
echo.
echo Presiona Ctrl+C para detener
echo.
php artisan serve
