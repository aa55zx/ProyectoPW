@echo off
echo ============================================
echo    POBLANDO BASE DE DATOS - EventTec
echo ============================================
echo.

echo Borrando base de datos anterior y recreando...
php artisan migrate:fresh

echo.
echo Poblando con usuarios...
php artisan db:seed

echo.
echo ============================================
echo    BASE DE DATOS LISTA
echo ============================================
echo.
echo USUARIOS DISPONIBLES:
echo.
echo [ASESORES/MAESTROS]
echo - ana.garcia@asesor.com / password123
echo - carlos.mendoza@asesor.com / password123
echo - maria.lopez@maestro.com / password123
echo.
echo [ESTUDIANTES]
echo - carlos@estudiante.com / password123
echo - cheluisruiz8@gmail.com / password
echo.
echo [JUEZ]
echo - maria@juez.com / password123
echo.
echo [ADMIN]
echo - admin@eventec.com / admin123
echo.
echo ============================================
echo.
pause
