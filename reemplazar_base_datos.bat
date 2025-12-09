@echo off
echo ============================================
echo   REEMPLAZAR BASE DE DATOS CON LA CORRECTA
echo ============================================
echo.

echo [1/3] Haciendo backup de tu base actual...
if exist database\database.sqlite (
    copy database\database.sqlite database\database_old_backup.sqlite
    echo Backup creado: database_old_backup.sqlite
) else (
    echo No habia base de datos anterior
)

echo.
echo [2/3] Copiando la base de datos correcta...
echo IMPORTANTE: Descarga el archivo desde aqui y copialo manualmente:
echo.
echo 1. Descarga: /tmp/database_backup.sqlite
echo 2. Copialo a: C:\Users\merin\Downloads\ProyectoPW\database\database.sqlite
echo.

echo [3/3] Limpiando cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo ============================================
echo              INSTRUCCIONES
echo ============================================
echo.
echo Necesitas copiar manualmente el archivo database.sqlite
echo que tu companero te paso a la carpeta:
echo   C:\Users\merin\Downloads\ProyectoPW\database\
echo.
echo Despues ejecuta: php artisan serve
echo.
pause
