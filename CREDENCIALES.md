# 🎓 EventTec - Sistema de Gestión de Concursos Académicos

## 📋 Credenciales de Acceso

### 👨‍🎓 ESTUDIANTES (25 disponibles)
```
Email: carlos1@estudiante.com hasta carlos25@estudiante.com
Password: password123

Ejemplos:
- carlos1@estudiante.com / password123
- ana2@estudiante.com / password123
- luis3@estudiante.com / password123
```

### 👨‍🏫 MAESTROS/ASESORES (3 disponibles)
```
Email: juan@maestro.com
Password: password123

Email: roberto@maestro.com
Password: password123

Email: gabriela@maestro.com
Password: password123
```

### ⚖️ JUECES (3 disponibles)
```
Email: maria@juez.com
Password: password123
Nombre: Ing. María García

Email: fernando@juez.com
Password: password123
Nombre: Dr. Fernando Jiménez

Email: patricia@juez.com
Password: password123
Nombre: M.C. Patricia Rodríguez
```

### 👑 ADMINISTRADOR
```
Email: admin@eventec.com
Password: admin123
```

---

## 🚀 Iniciar el Proyecto

### Opción 1: Archivo BAT (Windows)
Haz doble clic en:
- `INICIAR.bat` - Iniciar servidor (general)
- `INICIAR_JUEZ.bat` - Para jueces
- `INICIAR_MAESTRO.bat` - Para maestros
- `INICIAR_ADMIN.bat` - Para administradores

### Opción 2: Comandos manuales
```bash
php artisan serve
```

Luego abre: http://127.0.0.1:8000

---

## 🗄️ Base de Datos

### Reiniciar Base de Datos
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Limpiar Cache
```bash
LIMPIAR_CACHE.bat
```
O manualmente:
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## 📊 Datos Precargados

### Eventos (5 total)
1. **Hackathon de Innovación 2024** (Finalizado)
   - 12 equipos registrados
   - 12 proyectos evaluados
   - Rankings disponibles

2. **Feria de Ciencias 2025** (Abierto)
   - 5 equipos registrados
   - Sin proyectos

3. **Concurso de Robótica 2025** (Abierto)
4. **Startup Weekend 2025** (Próximamente)
5. **IoT Challenge 2025** (Abierto)

### Equipos (17 total)
- 12 en Hackathon de Innovación 2024
- 5 en Feria de Ciencias 2025
- Códigos de invitación: 6 caracteres (ej: 81A625, 28A818)

### Proyectos (12 evaluados)
- EcoTrack (93.8 puntos) - 1er lugar
- SmartHealth (94.8 puntos) - 2do lugar
- Y 10 proyectos más con puntuaciones 70-98

---

## 🎯 Funcionalidades por Rol

### 👨‍🎓 Estudiante
- ✅ Dashboard con estadísticas
- ✅ Ver eventos disponibles
- ✅ Crear y unirse a equipos
- ✅ Crear proyectos
- ✅ Ver rankings y posiciones
- ✅ Filtrar por evento

### 👨‍🏫 Maestro/Asesor
- ✅ Ver eventos
- ✅ Ver equipos asesorados
- ✅ Ver proyectos
- ✅ Ver rankings

### ⚖️ Juez
- ✅ Ver eventos asignados
- ✅ Evaluar proyectos
- ✅ Asignar puntuaciones
- ✅ Ver rankings

### 👑 Administrador
- ✅ Gestión completa de eventos
- ✅ Gestión de equipos
- ✅ Asignación de jueces
- ✅ Ver estadísticas globales

---

## 🔑 Códigos de Invitación de Equipos

Para unirse a un equipo existente, usa estos códigos:

**Hackathon de Innovación 2024:**
- Tech Innovators: Ver en la aplicación
- Code Warriors: Ver en la aplicación
- (12 equipos disponibles)

**Feria de Ciencias 2025:**
- Dev Dragons: Ver en la aplicación
- Script Sages: Ver en la aplicación
- (5 equipos disponibles)

Los códigos se pueden ver dentro de la aplicación en la sección de Equipos.

---

## ⚠️ Problemas Comunes

### Error: Route not found
```bash
php artisan route:clear
php artisan config:clear
```

### Error: Base de datos
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Puerto 8000 ocupado
```bash
php artisan serve --port=8001
```

---

## 📁 Estructura del Proyecto

```
ProyectoPW/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   ├── Estudiante/
│   │   ├── Admin/
│   │   └── Asesor/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── estudiante/
│   ├── admin/
│   ├── asesor/
│   └── juez/
└── routes/
    └── web.php
```

---

## 🛠️ Tecnologías

- Laravel 12.39
- PHP 8.4.0
- SQLite
- Tailwind CSS
- Alpine.js

---

## 📝 Notas

- Las contraseñas son para desarrollo/pruebas
- Los datos son ficticios
- Base de datos en: `database/database.sqlite`

---

## 👨‍💻 Desarrollo

**Programación Web - 7° Semestre**
Instituto Tecnológico de Oaxaca

---

¡Listo para usar! 🚀
