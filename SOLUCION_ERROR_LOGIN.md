# 🚨 SOLUCIÓN AL ERROR: "could not find driver (Connection: pgsql)"

## ❌ PROBLEMA
Cuando intentas hacer login, recibes este error:
```
Illuminate\Database\QueryException
could not find driver (Connection: pgsql, SQL: select * from "sessions"...)
```

## 💡 CAUSA
Laravel está intentando usar PostgreSQL porque tiene caché guardado con la configuración anterior.

## ✅ SOLUCIÓN (3 PASOS SIMPLES)

### **PASO 1: Ejecuta el script de arreglo** ⚡

Haz doble clic en el archivo:
```
ARREGLAR_TODO.bat
```

Este script hará automáticamente:
- ✅ Eliminar todo el caché
- ✅ Crear base de datos SQLite nueva
- ✅ Crear todas las tablas (incluida la de sesiones)
- ✅ Insertar los datos de prueba
- ✅ Iniciar el servidor

**ESPERA 2-3 MINUTOS** hasta que veas:
```
Laravel development server started: http://127.0.0.1:8000
```

### **PASO 2: Abre el navegador** 🌐

Ve a: `http://127.0.0.1:8000/login`

### **PASO 3: Inicia sesión** 👤

Usa estas credenciales:
```
Email: carlos@estudiante.com
Password: password123
```

---

## 🎯 Si el script `.bat` no funciona

Abre tu terminal (CMD) en la carpeta del proyecto y ejecuta **uno por uno**:

```bash
# 1. Detener servidor PHP si está corriendo
taskkill /F /IM php.exe

# 2. Eliminar base de datos anterior
del database\database.sqlite

# 3. Crear base de datos nueva
type nul > database\database.sqlite

# 4. Limpiar TODA la configuración
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# 5. Crear todas las tablas
php artisan migrate:fresh

# 6. Insertar datos
php artisan db:seed

# 7. Iniciar servidor
php artisan serve
```

---

## 📊 USUARIOS DISPONIBLES

Después de ejecutar el script, tienes estos usuarios:

### 🎓 ESTUDIANTE (para entrar al dashboard de estudiante)
```
Email: carlos@estudiante.com
Password: password123
```

### 👨‍🏫 MAESTRO
```
Email: juan@maestro.com
Password: password123
```

### ⚖️ JUEZ
```
Email: maria@juez.com
Password: password123
```

### 👑 ADMIN
```
Email: admin@eventec.com
Password: admin123
```

---

## ✨ QUÉ INCLUYE LA BASE DE DATOS

- ✅ 17 usuarios (10 estudiantes, 3 maestros, 3 jueces, 1 admin)
- ✅ 4 eventos completos (Hackathon, Feria, Expo, Robótica)
- ✅ 2 equipos con miembros
- ✅ 2 proyectos evaluados
- ✅ Rúbricas de evaluación
- ✅ Notificaciones de prueba
- ✅ Sistema de logros

---

## 🔧 VERIFICAR QUE TODO FUNCIONA

Después de iniciar sesión como estudiante, deberías ver:

✅ Tu nombre en la esquina superior derecha  
✅ Dashboard con estadísticas  
✅ Menú lateral con: Eventos, Equipos, Proyectos  
✅ Notificaciones (campanita)  
✅ Sin errores 500  

---

## ⚠️ SI TODAVÍA HAY ERRORES

### Error: "SQLSTATE[HY000]: General error: 1 no such table: sessions"
```bash
php artisan migrate:fresh --seed
```

### Error: "Class 'User' not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Error: "Base table or view not found"
```bash
# Asegúrate que database.sqlite existe
dir database\database.sqlite

# Si no existe, créalo:
type nul > database\database.sqlite
php artisan migrate:fresh --seed
```

### El servidor no inicia en el puerto 8000
```bash
# Usa otro puerto:
php artisan serve --port=8001

# Luego accede a:
# http://127.0.0.1:8001/login
```

---

## 📝 ARCHIVOS IMPORTANTES CREADOS

✅ `ARREGLAR_TODO.bat` - Script de arreglo automático  
✅ `database/migrations/2024_12_01_000000_create_sessions_table.php`  
✅ `database/migrations/2024_12_01_000001_create_eventtec_tables.php`  
✅ `database/migrations/2024_12_01_000002_create_cache_table.php`  
✅ `database/migrations/2024_12_01_000003_create_jobs_table.php`  
✅ `database/seeders/DatabaseSeeder.php`  

---

## 🎉 DESPUÉS DE INICIAR SESIÓN

Como estudiante (carlos@estudiante.com), podrás:

1. ✅ Ver el **Dashboard** con tus estadísticas
2. ✅ Ver lista de **Eventos** disponibles
3. ✅ Ver detalle de eventos con cronograma
4. ✅ **Crear equipos** para eventos
5. ✅ Ver tus **equipos** y miembros
6. ✅ Ver **notificaciones**
7. ✅ Ver **logros** desbloqueados

---

## 💪 COMANDOS ÚTILES

### Ver datos en la base de datos
```bash
php artisan tinker
>>> \App\Models\User::count()  # Debe mostrar: 17
>>> \App\Models\Event::count() # Debe mostrar: 4
>>> \App\Models\Team::count()  # Debe mostrar: 2
>>> exit
```

### Resetear todo desde cero
```bash
php artisan migrate:fresh --seed
```

### Ver rutas disponibles
```bash
php artisan route:list
```

---

## 🆘 ÚLTIMO RECURSO

Si nada funciona, estos son los comandos en el orden correcto:

```bash
taskkill /F /IM php.exe
del database\database.sqlite
type nul > database\database.sqlite
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan migrate:fresh
php artisan db:seed
php artisan serve
```

Luego accede a: http://127.0.0.1:8000/login  
Usuario: carlos@estudiante.com  
Password: password123

---

**¡Después de ejecutar `ARREGLAR_TODO.bat` todo debería funcionar perfectamente!** 🎉
