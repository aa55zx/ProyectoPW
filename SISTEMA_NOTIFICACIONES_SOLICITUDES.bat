@echo off
echo ====================================
echo   SISTEMA DE NOTIFICACIONES
echo   SOLICITUDES DE EQUIPOS
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:clear
echo.
echo ✓ Sistema implementado
echo.
echo ========================================
echo   FUNCIONALIDADES IMPLEMENTADAS:
echo ========================================
echo.
echo 1. BANNER DE NOTIFICACIONES (arriba):
echo    ✓ Se muestra cuando hay solicitudes
echo    ✓ Cuenta total de solicitudes
echo    ✓ Boton "Ver solicitudes"
echo    ✓ Diseno degradado azul-morado
echo.
echo 2. BADGE EN CARDS DE EQUIPOS:
echo    ✓ Muestra numero de solicitudes por equipo
echo    ✓ Solo en equipos donde eres lider
echo    ✓ Badge rojo llamativo
echo.
echo 3. MODAL DE SOLICITUDES RAPIDAS:
echo    ✓ Lista todas las solicitudes pendientes
echo    ✓ Muestra info del usuario (nombre, email, carrera)
echo    ✓ Indica a que equipo quiere unirse
echo    ✓ Botones Aceptar/Rechazar directos
echo    ✓ Scroll si hay muchas solicitudes
echo.
echo 4. VISTA DE DETALLES:
echo    ✓ Mantiene funcionalidad original
echo    ✓ Banner de solicitudes en detalle
echo    ✓ Info completa de cada solicitud
echo.
echo ========================================
echo   FLUJO COMPLETO:
echo ========================================
echo.
echo CUANDO LLEGA UNA SOLICITUD:
echo   1. Estudiante envia solicitud desde evento
echo   2. Lider ve BANNER AZUL arriba
echo   3. Lider ve BADGE ROJO en card del equipo
echo   4. Lider puede:
echo      a) Click "Ver solicitudes" (modal rapido)
echo      b) Aceptar/Rechazar desde modal
echo      c) Entrar a "Ver detalles"
echo      d) Aceptar/Rechazar desde detalle
echo.
echo OPCION 1 - MODAL RAPIDO:
echo   → Click "Ver solicitudes"
echo   → Modal con todas las solicitudes
echo   → Info: nombre, email, carrera, equipo
echo   → Click "Aceptar" o "Rechazar"
echo   → Confirmar
echo   → Recarga pagina
echo   → Usuario agregado o notificado
echo.
echo OPCION 2 - VER DETALLES:
echo   → Click "Ver detalles" en card
echo   → Banner de solicitudes arriba
echo   → Info completa de cada usuario
echo   → Click "Aceptar" o "Rechazar"
echo   → Confirmar
echo   → Recarga pagina
echo   → Usuario agregado o notificado
echo.
echo ========================================
echo   CAMBIOS EN EL CODIGO:
echo ========================================
echo.
echo EquipoController.php - index():
echo   ✓ Contador de solicitudes por equipo
echo   ✓ Lista completa de solicitudes pendientes
echo   ✓ Variables: $solicitudesPendientes, $totalSolicitudes
echo.
echo equipos.blade.php:
echo   ✓ Banner de notificaciones (linea 7-28)
echo   ✓ Badge en cards (linea 68-76)
echo   ✓ Modal de solicitudes (linea 139-228)
echo   ✓ Funciones JS aceptar/rechazar rapidas
echo.
echo equipo-detalle.blade.php:
echo   ✓ Mantiene funcionalidad original
echo   ✓ Banner de solicitudes si es lider
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Abre otro navegador (Chrome/Edge)
echo 2. Inicia sesion con otro estudiante
echo 3. Ve a /estudiante/eventos
echo 4. Entra a un evento
echo 5. Click "Solicitar unirme" en un equipo de Carlos
echo.
echo 6. Vuelve a Carlos (carlos1@estudiante.com)
echo 7. Ve a /estudiante/equipos
echo 8. DEBE VER:
echo    → Banner azul arriba: "Tienes 1 solicitud pendiente"
echo    → Badge rojo en card: "1 solicitud pendiente"
echo    → Boton "Ver solicitudes"
echo.
echo 9. Click "Ver solicitudes"
echo 10. DEBE MOSTRAR:
echo    → Modal con info del usuario
echo    → Nombre, email, carrera
echo    → Equipo al que quiere unirse
echo    → Botones Aceptar/Rechazar
echo.
echo 11. Click "Aceptar"
echo 12. Confirmar
echo 13. DEBE:
echo    → Agregar usuario al equipo
echo    → Notificar al usuario
echo    → Recargar pagina
echo    → Banner desaparece
echo.
echo ========================================
echo   PRUEBA ALTERNATIVA:
echo ========================================
echo.
echo 1. Mismo flujo hasta paso 8
echo 2. En lugar de "Ver solicitudes"
echo 3. Click "Ver detalles" en el equipo
echo 4. DEBE VER:
echo    → Banner azul con solicitudes
echo    → Info completa del usuario
echo    → Botones Aceptar/Rechazar
echo.
echo 5. Click "Aceptar" o "Rechazar"
echo 6. Funciona igual
echo.
echo ========================================
pause
