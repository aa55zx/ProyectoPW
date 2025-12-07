@echo off
echo ============================================
echo    ACTUALIZANDO BASE DE DATOS - ASESOR
echo ============================================
echo.

echo Ejecutando migraciones...
php artisan migrate

echo.
echo ============================================
echo    ACTUALIZACION COMPLETADA
echo ============================================
echo.
echo CAMBIOS APLICADOS:
echo - Tabla advisor_requests creada
echo - Sistema de solicitudes de asesoria listo
echo - Dashboard actualizado
echo - Vista de equipos actualizada
echo.
echo FUNCIONALIDADES NUEVAS:
echo 1. Estudiantes pueden solicitar asesor
echo 2. Asesores ven solicitudes pendientes
echo 3. Asesores pueden aceptar/rechazar
echo 4. Dashboard muestra equipos asignados
echo 5. Eventos filtrados por equipos del asesor
echo.
pause
