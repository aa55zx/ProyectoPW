# Dashboard Estudiante - EventTec

## 📋 Descripción
Dashboard moderno y funcional para estudiantes del sistema EventTec, diseñado con una interfaz limpia y profesional siguiendo los mockups proporcionados.

## 🎨 Características Implementadas

### 1. **Layout Principal** (`layouts/estudiante.blade.php`)
- ✅ Sidebar fijo con navegación
- ✅ Logo y branding de EventTec
- ✅ Menú de navegación completo:
  - Dashboard
  - Eventos
  - Equipos
  - Proyectos
  - Rankings
  - Mi Perfil
- ✅ Header con barra de búsqueda
- ✅ Notificaciones con badge
- ✅ Avatar del usuario
- ✅ Botón de cerrar sesión
- ✅ Diseño responsivo

### 2. **Dashboard** (`estudiante/dashboard.blade.php`)
- ✅ Mensaje de bienvenida personalizado
- ✅ 4 Tarjetas de estadísticas:
  - Eventos Participados (con porcentaje de cambio)
  - Proyectos Enviados
  - Promedio General
  - Equipos
- ✅ Sección "Eventos Activos" con evento destacado:
  - Imagen del evento
  - Tags de estado (En curso, Tecnología)
  - Descripción completa
  - Información del evento (fecha, equipos, integrantes)
  - Botón "Ver detalles"
- ✅ Sección "Próximos Eventos" con 2 eventos:
  - Cards con imágenes
  - Tags de categoría
  - Información detallada
  - Botones de acción
- ✅ Panel lateral con:
  - **Notificaciones** (3 notificaciones con badge)
  - **Mis Logros** con badges y progreso

## 🎯 Funcionalidades

### Navegación
- Sidebar completamente funcional
- Rutas configuradas en `routes/web.php`
- Sistema de autenticación integrado
- Redirección automática según rol de usuario

### Diseño
- **Framework**: Tailwind CSS
- **Iconos**: Heroicons (SVG)
- **Imágenes**: Unsplash para eventos de ejemplo
- **Colores**: Paleta profesional con grises, azules, verdes, púrpuras
- **Responsive**: Adaptable a móviles, tablets y escritorio

## 📁 Estructura de Archivos Modificados

```
resources/views/
├── layouts/
│   └── estudiante.blade.php          (NUEVO - Layout base)
└── estudiante/
    └── dashboard.blade.php            (ACTUALIZADO - Vista principal)

routes/
└── web.php                            (Ya existente - Sin cambios necesarios)

app/Http/Controllers/Auth/
└── LoginController.php                (Ya existente - Redirección configurada)
```

## 🚀 Cómo Probar

1. **Iniciar el servidor Laravel**:
   ```bash
   php artisan serve
   ```

2. **Acceder al sistema**:
   - URL: `http://localhost:8000`
   - Se redirigirá automáticamente al login

3. **Login como estudiante**:
   - Usar credenciales de un usuario con `user_type = 'estudiante'`
   - Después del login exitoso, verás el dashboard

## 📊 Elementos del Dashboard

### Estadísticas (Cards Superiores)
- **Eventos Participados**: 8 eventos (+12% vs mes anterior)
- **Proyectos Enviados**: 6 proyectos
- **Promedio General**: 87.5%
- **Equipos**: 4 equipos activos

### Evento Destacado
- **Hackathon de Innovación 2024**
- Estado: En curso
- Categoría: Tecnología
- Fecha: 14 de abril
- 24 equipos participantes
- 3-5 integrantes por equipo

### Próximos Eventos
1. **Feria de Ciencias 2024**
   - Categoría: Ciencias
   - 19 de mayo
   - 18 equipos

2. **Expo Emprendedores**
   - Categoría: Negocios
   - 9 de junio
   - 45 equipos

### Notificaciones
1. Nuevo evento disponible (activa)
2. Invitación a equipo (activa)
3. Evaluación completada

### Logros
- 🏆 Primer Lugar
- ⭐ Participante Activo
- 🎯 Progreso de eventos: 6/10
- 🔥 Racha: 15 días
- 👥 4 equipos formados

## 🎨 Paleta de Colores

- **Primario**: Gray-900 (#111827)
- **Secundario**: Blue-600 (#2563eb)
- **Éxito**: Green-600 (#16a34a)
- **Advertencia**: Yellow-500 (#eab308)
- **Peligro**: Red-600 (#dc2626)
- **Info**: Purple-600 (#9333ea)
- **Fondo**: Gray-50 (#f9fafb)

## 🔧 Mejoras Futuras Sugeridas

1. **Interactividad**:
   - Añadir Alpine.js para modales
   - Implementar dropdown en notificaciones
   - Menú de usuario con más opciones

2. **Funcionalidad**:
   - Conectar con base de datos real
   - Sistema de filtros para eventos
   - Búsqueda en tiempo real
   - Paginación en eventos

3. **Diseño**:
   - Animaciones de transición
   - Skeleton loaders
   - Estados de carga
   - Modo oscuro

## 📱 Responsividad

El dashboard está optimizado para:
- **Móvil**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

El sidebar se puede convertir en un menú hamburguesa para móviles (requiere Alpine.js o JavaScript adicional).

## ⚡ Notas Técnicas

- **Blade Templates**: Sistema de plantillas de Laravel
- **@extends**: Herencia de layouts
- **@section/@yield**: Inyección de contenido
- **Auth**: Sistema de autenticación de Laravel
- **Tailwind CSS CDN**: Cargado desde CDN (para producción, compilar assets)

## 🎓 Créditos

Dashboard diseñado basado en los mockups proporcionados, implementado con las mejores prácticas de Laravel y Tailwind CSS.
