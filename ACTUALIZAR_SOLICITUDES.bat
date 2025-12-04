@echo off
echo ====================================
echo   ACTUALIZAR SISTEMA DE SOLICITUDES
echo ====================================
echo.
echo Ejecutando migracion de join_requests...
php artisan migrate
echo.
echo ✓ Migracion completada
echo.
echo Limpiando cache...
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ Sistema actualizado
echo.
echo FUNCIONALIDADES AGREGADAS:
echo - Los usuarios pueden solicitar unirse a equipos
echo - Los lideres ven las solicitudes pendientes
echo - Los lideres pueden aceptar o rechazar solicitudes
echo - Notificaciones automaticas al usuario
echo.
pause
