@echo off
cls
echo APLICANDO CORRECCION FINAL
echo.
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.
php artisan config:cache
php artisan route:cache
echo.
echo CORRECCION APLICADA
echo Error de columnas ambiguas SOLUCIONADO
echo.
echo Recarga: http://127.0.0.1:8000/asesor/equipos
echo.
pause
