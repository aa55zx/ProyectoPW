@echo off
echo ====================================
echo   INICIAR COMO ADMINISTRADOR
echo ====================================
echo.
echo Iniciando servidor Laravel...
echo.
start http://127.0.0.1:8000/login
php artisan serve
