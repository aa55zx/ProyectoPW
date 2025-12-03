@echo off
echo ====================================
echo   REHACER BASE DE DATOS
echo ====================================
echo.
echo ADVERTENCIA: Esto borrara todos los datos
echo.
pause
echo.
echo Limpiando cache...
call php artisan route:clear
call php artisan config:clear
call php artisan cache:clear
echo.
echo Recreando base de datos...
call php artisan migrate:fresh --seed
echo.
echo ✓ Base de datos recreada con fechas correctas
echo.
echo Credenciales:
echo Email: carlos1@estudiante.com
echo Password: password123
echo.
pause
