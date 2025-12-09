@echo off
color 0A
cls
echo.
echo ================================================================
echo              SOLUCION PROBLEMA SUBIDA DE ARCHIVOS
echo ================================================================
echo.
echo Este script corregira el problema de subida de archivos
echo.
echo ================================================================
echo.
pause

echo.
echo [PASO 1/5] Creando enlace simbolico de storage...
echo ----------------------------------------------------------------
php artisan storage:link
if %errorlevel% neq 0 (
    echo AVISO: El enlace ya existe o hubo un error menor
)

echo.
echo [PASO 2/5] Creando directorios necesarios...
echo ----------------------------------------------------------------
if not exist "storage\app\public\submissions" (
    mkdir "storage\app\public\submissions"
    echo ✓ Directorio submissions creado
) else (
    echo ✓ Directorio submissions ya existe
)

if not exist "public\storage" (
    mklink /D "public\storage" "%cd%\storage\app\public"
    echo ✓ Enlace simbolico creado manualmente
)

echo.
echo [PASO 3/5] Limpiando cache...
echo ----------------------------------------------------------------
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1
echo ✓ Cache limpiado

echo.
echo [PASO 4/5] Verificando configuracion PHP...
echo ----------------------------------------------------------------
for /f "tokens=3" %%a in ('php -i ^| findstr "upload_max_filesize"') do (
    echo upload_max_filesize: %%a
)
for /f "tokens=3" %%a in ('php -i ^| findstr "post_max_size"') do (
    echo post_max_size: %%a
)

echo.
echo [PASO 5/5] Verificando estructura de directorios...
echo ----------------------------------------------------------------
if exist "storage\app\public\submissions" (
    echo ✓ storage\app\public\submissions - OK
) else (
    echo ✗ storage\app\public\submissions - NO EXISTE
)

if exist "public\storage" (
    echo ✓ public\storage - OK
) else (
    echo ✗ public\storage - NO EXISTE
)

echo.
echo ================================================================
echo                    PROCESO COMPLETADO
echo ================================================================
echo.
echo ✓ Configuracion de storage completada
echo ✓ Directorios creados
echo ✓ Cache limpiado
echo.
echo Si aun tienes problemas, verifica:
echo 1. Los permisos de la carpeta storage
echo 2. Los limites de PHP (php.ini)
echo 3. Los logs en storage\logs\laravel.log
echo.
pause
