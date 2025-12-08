@echo off
cls
echo ========================================
echo   PROBLEMA ENCONTRADO!
echo   SESSION_DRIVER incorrecto
echo ========================================
echo.
echo Tu .env dice:
echo   SESSION_DRIVER=database
echo.
echo Pero probablemente NO existe la tabla sessions
echo.
echo ========================================
echo   SOLUCION: Cambiar a SESSION_DRIVER=file
echo ========================================
echo.
echo Aplicando cambio...
echo.

REM Backup del .env
copy .env .env.backup >nul
echo ✓ Backup de .env creado

REM Cambiar SESSION_DRIVER de database a file
powershell -Command "(Get-Content .env) -replace 'SESSION_DRIVER=database', 'SESSION_DRIVER=file' | Set-Content .env"
echo ✓ SESSION_DRIVER cambiado a 'file'

echo.
echo ========================================
echo   LIMPIANDO CACHE
echo ========================================
echo.
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   REGENERANDO CONFIGURACION
echo ========================================
echo.
php artisan config:cache
echo.
echo ✓ Configuracion actualizada
echo.
echo ========================================
echo   LIMPIANDO SESIONES ANTIGUAS
echo ========================================
echo.
if exist "storage\framework\sessions" (
    del /f /q "storage\framework\sessions\*" 2>nul
    echo ✓ Sesiones eliminadas
) else (
    echo ! Carpeta de sesiones no existe
)
echo.
echo ========================================
echo   AHORA HAZ ESTO:
echo ========================================
echo.
echo 1. DETIENE el servidor si esta corriendo
echo    (Presiona Ctrl+C en la ventana del servidor)
echo.
echo 2. EJECUTA:
echo    REINICIAR_SERVIDOR.bat
echo.
echo 3. En el navegador:
echo    - Ctrl + Shift + Delete
echo    - Borrar cookies y cache
echo    - Cerrar navegador
echo    - Abrir modo incognito
echo    - Ve a: http://127.0.0.1:8000/login
echo.
echo 4. Inicia sesion con:
echo    Email:    asesor1@asesor.com
echo    Password: password123
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo El .env ahora tiene:
findstr "SESSION_DRIVER" .env
echo.
echo Debe decir: SESSION_DRIVER=file
echo.
echo ========================================
pause
