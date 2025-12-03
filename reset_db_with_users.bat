@echo off
echo ========================================
echo   RESETEAR BASE DE DATOS Y SEEDERS
echo ========================================
echo.

echo Limpiando configuraciones...
php artisan config:clear
php artisan cache:clear
php artisan route:clear

echo.
echo Ejecutando migraciones frescas...
php artisan migrate:fresh

echo.
echo Ejecutando seeders...
php artisan db:seed

echo.
echo ========================================
echo   PROCESO COMPLETADO
echo ========================================
echo.
echo Usuarios de prueba creados:
echo.
echo ESTUDIANTE:
echo   Email: carlos@estudiante.com
echo   Password: password123
echo.
echo ESTUDIANTE (tu email):
echo   Email: cheluisruiz8@gmail.com
echo   Password: password
echo.
echo MAESTRO:
echo   Email: juan@maestro.com
echo   Password: password123
echo.
echo JUEZ:
echo   Email: maria@juez.com
echo   Password: password123
echo.
echo ADMIN:
echo   Email: admin@eventec.com
echo   Password: admin123
echo.
pause
