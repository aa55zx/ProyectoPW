@echo off
echo ========================================
echo AGREGANDO 20 ASESORES A LA BASE DE DATOS
echo ========================================
echo.

php artisan db:seed --class=AsesoresSeeder

echo.
echo ========================================
echo PROCESO COMPLETADO
echo ========================================
echo.
echo Credenciales de acceso:
echo Email: [cualquiera de los emails del seeder]
echo Password: password
echo.
echo Ejemplos:
echo - miguel.torres@tecnm.mx / password
echo - ana.hernandez@tecnm.mx / password
echo - jose.garcia@tecnm.mx / password
echo.
pause
