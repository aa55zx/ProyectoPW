@echo off
echo ====================================
echo   REDISENO MINIMALISTA
echo   SISTEMA DE NOTIFICACIONES
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
echo.
echo ✓ Rediseno aplicado
echo.
echo ========================================
echo   CAMBIOS DE DISENO:
echo ========================================
echo.
echo PALETA DE COLORES:
echo   ✓ Fondo: Blanco (#FFFFFF)
echo   ✓ Primario: Gris oscuro (#111827 / gray-900)
echo   ✓ Secundario: Gris (#6B7280 / gray-500)
echo   ✓ Bordes: Gris claro (#E5E7EB / gray-200)
echo   ✓ Texto: Gris oscuro (#111827 / gray-900)
echo   ✓ Sin degradados de colores
echo.
echo ICONOGRAFIA SVG:
echo   ✓ Notificacion (campana)
echo   ✓ Grupos de personas (equipos)
echo   ✓ Usuario (perfil)
echo   ✓ Calendario (eventos)
echo   ✓ Email (contacto)
echo   ✓ Libro (educacion)
echo   ✓ Reloj (tiempo)
echo   ✓ Check (confirmacion)
echo   ✓ X (cancelar)
echo   ✓ Ojo (ver)
echo.
echo ========================================
echo   COMPONENTES REDISEÑADOS:
echo ========================================
echo.
echo 1. BANNER DE NOTIFICACIONES:
echo    ANTES: Degradado azul-morado
echo    AHORA: Blanco con borde gris
echo    ✓ Icono SVG de campana
echo    ✓ Texto en gris oscuro
echo    ✓ Boton negro minimalista
echo.
echo 2. BADGE DE SOLICITUDES:
echo    ANTES: Degradado rojo-rosa
echo    AHORA: Negro solido
echo    ✓ Icono SVG de notificacion
echo    ✓ Texto blanco
echo    ✓ Sin gradientes
echo.
echo 3. CARDS DE EQUIPOS:
echo    ANTES: Avatares con degradado
echo    AHORA: Iconos SVG en fondo gris claro
echo    ✓ Icono de grupo de personas
echo    ✓ Bordes grises sutiles
echo    ✓ Hover suave
echo    ✓ Informacion con iconos SVG
echo.
echo 4. MODAL DE SOLICITUDES:
echo    ANTES: Header con degradado
echo    AHORA: Header blanco limpio
echo    ✓ Fondo gris claro (gray-50)
echo    ✓ Cards blancos con sombra suave
echo    ✓ Avatar SVG circular
echo    ✓ Botones: Negro y blanco con borde
echo.
echo 5. MODAL CREAR EQUIPO:
echo    ✓ Diseño minimalista
echo    ✓ Inputs con borde gris
echo    ✓ Focus ring negro
echo    ✓ Botones negro y blanco
echo.
echo ========================================
echo   ICONOS SVG UTILIZADOS:
echo ========================================
echo.
echo Notificaciones:
echo   ^<svg^>
echo     ^<path d="M15 17h5l-1.405-1.405..."^>
echo   ^</svg^>
echo.
echo Grupo de personas:
echo   ^<svg^>
echo     ^<path d="M17 20h5v-2a3 3 0..."^>
echo   ^</svg^>
echo.
echo Usuario:
echo   ^<svg^>
echo     ^<path d="M16 7a4 4 0 11-8 0..."^>
echo   ^</svg^>
echo.
echo Calendario:
echo   ^<svg^>
echo     ^<path d="M8 7V3m8 4V3m-9 8h10..."^>
echo   ^</svg^>
echo.
echo Email:
echo   ^<svg^>
echo     ^<path d="M3 8l7.89 5.26a2..."^>
echo   ^</svg^>
echo.
echo Educacion:
echo   ^<svg^>
echo     ^<path d="M12 6.253v13m0-13C10.832..."^>
echo   ^</svg^>
echo.
echo Check:
echo   ^<svg^>
echo     ^<path d="M5 13l4 4L19 7"^>
echo   ^</svg^>
echo.
echo ========================================
echo   PALETA COMPLETA:
echo ========================================
echo.
echo Grises:
echo   gray-50:  #F9FAFB (fondos suaves)
echo   gray-100: #F3F4F6 (avatares, badges)
echo   gray-200: #E5E7EB (bordes)
echo   gray-300: #D1D5DB (bordes hover)
echo   gray-400: #9CA3AF (iconos)
echo   gray-500: #6B7280 (texto secundario)
echo   gray-600: #4B5563 (texto)
echo   gray-700: #374151 (texto importante)
echo   gray-800: #1F2937 (hover)
echo   gray-900: #111827 (primario, botones)
echo.
echo Blanco:
echo   white: #FFFFFF (fondos, modales)
echo.
echo ========================================
echo   MEJORAS DE UX:
echo ========================================
echo.
echo ✓ Backdrop blur en modales
echo ✓ Transiciones suaves
echo ✓ Hover states claros
echo ✓ Focus states accesibles
echo ✓ Sombras sutiles
echo ✓ Bordes definidos
echo ✓ Espaciado consistente
echo ✓ Tipografia clara
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Ve a: /estudiante/equipos
echo 2. DEBE VER:
echo    → Diseno limpio y minimalista
echo    → Banner blanco con icono SVG
echo    → Cards con iconos en lugar de avatares
echo    → Sin degradados de colores
echo    → Todo en escala de grises
echo.
echo 3. Click "Ver solicitudes"
echo 4. DEBE VER:
echo    → Modal con fondo gris claro
echo    → Cards blancos
echo    → Avatares SVG circulares
echo    → Botones negro y blanco
echo.
echo ========================================
pause
