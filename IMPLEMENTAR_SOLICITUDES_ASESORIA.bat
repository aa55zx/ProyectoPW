@echo off
cls
echo ========================================
echo   SISTEMA DE SOLICITUDES DE ASESORIA
echo   Implementacion Completa
echo ========================================
echo.
echo Este script implementara:
echo   1. Tabla advisor_requests
echo   2. Vista estudiante: Solicitar asesor
echo   3. Vista asesor: Notificaciones
echo   4. Aceptar/Rechazar solicitudes
echo   5. Estados de solicitud
echo.
pause
echo.
echo ========================================
echo   PASO 1: MIGRANDO BASE DE DATOS
echo ========================================
echo.
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
echo.
if %errorlevel% neq 0 (
    echo ✗ Error en migracion
    echo   Verifica que la tabla no exista ya
    pause
) else (
    echo ✓ Tabla advisor_requests creada
)
echo.
echo ========================================
echo   PASO 2: LIMPIANDO CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
echo ✓ Cache limpiado
echo.
echo ========================================
echo   ARCHIVOS MODIFICADOS:
echo ========================================
echo.
echo ✓ ProyectoController.php
echo   - solicitarAsesor() - Enviar solicitud
echo   - cancelarSolicitudAsesor() - Cancelar
echo.
echo ✓ AsesorController.php  
echo   - proyectos() - Ver solicitudes
echo   - aceptarSolicitud() - Aceptar
echo   - rechazarSolicitud() - Rechazar
echo.
echo ✓ proyecto-detalle.blade.php
echo   - Modal "Solicitar Asesor"
echo   - Estado de solicitud
echo.
echo ✓ asesor/proyectos.blade.php
echo   - Notificaciones de solicitudes
echo   - Botones Aceptar/Rechazar
echo.
echo ========================================
echo   RUTAS AGREGADAS:
echo ========================================
echo.
echo POST /estudiante/proyectos/{id}/solicitar-asesor
echo POST /estudiante/proyectos/{id}/cancelar-solicitud-asesor
echo POST /asesor/solicitudes/{id}/aceptar
echo POST /asesor/solicitudes/{id}/rechazar
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo ESTUDIANTE:
echo   1. Ve a: /estudiante/proyectos/{id}
echo   2. Click "Seleccionar asesor"
echo   3. Elige asesor y escribe mensaje
echo   4. Click "Enviar solicitud"
echo   5. DEBE mostrar: "Solicitud enviada a..."
echo.
echo ASESOR:
echo   1. Ve a: /asesor/proyectos
echo   2. DEBE ver: Banner con solicitudes pendientes
echo   3. Click en solicitud
echo   4. Click "Aceptar" o "Rechazar"
echo   5. DEBE mostrar confirmacion
echo.
echo ESTUDIANTE (verificar estado):
echo   1. Recargar /estudiante/proyectos/{id}
echo   2. DEBE mostrar:
echo      - "Solicitud aceptada" (verde)
echo      - "Solicitud rechazada" (rojo)
echo      - "Solicitud pendiente" (amarillo)
echo.
echo ========================================
echo   CREDENCIALES DE PRUEBA:
echo ========================================
echo.
echo ESTUDIANTE (lider):
echo   Email: carlos1@estudiante.com
echo   Pass:  password123
echo.
echo ASESOR:
echo   Email: juan@maestro.com
echo   Pass:  password123
echo.
echo ========================================
pause
