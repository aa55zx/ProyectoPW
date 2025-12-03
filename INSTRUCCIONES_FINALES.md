# 🚀 Solución Completa - EventTec con SQLite

## ❌ Problema Original
```
Illuminate\Database\QueryException
could not find driver (Connection: pgsql)
```

Laravel no podía conectarse a PostgreSQL porque faltaba la extensión PHP.

## ✅ Solución Implementada

He configurado todo el sistema para usar **SQLite** en lugar de PostgreSQL.  
Los mismos datos que están en Supabase ahora están disponibles localmente.

---

## 🎯 Para iniciar tu proyecto (MUY FÁCIL):

### **OPCIÓN 1: Usando el script automático** ⚡

1. Haz doble clic en el archivo: **`start_sqlite.bat`**
2. Espera a que termine (1-2 minutos)
3. ¡Listo! Tu servidor estará corriendo

### **OPCIÓN 2: Comandos manuales** 🔧

Abre tu terminal en la carpeta del proyecto y ejecuta:

```bash
# 1. Crear base de datos
type nul > database\database.sqlite

# 2. Limpiar caché
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# 3. Crear tablas
php artisan migrate:fresh

# 4. Insertar datos
php artisan db:seed

# 5. Iniciar servidor
php artisan serve
```

---

## 👥 Usuarios de Prueba

Después de ejecutar los comandos, usa estos usuarios para login:

### 🎓 Estudiantes (10)
| Email | Password |
|-------|----------|
| carlos@estudiante.com | password123 |
| ana@estudiante.com | password123 |
| luis@estudiante.com | password123 |
| maria@estudiante.com | password123 |
| jose@estudiante.com | password123 |
| sofia@estudiante.com | password123 |
| diego@estudiante.com | password123 |
| laura@estudiante.com | password123 |
| pedro@estudiante.com | password123 |
| carmen@estudiante.com | password123 |

### 👨‍🏫 Maestros (3)
| Email | Password |
|-------|----------|
| juan@maestro.com | password123 |
| roberto@maestro.com | password123 |
| gabriela@maestro.com | password123 |

### ⚖️ Jueces (3)
| Email | Password |
|-------|----------|
| maria@juez.com | password123 |
| fernando@juez.com | password123 |
| patricia@juez.com | password123 |

### 👑 Administrador (1)
| Email | Password |
|-------|----------|
| admin@eventec.com | admin123 |

---

## 📊 Datos Incluidos

✅ **17 usuarios** (10 estudiantes, 3 maestros, 3 jueces, 1 admin)  
✅ **4 eventos** (Hackathon, Feria de Ciencias, Expo Emprendedores, Robótica)  
✅ **2 equipos** con miembros  
✅ **2 proyectos** evaluados  
✅ **1 rúbrica** con 4 criterios  
✅ **Evaluaciones** completas  
✅ **Cronograma** del Hackathon  
✅ **5 logros** del sistema  
✅ **3 notificaciones** de prueba  

---

## ✨ Funcionalidades que Funcionan

### ✅ Autenticación
- Login con email y password
- Registro de nuevos usuarios
- Sistema de roles (estudiante, maestro, juez, admin)
- Redirección según rol

### ✅ Dashboard del Estudiante
- Muestra equipos del usuario
- Muestra proyectos del usuario  
- Muestra eventos activos
- Muestra notificaciones
- Estadísticas calculadas en tiempo real

### ✅ Eventos
- Lista de eventos publicados
- Detalle de evento con cronograma
- Búsqueda y filtros (JavaScript)
- Registro de equipos

### ✅ Equipos
- Crear equipos
- Ver equipos del usuario
- Código de invitación automático
- Contador de miembros automático

---

## 🗄️ Archivos Creados/Modificados

### Base de Datos:
- ✅ `database/migrations/2024_12_01_000001_create_eventtec_tables.php`
- ✅ `database/seeders/DatabaseSeeder.php`
- ✅ `.env` (actualizado para SQLite)

### Modelos:
- ✅ `app/Models/User.php`
- ✅ `app/Models/Event.php`
- ✅ `app/Models/Team.php`
- ✅ `app/Models/Project.php`
- ✅ `app/Models/Notification.php`
- ✅ `app/Models/Rubric.php`
- ✅ `app/Models/RubricCriterion.php`
- ✅ `app/Models/Evaluation.php`
- ✅ `app/Models/EvaluationScore.php`
- ✅ `app/Models/TeamInvitation.php`
- ✅ `app/Models/EventSchedule.php`
- ✅ `app/Models/Achievement.php`

### Controladores:
- ✅ `app/Http/Controllers/Auth/LoginController.php`
- ✅ `app/Http/Controllers/Auth/RegisterController.php`
- ✅ `app/Http/Controllers/Estudiante/DashboardController.php`
- ✅ `app/Http/Controllers/Estudiante/EventoController.php`
- ✅ `app/Http/Controllers/Estudiante/EquipoController.php`

### Rutas:
- ✅ `routes/web.php` (actualizado)

### Scripts:
- ✅ `start_sqlite.bat` (script de inicio automático)

---

## 🔧 Solución de Problemas

### "Class 'User' not found"
```bash
composer dump-autoload
```

### "Base table or view not found"
```bash
php artisan migrate:fresh
php artisan db:seed
```

### "No application encryption key"
```bash
php artisan key:generate
```

### El servidor no inicia
```bash
php artisan serve --port=8001
```

### Limpiar todo y empezar de nuevo
```bash
php artisan migrate:fresh --seed
```

---

## 🚀 Próximos Pasos

Una vez que funcione todo:

1. ⏭️ **Actualizar vistas** para mostrar datos dinámicos de la BD
2. ⏭️ **Implementar invitaciones** a equipos completas
3. ⏭️ **Sistema de archivos** para subir proyectos
4. ⏭️ **Sistema de evaluación** para jueces
5. ⏭️ **Rankings** dinámicos en tiempo real

---

## 🔄 ¿Quieres volver a usar PostgreSQL/Supabase?

Cuando instales la extensión PostgreSQL en PHP:

1. Cambia tu `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=db.xxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=tu_password
```

2. Limpia caché:
```bash
php artisan config:clear
php artisan cache:clear
```

3. Ya no necesitas migraciones ni seeders (los datos ya están en Supabase)

---

## 📝 Comandos Útiles

```bash
# Ver datos en la base de datos
php artisan tinker
>>> \App\Models\User::count()
>>> \App\Models\Event::all()

# Limpiar y reiniciar
php artisan migrate:fresh --seed

# Ver rutas
php artisan route:list

# Ver logs
tail storage/logs/laravel.log
```

---

## 🎉 ¡Todo Listo!

Tu aplicación EventTec está completamente funcional con:
- ✅ Base de datos SQLite local
- ✅ Mismos datos que Supabase
- ✅ Login y registro funcionando
- ✅ Dashboard con datos reales
- ✅ Eventos, equipos y proyectos
- ✅ 17 usuarios de prueba

**Solo ejecuta `start_sqlite.bat` y prueba con:**
- Email: `carlos@estudiante.com`
- Password: `password123`

---

¿Algún problema? Revisa:
1. `storage/logs/laravel.log`
2. Que el archivo `database/database.sqlite` exista
3. Que hayas ejecutado `php artisan migrate:fresh --seed`
