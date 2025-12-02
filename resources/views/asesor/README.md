# Vistas del Rol Asesor - EventTec

Este documento detalla todas las vistas creadas para el rol de **Asesor** en la aplicación EventTec.

## Estructura de Archivos Creados

```
resources/views/asesor/
├── dashboard.blade.php          # Vista principal con estadísticas
├── eventos.blade.php            # Lista de eventos académicos
├── evento-detalle.blade.php     # Detalle completo de un evento
├── equipos.blade.php            # Gestión de equipos asesorados
├── proyectos.blade.php          # Gestión de proyectos
├── rankings.blade.php           # Clasificaciones y resultados
└── mi-perfil.blade.php          # Perfil del asesor
```

## Descripción de Vistas

### 1. Dashboard (`dashboard.blade.php`)
Vista principal del asesor con:
- 4 cards de estadísticas (Equipos Asesorados, Proyectos Activos, Eventos Activos, Notificaciones)
- Sección "Mis Equipos" con lista de equipos
- Gráfica de actividad de equipos con Chart.js

**Características:**
- Diseño responsivo con Tailwind CSS
- Integración con Chart.js para visualización de datos
- Cards con hover effects

### 2. Eventos (`eventos.blade.php`)
Listado completo de eventos académicos disponibles:
- Barra de búsqueda y filtros (estado, categoría)
- Vista de grid/lista
- Tabs de filtrado (Todos, Activos, Próximos, Finalizados)
- Cards de eventos con imagen, estado, categoría e información básica

**Estados de eventos:**
- En curso (amarillo)
- Próximamente (azul)
- Finalizado (gris)

### 3. Detalle de Evento (`evento-detalle.blade.php`)
Vista detallada de un evento específico:
- Banner con imagen del evento
- Descripción completa y objetivos
- Cronograma detallado con timeline visual
- Requisitos de participación
- Sidebar con información general, premios y contacto
- Breadcrumb de navegación

### 4. Equipos (`equipos.blade.php`)
Gestión de equipos asesorados:
- Buscador y filtro por evento
- Estado vacío con call-to-action
- Lista de equipos en cards (cuando existen)
- Modal para crear nuevo equipo
- Vista de integrantes con avatares

**Funcionalidades:**
- Crear equipo
- Ver detalles del equipo
- Filtrar por evento

### 5. Proyectos (`proyectos.blade.php`)
Vista de proyectos de los equipos:
- Búsqueda y filtros (estado, equipo)
- Tabs de filtrado (Todos, En Progreso, Completados)
- Cards de proyectos con:
  - Información básica
  - Barra de progreso
  - Tags de tecnologías
  - Estado del proyecto
- Modal para crear nuevo proyecto

**Estados de proyectos:**
- En Progreso (verde)
- Pendiente (amarillo)
- Completado (gris)

### 6. Rankings (`rankings.blade.php`)
Clasificaciones y resultados de eventos:
- Selector de evento
- Podio visual de los 3 primeros lugares
- Tabla completa de clasificación
- Información de premios
- Botón para exportar resultados

**Diseño especial:**
- Podio con diseño destacado para el 1er lugar
- Colores distintivos: oro (1°), plata (2°), bronce (3°)
- Tabla con hover effects

### 7. Mi Perfil (`mi-perfil.blade.php`)
Perfil del asesor:
- Grid de dos columnas
- Información personal con avatar
- Estadísticas (Eventos, Proyectos, Equipos, Promedio)
- Sección de logros
- Tabs: Historial, Cuenta, Notificaciones
- Historial de participación con eventos anteriores
- Modal para editar perfil

## Rutas Necesarias

Agregar al archivo `routes/web.php`:

```php
// Rutas para Asesor
Route::middleware(['auth', 'asesor'])->prefix('asesor')->name('asesor.')->group(function () {
    Route::get('/dashboard', [AsesorController::class, 'dashboard'])->name('dashboard');
    Route::get('/eventos', [AsesorController::class, 'eventos'])->name('eventos');
    Route::get('/evento/{id}', [AsesorController::class, 'eventoDetalle'])->name('evento-detalle');
    Route::get('/equipos', [AsesorController::class, 'equipos'])->name('equipos');
    Route::get('/proyectos', [AsesorController::class, 'proyectos'])->name('proyectos');
    Route::get('/rankings', [AsesorController::class, 'rankings'])->name('rankings');
    Route::get('/mi-perfil', [AsesorController::class, 'miPerfil'])->name('mi-perfil');
});
```

## Controlador Necesario

Crear el archivo `app/Http/Controllers/AsesorController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function dashboard()
    {
        return view('asesor.dashboard');
    }

    public function eventos()
    {
        return view('asesor.eventos');
    }

    public function eventoDetalle($id)
    {
        return view('asesor.evento-detalle', compact('id'));
    }

    public function equipos()
    {
        return view('asesor.equipos');
    }

    public function proyectos()
    {
        return view('asesor.proyectos');
    }

    public function rankings()
    {
        return view('asesor.rankings');
    }

    public function miPerfil()
    {
        return view('asesor.mi-perfil');
    }
}
```

## Middleware Necesario

Crear o actualizar el middleware de asesor en `app/Http/Middleware/AsesorMiddleware.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AsesorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAsesor()) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado.');
    }
}
```

## Actualización del Modelo User

Agregar el método al modelo `app/Models/User.php`:

```php
public function isAsesor()
{
    return $this->rol === 'asesor' || $this->role === 'asesor';
}
```

## Layout Dashboard

Las vistas utilizan el layout `layouts.dashboard`. Asegúrate de actualizar la navegación del sidebar para incluir las opciones del asesor:

```php
@if(Auth::user()->isAsesor())
    <!-- Navegación para Asesor -->
    <li>
        <a href="{{ route('asesor.dashboard') }}" class="menu-item">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('asesor.eventos') }}" class="menu-item">
            Eventos
        </a>
    </li>
    <li>
        <a href="{{ route('asesor.equipos') }}" class="menu-item">
            Equipos
        </a>
    </li>
    <li>
        <a href="{{ route('asesor.proyectos') }}" class="menu-item">
            Proyectos
        </a>
    </li>
    <li>
        <a href="{{ route('asesor.rankings') }}" class="menu-item">
            Rankings
        </a>
    </li>
    <li>
        <a href="{{ route('asesor.mi-perfil') }}" class="menu-item">
            Mi Perfil
        </a>
    </li>
@endif
```

## Características Técnicas

### Tecnologías Utilizadas
- **Framework:** Laravel (Blade Templates)
- **CSS:** Tailwind CSS
- **JavaScript:** Vanilla JS
- **Gráficas:** Chart.js

### Funcionalidades Implementadas
- ✅ Diseño responsivo (mobile, tablet, desktop)
- ✅ Modales interactivos
- ✅ Búsqueda y filtros
- ✅ Estados visuales (badges, progress bars)
- ✅ Hover effects y transiciones
- ✅ Integración con Chart.js
- ✅ Cards con imágenes de Unsplash

### Scripts JavaScript Incluidos
- Funciones de apertura/cierre de modales
- Búsqueda en tiempo real
- Funcionalidad de filtros

## Siguiente Pasos para Implementación

1. **Crear el controlador** (`AsesorController.php`)
2. **Registrar las rutas** en `web.php`
3. **Crear/actualizar el middleware** `AsesorMiddleware`
4. **Actualizar el modelo User** con el método `isAsesor()`
5. **Actualizar el layout dashboard** con la navegación del asesor
6. **Registrar el middleware** en `app/Http/Kernel.php`:
   ```php
   protected $routeMiddleware = [
       // ...
       'asesor' => \App\Http\Middleware\AsesorMiddleware::class,
   ];
   ```

## Notas Importantes

- Las vistas utilizan datos de ejemplo (hardcoded). Necesitarás conectar con tu base de datos.
- Las imágenes utilizan URLs de Unsplash como placeholders.
- Los gráficos de Chart.js tienen datos de ejemplo.
- Todos los formularios necesitan agregar la lógica de backend.
- Los enlaces están configurados con las rutas de Laravel.

## Pruebas

Para probar las vistas:

1. Crear un usuario con rol "asesor"
2. Iniciar sesión
3. Navegar a `/asesor/dashboard`

---

**Desarrollado para:** EventTec - Sistema de Gestión de Eventos Académicos
**Rol:** Asesor
**Fecha:** Diciembre 2024
