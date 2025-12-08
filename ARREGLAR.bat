@echo off
cls
echo RESTAURACION TOTAL
echo.
taskkill /F /IM php.exe
timeout /t 2 /nobreak
echo.
del /Q bootstrap\cache\*.php
del /Q storage\framework\cache\data\*
del /Q storage\framework\sessions\*
del /Q storage\framework\views\*
echo.
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
echo.
php artisan config:cache
php artisan route:cache
echo.
echo LISTO - Presiona cualquier tecla
pause
echo.
start /B php artisan serve
timeout /t 3
echo.
echo Servidor iniciado en http://127.0.0.1:8000
echo.
pause
