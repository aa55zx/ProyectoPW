# Vista de Eventos del Estudiante - EventTec

## 📋 Descripción

Se han creado y actualizado las vistas de eventos para el módulo de estudiante con un diseño moderno y funcional.

## ✅ Archivos Creados/Actualizados

### 1. **Vista de Eventos** (`recursos/views/estudiante/eventos.blade.php`)
- ✅ Lista completa de eventos con tarjetas visuales
- ✅ Barra de búsqueda funcional
- ✅ Filtros por categoría y período
- ✅ Tabs de filtrado (Todos, Activos, Próximos, Finalizados)
- ✅ Toggle de vista (Grid/Lista)
- ✅ Diseño responsive

**Características:**
- Búsqueda en tiempo real por título y descripción
- Filtrado por estado del evento
- Tarjetas con imágenes, badges de estado y categoría
- Información de fecha, equipos y tamaño de equipo
- Botón "Ver detalles" que lleva a la vista detallada

### 2. **Vista de Detalle del Evento** (`recursos/views/estudiante/evento-detalle.blade.php`)
- ✅ Hero image con título y descripción
- ✅ Tabs de navegación (Información, Rúbrica, Equipos, Premios)
- ✅ Sección de requisitos con checkmarks
- ✅ Cronograma visual del evento
- ✅ Sidebar con información rápida
- ✅ Modal de registro de equipo

**Características:**
- Botón "Volver a eventos" funcional
- Tabs interactivos con contenido dinámico
- Sidebar sticky con:
  - Contador de equipos inscritos
  - Tamaño de equipo requerido
  - Premio principal
  - Botones de acción (Registrar, Compartir, Guardar)
- Modal de registro con formulario
- Animaciones y transiciones suaves

### 3. **Modal de Registro de Equipo**
- ✅ Formulario para crear equipo
- ✅ Campos: Nombre del equipo y Descripción (opcional)
- ✅ Validación de formulario
- ✅ Botones Cancelar y Crear equipo
- ✅ Cierre con ESC o clic fuera del modal

## 🛣️ Rutas Configuradas

```php
// Vista de lista de eventos
Route::get('/eventos', ...)->name('estudiante.eventos');

// Vista de detalle de evento
Route::get('/eventos/{id}', ...)->name('estudiante.evento-detalle');

// Endpoint para registrar equipo
Route::post('/registrar-equipo', ...)->name('estudiante.registrar-equipo');
```

## 🎨 Diseño y Estilos

- **Paleta de colores:** Grises con acentos de azul, verde, púrpura
- **Tipografía:** Inter (Google Fonts)
- **Componentes:**
  - Botones con estados hover y active
  - Tarjetas con sombras elevadas al hover
  - Badges de estado con colores distintivos
  - Iconos de Heroicons
  - Transiciones suaves (duration-300)

## 📱 Responsive

Todas las vistas son completamente responsive con breakpoints:
- **Mobile:** 1 columna
- **Tablet (md):** 2 columnas
- **Desktop (lg):** 3 columnas

## 🔧 Funcionalidades JavaScript

### Vista de Eventos:
```javascript
// Filtrado por tabs
document.querySelectorAll('.tab-btn').forEach(...)

// Búsqueda en tiempo real
document.getElementById('searchInput').addEventListener('input', ...)
```

### Vista de Detalle:
```javascript
// Manejo de tabs
document.querySelectorAll('.tab-link').forEach(...)

// Modal functions
function openRegisterModal() { ... }
function closeRegisterModal() { ... }

// Submit del formulario
document.getElementById('teamRegisterForm').addEventListener('submit', ...)
```

## 🚀 Próximos Pasos

Para conectar con la base de datos:

1. **Crear modelo Event:**
```php
php artisan make:model Event -m
```

2. **Crear modelo Team:**
```php
php artisan make:model Team -m
```

3. **Crear controlador:**
```php
php artisan make:controller Estudiante/EventoController
```

4. **Actualizar rutas** para usar el controlador

5. **Migrations necesarias:**
   - `events` table
   - `teams` table
   - `team_members` table
   - `event_registrations` table

## 📦 Dependencias

- **TailwindCSS** (vía CDN)
- **AlpineJS** (vía CDN) - para interactividad
- **Heroicons** (inline SVG)
- **Google Fonts** (Inter)

## ✨ Características Destacadas

1. **Diseño moderno** con gradientes y sombras
2. **Experiencia de usuario fluida** con transiciones
3. **Búsqueda y filtrado** en tiempo real
4. **Modal responsive** para registro de equipos
5. **Navegación por tabs** sin recarga de página
6. **Sticky sidebar** en vista de detalle
7. **Estados visuales claros** (Activo, Próximo, Finalizado)

## 🎯 Estados de Eventos

- **En curso** (badge verde)
- **Próximamente** (badge azul)
- **Finalizado** (badge gris, imagen en escala de grises)

## 📝 Notas

- El formulario de registro actualmente hace un submit simulado
- Los datos de eventos son estáticos (hardcoded)
- Se necesita implementar la lógica del backend para:
  - Listar eventos desde BD
  - Guardar equipos
  - Validar usuarios en equipos
  - Enviar notificaciones

---

**Fecha de creación:** Diciembre 2024  
**Versión:** 1.0.0  
**Desarrollador:** Sistema EventTec
