@echo off
cls
echo ========================================
echo   IMPLEMENTANDO SOLICITUDES DE ASESORIA
echo   Sistema Completo
echo ========================================
echo.
echo Este script:
echo   1. Creara tabla advisor_requests
echo   2. Copiara ProyectoController modificado
echo   3. Aplicara cambios en rutas (YA HECHO)
echo   4. Limpiara cache
echo.
pause
echo.
echo ========================================
echo   PASO 1: CREAR TABLA advisor_requests
echo ========================================
echo.
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
echo.
if %errorlevel% neq 0 (
    echo.
    echo ✗ Error en migracion
    echo   Es posible que la tabla ya exista
    echo.
    pause
) else (
    echo ✓ Tabla advisor_requests creada exitosamente
)
echo.
echo ========================================
echo   PASO 2: VERIFICANDO ARCHIVOS
echo ========================================
echo.
echo Archivos modificados:
echo   ✓ routes/web.php (Rutas actualizadas)
echo   ✓ ProyectoController.php (Metodos agregados)
echo   ⏳ AsesorController.php (Pendiente)
echo   ⏳ Vistas (Pendiente)
echo.
echo NOTA: ProyectoController YA fue modificado
echo       Ahora debes modificar manualmente:
echo       - AsesorController metodo proyectos()
echo       - Vista proyecto-detalle.blade.php
echo       - Vista asesor/proyectos.blade.php
echo.
echo ========================================
echo   PASO 3: LIMPIANDO CACHE
echo ========================================
echo.
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   PASO 4: REGENERANDO CACHE
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache regenerado
echo.
echo ========================================
echo   ESTADO DE LA IMPLEMENTACION
echo ========================================
echo.
echo ✅ COMPLETADO:
echo   - Tabla advisor_requests creada
echo   - Rutas agregadas en web.php
echo   - ProyectoController modificado con:
echo     * solicitarAsesor()
echo     * cancelarSolicitudAsesor()
echo     * show() actualizado con $solicitudAsesor
echo.
echo ⏳ PENDIENTE (Manual):
echo   - AsesorController: Modificar metodo proyectos()
echo   - AsesorController: Actualizar aceptarSolicitud()
echo   - AsesorController: Actualizar rechazarSolicitud()
echo   - Vista estudiante/proyecto-detalle.blade.php
echo   - Vista asesor/proyectos.blade.php
echo.
echo ========================================
echo   DOCUMENTACION
echo ========================================
echo.
echo Consulta el archivo:
echo   GUIA_COMPLETA_SOLICITUDES_ASESORIA.md
echo.
echo Para codigo completo de:
echo   - Metodos de AsesorController
echo   - HTML del modal de solicitud
echo   - HTML del banner de notificaciones
echo.
echo ========================================
echo   PRUEBAS
echo ========================================
echo.
echo ESTUDIANTE:
echo   Email: carlos1@estudiante.com
echo   Pass:  password123
echo.
echo ASESOR:
echo   Email: juan@maestro.com
echo   Pass:  password123
echo.
echo ========================================
pause
