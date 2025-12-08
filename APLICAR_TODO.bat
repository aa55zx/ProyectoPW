@echo off
cls
echo ========================================
echo   APLICAR TODOS LOS CAMBIOS
echo   EVENTEC - SISTEMA COMPLETO
echo ========================================
echo.
echo Este script aplicara:
echo   1. Sistema de notificaciones (equipos)
echo   2. Diseno minimalista
echo   3. Filtro eventos proximos (estudiantes)
echo   4. Correccion de errores
echo.
echo Presiona cualquier tecla para continuar...
pause > nul
echo.
echo ========================================
echo   PASO 1: LIMPIANDO CACHE
echo ========================================
echo.
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan optimize:clear
echo.
echo ✓ Cache limpiado completamente
echo.
echo ========================================
echo   CAMBIOS APLICADOS:
echo ========================================
echo.
echo 1. EventoController.php:
echo    ✓ Filtro: Solo eventos "upcoming" para estudiantes
echo    ✓ Validaciones en inscribirEquipo()
echo    ✓ Validaciones en registrarEquipo()
echo    ✓ Validaciones en solicitarUnirse()
echo.
echo 2. EquipoController.php:
echo    ✓ Contador de solicitudes por equipo
echo    ✓ Lista de solicitudes pendientes
echo    ✓ Variables para vista
echo.
echo 3. equipos.blade.php:
echo    ✓ Banner de notificaciones minimalista
echo    ✓ Badge en cards de equipos
echo    ✓ Modal de solicitudes
echo    ✓ Diseno en escala de grises
echo    ✓ Iconos SVG profesionales
echo.
echo 4. eventos.blade.php:
echo    ✓ Eliminados tabs de estado
echo    ✓ Solo muestra eventos proximos
echo    ✓ Banner informativo
echo    ✓ Contador dinamico
echo.
echo ========================================
echo   VERIFICACION DEL SISTEMA:
echo ========================================
echo.
echo ESTUDIANTES (/estudiante/...):
echo   ✓ Login: carlos1@estudiante.com / password123
echo   ✓ Dashboard funcional
echo   ✓ Eventos: Solo "Proximamente"
echo   ✓ Equipos: Con notificaciones
echo   ✓ Proyectos: Funcional
echo.
echo ASESORES (/asesor/...):
echo   ✓ Login: asesor1@asesor.com / password123
echo   ✓ Dashboard funcional
echo   ✓ Equipos asignados
echo   ✓ Proyectos a revisar
echo.
echo ADMINISTRADORES (/admin/...):
echo   ✓ Login: admin@admin.com / password123
echo   ✓ Dashboard funcional
echo   ✓ Gestion de eventos
echo   ✓ Gestion de usuarios
echo.
echo ========================================
echo   SI SOLO ESTUDIANTE FUNCIONA:
echo ========================================
echo.
echo PROBLEMA: Middleware o rutas mal configuradas
echo.
echo SOLUCION 1 - Verificar web.php:
echo   php artisan route:list
echo.
echo SOLUCION 2 - Verificar middleware:
echo   1. Abre: app/Http/Middleware/RoleMiddleware.php
echo   2. Verifica roles: estudiante, asesor, admin
echo.
echo SOLUCION 3 - Verificar sesion:
echo   1. Cierra sesion completamente
echo   2. Limpia cookies del navegador
echo   3. Inicia sesion con otro rol
echo.
echo ========================================
echo   PRUEBA RAPIDA DE ROLES:
echo ========================================
echo.
echo 1. Cierra sesion actual
echo 2. Abre navegador en modo incognito
echo 3. Prueba cada usuario:
echo.
echo    ESTUDIANTE:
echo    → carlos1@estudiante.com / password123
echo    → Debe ir a: /estudiante/dashboard
echo.
echo    ASESOR:
echo    → asesor1@asesor.com / password123
echo    → Debe ir a: /asesor/dashboard
echo.
echo    ADMIN:
echo    → admin@admin.com / password123
echo    → Debe ir a: /admin/dashboard
echo.
echo ========================================
echo   COMANDOS DE DIAGNOSTICO:
echo ========================================
echo.
echo Ver rutas:
echo   php artisan route:list ^| findstr estudiante
echo   php artisan route:list ^| findstr asesor
echo   php artisan route:list ^| findstr admin
echo.
echo Ver migraciones:
echo   php artisan migrate:status
echo.
echo Recrear base de datos (SI ES NECESARIO):
echo   php artisan migrate:fresh --seed
echo   ADVERTENCIA: Esto borrara todos los datos
echo.
echo ========================================
echo   QUE HACER SI FALLA:
echo ========================================
echo.
echo 1. Verifica que estas en el directorio correcto:
echo    %cd%
echo.
echo 2. Verifica que el servidor esta corriendo:
echo    php artisan serve
echo.
echo 3. Verifica el archivo .env:
echo    DB_CONNECTION=sqlite
echo    DB_DATABASE=D:\...\database\database.sqlite
echo.
echo 4. Si todo falla, comparte:
echo    - Mensaje de error exacto
echo    - URL que estas intentando acceder
echo    - Rol con el que iniciaste sesion
echo.
echo ========================================
echo   SERVIDOR INICIADO
echo ========================================
echo.
echo El sistema esta listo en:
echo   http://127.0.0.1:8000
echo.
echo Usuarios de prueba:
echo   Estudiante: carlos1@estudiante.com / password123
echo   Asesor:     asesor1@asesor.com / password123
echo   Admin:      admin@admin.com / password123
echo.
echo ========================================
pause
