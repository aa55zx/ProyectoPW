@echo off
cls
echo APLICANDO CAMBIOS FINALES
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo.
php artisan config:cache
php artisan route:cache
echo.
echo LISTO - Recarga la pagina del asesor
echo http://127.0.0.1:8000/asesor/equipos
echo.
echo FALTA: Agregar banner en la vista asesor/equipos.blade.php
echo Consulta: CODIGO_ASESOR_CONTROLLER.txt
echo.
pause
