@echo off
cls
echo APLICANDO CORRECCION FINAL - JOIN EVENTS
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
echo - Columnas ambiguas corregidas
echo - JOIN con events agregado
echo - Campo event_title agregado
echo.
echo Recarga: http://127.0.0.1:8000/asesor/equipos
echo.
echo AHORA DEBE FUNCIONAR
pause
