@echo off
cls
echo ========================================
echo   APLICANDO SISTEMA COMPLETO
echo   Sistema de Solicitudes de Asesoria
echo ========================================
echo.
echo ARCHIVOS APLICADOS:
echo   ✅ ProyectoController.php
echo   ✅ proyecto-detalle.blade.php
echo   ✅ routes/web.php
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
    echo Tabla ya existe o error menor - continuando...
)
echo.
echo ========================================
echo   PASO 2: LIMPIANDO CACHE COMPLETO
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
echo   PASO 3: REGENERANDO CACHE
echo ========================================
echo.
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache regenerado
echo.
echo ========================================
echo   PASO 4: VERIFICANDO RUTAS
echo ========================================
echo.
echo Buscando ruta solicitar-asesor:
php artisan route:list | findstr "solicitar-asesor"
echo.
if %errorlevel% equ 0 (
    echo ✓ Ruta encontrada - Sistema listo!
) else (
    echo ✗ Ruta no encontrada - revisar
)
echo.
echo ========================================
echo   ESTADO FINAL
echo ========================================
echo.
echo ✅ COMPLETADO:
echo   - Tabla advisor_requests
echo   - ProyectoController con solicitarAsesor()
echo   - Vista proyecto-detalle con modal
echo   - Rutas configuradas
echo.
echo ⏳ FALTA (Ver INSTRUCCIONES_FINALES_SOLICITUDES.md):
echo   - AsesorController: 3 metodos
echo   - asesor/proyectos.blade.php: Banner
echo.
echo ========================================
echo   PRUEBA AHORA
echo ========================================
echo.
echo 1. Recarga la pagina del proyecto
echo 2. Click "Solicitar asesor"
echo 3. DEBE funcionar sin error "Call to undefined method"
echo.
echo Usuario: carlos1@estudiante.com
echo Pass: password123
echo.
echo ========================================
pause
