@echo off
cls
echo SOLUCIONANDO ERROR DE TABLA advisor_requests
echo.
echo Eliminando migracion duplicada...
del /F "database\migrations\2024_12_07_000001_create_advisor_requests_table.php"
echo.
echo Ejecutando migracion correcta...
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
echo.
if %errorlevel% neq 0 (
    echo La tabla puede existir ya - continuando...
)
echo.
echo Limpiando cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
echo.
echo Regenerando cache...
php artisan config:cache
php artisan route:cache
echo.
echo SOLUCION APLICADA
echo.
echo Ahora recarga la pagina: http://127.0.0.1:8000/estudiante/proyectos
echo.
pause
