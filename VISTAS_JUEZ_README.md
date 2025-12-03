# Vistas del Juez - EvenTec

## 📋 Descripción

Se han creado todas las vistas necesarias para el módulo de Juez en la plataforma EvenTec, siguiendo el diseño proporcionado con colores morados/azules y el estilo moderno de la aplicación.

## 🎨 Diseño y Paleta de Colores

El diseño sigue la paleta de colores de la imagen proporcionada:
- **Sidebar:** Negro/Gris oscuro (#111827)
- **Primario:** Índigo/Morado (#4f46e5, #6366f1)
- **Secundario:** Azul, Verde, Púrpura
- **Acentos:** Amarillo (primer lugar), Gris (segundo), Naranja (tercero)
- **Fondo:** Gris claro (#f9fafb)

## 📁 Archivos Creados

### 1. Layout Principal
**Archivo:** `resources/views/layouts/juez.blade.php`
- Sidebar negro con navegación
- Header con búsqueda y notificaciones
- Logo "EvenTec"
- Secciones: Dashboard, Eventos, Evaluaciones, Rankings, Mi Perfil

### 2. Dashboard
**Archivo:** `resources/views/juez/dashboard.blade.php`
**Ruta:** `/juez/dashboard`

**Características:**
- Saludo personalizado: "¡Hola, Dr.!"
- 4 tarjetas de métricas:
  - Pendientes de Evaluar (1)
  - Evaluaciones Completadas (1)
  - Eventos Asignados (4)
  - Promedio Otorgado (85.2%)
- Sección "Proyectos por Evaluar" con lista de proyectos
- Gráfico de "Promedios por Criterio" con Chart.js
  - Innovación: 85%
  - Viabilidad: 90%
  - Presentación: 80%
  - Impacto: 95%

### 3. Eventos
**Archivo:** `resources/views/juez/eventos.blade.php`
**Ruta:** `/juez/eventos`

**Características:**
- Filtros por nombre y estado
- Grid de tarjetas de eventos (3 columnas en desktop)
- Cada evento muestra:
  - Imagen de portada
  - Estado (En curso, Próximamente, Finalizado)
  - Fechas
  - Número de equipos
  - Progreso de evaluación con barra
  - Botón de acción según estado
- 4 eventos de ejemplo

### 4. Evaluaciones
**Archivo:** `resources/views/juez/evaluaciones.blade.php`
**Ruta:** `/juez/evaluaciones`

**Características:**
- 3 tarjetas de estadísticas con gradientes:
  - Pendientes (azul índigo)
  - Completadas (verde)
  - Promedio (púrpura)
- Tabs para filtrar: Pendientes, Completadas, Todas
- Lista de evaluaciones con detalles:
  - Nombre del proyecto
  - Equipo
  - Evento
  - Estado (badges de colores)
  - Calificaciones por criterio
  - Fecha de evaluación

### 5. Evaluar Proyecto
**Archivo:** `resources/views/juez/evaluar-proyecto.blade.php`
**Ruta:** `/juez/evaluaciones/{id}`

**Características:**
- Información completa del proyecto
- Descripción detallada
- Enlaces a documentación y demo
- Formulario de evaluación con 4 criterios:
  - Innovación (slider 0-100)
  - Viabilidad (slider 0-100)
  - Presentación (slider 0-100)
  - Impacto (slider 0-100)
- Valores en tiempo real
- Área de comentarios
- Cálculo automático de calificación total
- Tarjeta de resumen con gradiente

### 6. Rankings
**Archivo:** `resources/views/juez/rankings.blade.php`
**Ruta:** `/juez/rankings`

**Características:**
- Filtros por evento y categoría
- Podio top 3 con medallas:
  - 🥇 Primer lugar (amarillo)
  - 🥈 Segundo lugar (gris/plata)
  - 🥉 Tercer lugar (naranja/bronce)
- Tabla completa de clasificación
- Columnas: Posición, Proyecto, Equipo, 4 criterios, Total
- Colores distintivos por posición
- Badges de colores para calificaciones

### 7. Mi Perfil
**Archivo:** `resources/views/juez/perfil.blade.php`
**Ruta:** `/juez/perfil`

**Características:**
- Layout de 2 columnas
- Columna izquierda:
  - Foto de perfil (avatar)
  - Información básica
  - Estadísticas (3 tarjetas con iconos)
- Columna derecha:
  - Información personal
  - Formulario de cambio de contraseña
  - Preferencias con switches:
    - Notificaciones por email
    - Recordatorios de evaluaciones
    - Resumen semanal

## 🛣️ Rutas Configuradas

```php
Route::prefix('juez')->name('juez.')->group(function () {
    Route::get('/dashboard', ...)->name('dashboard');
    Route::get('/eventos', ...)->name('eventos');
    Route::get('/evaluaciones', ...)->name('evaluaciones');
    Route::get('/evaluaciones/{id}', ...)->name('evaluar-proyecto');
    Route::post('/evaluaciones/{id}', ...)->name('guardar-evaluacion');
    Route::get('/rankings', ...)->name('rankings');
    Route::get('/perfil', ...)->name('perfil');
});
```

## 🎯 Características Técnicas

### Tecnologías Utilizadas
- **Laravel Blade:** Motor de plantillas
- **TailwindCSS:** Framework CSS
- **Chart.js:** Gráficos de barras
- **Alpine.js:** Interactividad ligera
- **Google Fonts:** Fuente Inter

### Componentes Interactivos
- Sliders para calificaciones con actualización en tiempo real
- Switches de preferencias (toggles)
- Tabs para filtrar evaluaciones
- Filtros de búsqueda
- Barras de progreso animadas
- Hover effects en tarjetas

### Diseño Responsive
- Grid adaptable (1, 2, 3, 4 columnas según dispositivo)
- Sidebar responsivo
- Tablas con scroll horizontal en móvil
- Imágenes optimizadas

## 🎨 Elementos de Diseño

### Tarjetas
- Bordes redondeados (rounded-2xl)
- Sombras sutiles (shadow-sm)
- Hover effects (shadow-lg)
- Border gris claro

### Colores de Estado
- **Pendiente:** Amarillo (bg-yellow-100, text-yellow-700)
- **Completada:** Verde (bg-green-100, text-green-700)
- **En curso:** Verde (bg-green-500)
- **Próximamente:** Azul (bg-blue-600)
- **Finalizado:** Gris (bg-gray-600)

### Iconos
- SVG inline de Heroicons
- Consistentes en toda la aplicación
- Tamaños estandarizados (w-4 h-4, w-5 h-5, w-8 h-8)

## 📊 Datos de Ejemplo

Las vistas incluyen datos de ejemplo para:
- 4 eventos (Hackathon, Feria de Ciencias, Expo Emprendedores, Robótica)
- 3 evaluaciones (1 pendiente, 2 completadas)
- 5 proyectos en rankings
- Estadísticas realistas

## 🚀 Próximos Pasos

Para implementar completamente el sistema:

1. **Backend:**
   - Crear modelos (Evento, Proyecto, Evaluacion)
   - Controladores con lógica de negocio
   - Migraciones de base de datos
   - Seeders con datos de prueba

2. **Funcionalidades:**
   - Sistema de autenticación por roles
   - Guardado real de evaluaciones
   - Cálculo automático de rankings
   - Notificaciones en tiempo real
   - Upload de documentos

3. **Optimizaciones:**
   - Paginación en listas
   - Caché de consultas
   - Lazy loading de imágenes
   - API REST para AJAX

## 📝 Notas Importantes

- Las vistas están completamente funcionales en el frontend
- Los formularios tienen los atributos correctos (name, method)
- Las rutas están configuradas en `routes/web.php`
- El layout es consistente con el diseño de estudiante
- Los colores coinciden con la imagen proporcionada
- El código es limpio y bien estructurado

## 🎓 Créditos

Diseño basado en la imagen proporcionada del sistema EvenTec.
Desarrollado siguiendo las mejores prácticas de Laravel y TailwindCSS.

---

**Fecha de creación:** Diciembre 2024
**Versión:** 1.0
