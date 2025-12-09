@echo off
echo ============================================
echo   REEMPLAZANDO BASE DE DATOS
echo ============================================
echo.

echo [1/4] Haciendo backup de la base actual...
if exist "database\database.sqlite" (
    copy "database\database.sqlite" "database\database_backup_old.sqlite"
    echo Backup creado: database_backup_old.sqlite
)

echo.
echo [2/4] Eliminando base antigua...
if exist "database\database.sqlite" (
    del "database\database.sqlite"
    echo Base antigua eliminada
)

echo.
echo [3/4] ATENCION: Necesitas copiar manualmente el archivo
echo.
echo El archivo database.sqlite que subiste esta en la carpeta de descargas.
echo Buscalo y copialo a:
echo    %CD%\database\database.sqlite
echo.
echo Presiona cualquier tecla cuando ya lo hayas copiado...
pause

echo.
echo [4/4] Verificando...
if exist "database\database.sqlite" (
    echo ✅ Base de datos encontrada!
    echo.
    echo Limpiando cache...
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear
    echo.
    echo ✅ TODO LISTO!
    echo Ahora ejecuta: php artisan serve
) else (
    echo ❌ ERROR: No se encontro database.sqlite
    echo Por favor copia el archivo manualmente
)

echo.
pause
