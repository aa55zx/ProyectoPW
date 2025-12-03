@echo off
echo ============================================
echo    CREANDO USUARIOS ASESOR
echo ============================================
echo.

echo Ejecutando seeder de asesor...
php artisan db:seed --class=AsesorSeeder

echo.
echo ============================================
echo    USUARIOS CREADOS EXITOSAMENTE
echo ============================================
echo.
echo Puedes iniciar sesion con:
echo.
echo Email: ana.garcia@asesor.com
echo Password: password123
echo.
echo Email: carlos.mendoza@asesor.com
echo Password: password123
echo.
echo Email: maria.lopez@maestro.com
echo Password: password123
echo.
echo ============================================
echo    Accede a: http://localhost:8000/login
echo ============================================
echo.
pause
