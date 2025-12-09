@echo off
echo.
echo ===================================================
echo   CONFIGURANDO STORAGE PARA SUBIDA DE ARCHIVOS
echo ===================================================
echo.

echo [1/3] Creando enlace simbolico de storage...
php artisan storage:link

echo.
echo [2/3] Creando directorio submissions...
if not exist "storage\app\public\submissions" mkdir "storage\app\public\submissions"

echo.
echo [3/3] Verificando permisos...
icacls "storage\app\public\submissions" /grant Users:F /T >nul 2>&1

echo.
echo ===================================================
echo   CONFIGURACION COMPLETADA
echo ===================================================
echo.
echo ✓ Enlace simbolico creado
echo ✓ Directorio submissions creado
echo ✓ Permisos configurados
echo.
echo Ahora puedes subir archivos sin problemas.
echo.
pause
