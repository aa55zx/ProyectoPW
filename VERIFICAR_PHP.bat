@echo off
echo.
echo ===================================================
echo   VERIFICANDO CONFIGURACION PHP
echo ===================================================
echo.

php -i | findstr "upload_max_filesize"
php -i | findstr "post_max_size"
php -i | findstr "max_file_uploads"
php -i | findstr "memory_limit"

echo.
echo ===================================================
echo   VALORES RECOMENDADOS
echo ===================================================
echo.
echo upload_max_filesize = 50M
echo post_max_size = 60M
echo max_file_uploads = 20
echo memory_limit = 256M
echo.
echo Si los valores actuales son menores, edita php.ini
echo.
pause
