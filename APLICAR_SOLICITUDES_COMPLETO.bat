@echo off
cls
echo ========================================
echo   COMPLETANDO SISTEMA DE SOLICITUDES
echo   Aplicando archivos finales
echo ========================================
echo.
echo ARCHIVOS APLICADOS:
echo   ✅ routes/web.php
echo   ✅ proyecto-detalle.blade.php
echo   ✅ Migracion advisor_requests
echo.
echo ARCHIVOS PENDIENTES (copiar manualmente):
echo   ⏳ ProyectoController.php
echo   ⏳ AsesorController.php (metodos)
echo   ⏳ asesor/proyectos.blade.php
echo.
pause
echo.
echo ========================================
echo   PASO 1: MIGRAR TABLA
echo ========================================
echo.
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
echo.
if %errorlevel% neq 0 (
    echo ✗ Error o tabla ya existe
) else (
    echo ✓ Tabla advisor_requests creada
)
echo.
echo ========================================
echo   PASO 2: LIMPIAR CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo ✓ Cache limpiado
echo.
echo ========================================
echo   PASO 3: REGENERAR CACHE
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo ✓ Cache regenerado
echo.
echo ========================================
echo   ESTADO ACTUAL
echo ========================================
echo.
echo COMPLETADO:
echo   [✅] Tabla advisor_requests
echo   [✅] Rutas en web.php
echo   [✅] Vista proyecto-detalle.blade.php
echo        - Modal solicitar asesor
echo        - Estados de solicitud
echo        - Cancelar solicitud
echo.
echo PENDIENTE (Ver GUIA_COMPLETA_SOLICITUDES_ASESORIA.md):
echo   [⏳] ProyectoController.php
echo        Copiar metodos:
echo        - solicitarAsesor()
echo        - cancelarSolicitudAsesor()
echo        - Modificar show()
echo.
echo   [⏳] AsesorController.php
echo        Modificar:
echo        - proyectos() - agregar $solicitudesPendientes
echo        - aceptarSolicitud() - implementar logica
echo        - rechazarSolicitud() - implementar logica
echo.
echo   [⏳] asesor/proyectos.blade.php
echo        Agregar banner de notificaciones
echo.
echo ========================================
echo   PROBANDO RUTA
echo ========================================
echo.
php artisan route:list | findstr "solicitar-asesor"
echo.
echo Si ves las rutas arriba, el sistema esta listo
echo.
echo ========================================
pause
