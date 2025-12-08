@echo off
echo ====================================
echo   FILTRO: SOLO EVENTOS PROXIMOS
echo   PARA ESTUDIANTES
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
echo.
echo ✓ Sistema actualizado
echo.
echo ========================================
echo   RESTRICCION IMPLEMENTADA:
echo ========================================
echo.
echo ESTUDIANTES SOLO PUEDEN VER/INSCRIBIRSE:
echo   ✓ Eventos con status = "upcoming"
echo   ✓ Proximos a iniciar
echo   ✓ Inscripciones abiertas
echo.
echo ESTUDIANTES NO PUEDEN VER/INSCRIBIRSE:
echo   ✗ Eventos con status = "open" (En curso)
echo   ✗ Eventos con status = "finished" (Finalizados)
echo   ✗ Eventos ya iniciados
echo.
echo ========================================
echo   CAMBIOS EN EventoController.php:
echo ========================================
echo.
echo Metodo index() - Linea 18:
echo   ANTES:
echo     Event::where('is_published', true)
echo.
echo   AHORA:
echo     Event::where('is_published', true)
echo           -^>where('status', 'upcoming')
echo.
echo   ✓ Filtra automaticamente
echo   ✓ Solo muestra eventos proximos
echo   ✓ Eliminado filtro de status del request
echo.
echo Metodo inscribirEquipo() - Linea 155:
echo   ✓ Valida: status === 'upcoming'
echo   ✓ Mensaje: "Solo puedes inscribirte a eventos proximos"
echo   ✓ Bloquea inscripciones a eventos activos/finalizados
echo.
echo Metodo registrarEquipo() - Linea 253:
echo   ✓ Valida: status === 'upcoming'
echo   ✓ Mensaje: "Solo puedes crear equipos para eventos proximos"
echo   ✓ Bloquea creacion de equipos para eventos activos
echo.
echo Metodo solicitarUnirse() - Linea 331:
echo   ✓ Valida: status === 'upcoming'
echo   ✓ Mensaje: "Solo puedes unirte a equipos de eventos proximos"
echo   ✓ Bloquea solicitudes a eventos activos/finalizados
echo.
echo ========================================
echo   CAMBIOS EN eventos.blade.php:
echo ========================================
echo.
echo ELIMINADO:
echo   ✗ Tabs de filtro por estado
echo   ✗ Contador de eventos activos
echo   ✗ Contador de eventos finalizados
echo   ✗ Opcion "Todos"
echo.
echo AGREGADO:
echo   ✓ Banner informativo azul
echo   ✓ "Solo se muestran eventos proximos"
echo   ✓ Contador dinamico de eventos
echo   ✓ Badge "Proximamente" en cada card
echo   ✓ Diseño minimalista
echo.
echo MANTENIDO:
echo   ✓ Buscador de eventos
echo   ✓ Filtro por categoria
echo   ✓ Grid de eventos
echo   ✓ Info de cada evento
echo.
echo ========================================
echo   FLUJO ACTUALIZADO:
echo ========================================
echo.
echo ESTUDIANTE ENTRA A /estudiante/eventos:
echo   1. Ve SOLO eventos con status = "upcoming"
echo   2. Ve banner: "Solo se muestran eventos proximos"
echo   3. Puede buscar por nombre
echo   4. Puede filtrar por categoria
echo   5. NO ve eventos activos ni finalizados
echo.
echo ESTUDIANTE INTENTA INSCRIBIRSE:
echo   → Click "Ver detalles"
echo   → Si evento es "upcoming": Puede inscribirse
echo   → Si evento es "open/finished": NO aparece (filtrado)
echo.
echo ESTUDIANTE INTENTA ACCESO DIRECTO:
echo   → URL: /estudiante/eventos/evento-activo
echo   → Puede ver detalle (info publica)
echo   → Al intentar inscribir:
echo      ✗ Error: "Solo puedes inscribirte a eventos proximos"
echo      ✗ Bloqueado en el backend
echo.
echo ========================================
echo   VALIDACIONES BACKEND:
echo ========================================
echo.
echo Inscribir equipo:
echo   if ($event-^>status !== 'upcoming') {
echo       return error "Solo eventos proximos";
echo   }
echo.
echo Crear equipo:
echo   if ($evento-^>status !== 'upcoming') {
echo       return error "Solo eventos proximos";
echo   }
echo.
echo Solicitar unirse:
echo   if ($evento-^>status !== 'upcoming') {
echo       return error "Solo eventos proximos";
echo   }
echo.
echo ========================================
echo   MENSAJES DE ERROR:
echo ========================================
echo.
echo Al inscribir equipo a evento activo:
echo   "Solo puedes inscribirte a eventos proximos.
echo    Este evento ya esta en curso o ha finalizado."
echo.
echo Al crear equipo para evento activo:
echo   "Solo puedes crear equipos para eventos proximos.
echo    Este evento ya esta en curso o ha finalizado."
echo.
echo Al solicitar unirse a equipo de evento activo:
echo   "Solo puedes unirte a equipos de eventos proximos.
echo    Este evento ya esta en curso o ha finalizado."
echo.
echo ========================================
echo   ESTADOS DE EVENTOS:
echo ========================================
echo.
echo "upcoming" (Proximamente):
echo   ✓ Visible para estudiantes
echo   ✓ Permite inscripciones
echo   ✓ Permite crear equipos
echo   ✓ Permite solicitar unirse
echo.
echo "open" (En curso):
echo   ✗ NO visible en lista
echo   ✗ NO permite inscripciones
echo   ✗ NO permite crear equipos
echo   ✗ NO permite solicitar unirse
echo   ✓ Accesible si ya estas inscrito
echo.
echo "finished" (Finalizado):
echo   ✗ NO visible en lista
echo   ✗ NO permite inscripciones
echo   ✗ NO permite crear equipos
echo   ✗ NO permite solicitar unirse
echo   ✓ Accesible si ya participaste
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Ve a: /estudiante/eventos
echo 2. DEBE MOSTRAR:
echo    → Banner azul informativo
echo    → Solo eventos "Proximamente"
echo    → Badge negro "Proximamente"
echo    → Sin tabs de estado
echo.
echo 3. Intenta inscribirte a evento proximo:
echo    → Funciona normalmente
echo.
echo 4. Si cambias un evento a "open" en BD:
echo    UPDATE events SET status = 'open' WHERE id = '...';
echo.
echo 5. Recarga /estudiante/eventos:
echo    → Ese evento YA NO aparece
echo.
echo 6. Si intentas acceder directo:
echo    → /estudiante/eventos/{id-evento-open}
echo    → Puedes ver info
echo    → Al inscribir: ERROR
echo    → "Solo puedes inscribirte a eventos proximos"
echo.
echo ========================================
pause
