# ✅ CONFIGURACIÓN COMPLETA - Laravel + Supabase

## 🎯 TU PROYECTO YA ESTÁ CONFIGURADO

He configurado tu proyecto Laravel para conectarse a tu base de datos Supabase:

```
✅ Host: db.gkjvxrrmnlysmiwtfztp.supabase.co
✅ Database: postgres
✅ Username: postgres
✅ Password: cheluis123.
```

---

## 🚀 CÓMO INICIAR (2 PASOS)

### **PASO 1: Habilitar PostgreSQL en PHP** ⚙️

#### Si usas XAMPP:
1. Ve a: `C:\xampp\php\php.ini`
2. Abre con Notepad++, Sublime Text o cualquier editor
3. Busca (Ctrl+F): `;extension=pdo_pgsql`
4. Elimina el `;` al inicio para que quede: `extension=pdo_pgsql`
5. Busca: `;extension=pgsql`
6. Elimina el `;` para que quede: `extension=pgsql`
7. **Guarda el archivo**
8. **Abre XAMPP Control Panel**
9. **STOP Apache**
10. **START Apache** de nuevo

#### Si usas Laragon:
1. Click derecho en el icono de Laragon
2. Menu → PHP → Quick settings
3. Marca: `☑ pdo_pgsql`
4. Marca: `☑ pgsql`
5. Reinicia Laragon

#### Verificar que funciona:
Abre CMD y ejecuta:
```bash
php -m | findstr pgsql
```

Debes ver:
```
pdo_pgsql
pgsql
```

---

### **PASO 2: Ejecutar el script de conexión** ⚡

Haz doble clic en:
```
CONECTAR_SUPABASE.bat
```

Este script:
1. ✅ Verificará que PostgreSQL esté habilitado
2. ✅ Limpiará todo el caché de Laravel
3. ✅ Probará la conexión a Supabase
4. ✅ Verificará que hay usuarios en la BD
5. ✅ Iniciará el servidor

**Espera hasta ver:**
```
Laravel development server started: http://127.0.0.1:8000
```

---

## 👤 INICIAR SESIÓN

### Abre tu navegador en:
```
http://127.0.0.1:8000/login
```

### Usa los usuarios que creaste en Supabase:

**Si ejecutaste el script SQL que te proporcioné, estos usuarios están disponibles:**

#### Estudiantes:
```
Email: carlos@estudiante.com
Password: password123
```

```
Email: ana@estudiante.com
Password: password123
```

#### Maestros:
```
Email: juan@maestro.com
Password: password123
```

#### Jueces:
```
Email: maria@juez.com
Password: password123
```

#### Admin:
```
Email: admin@eventec.com
Password: admin123
```

---

## 🔍 VERIFICAR QUÉ USUARIOS TIENES EN SUPABASE

1. Ve a: https://supabase.com
2. Abre tu proyecto
3. Click en **Table Editor** (icono de tabla 📊)
4. Selecciona la tabla: **users**
5. Verás todos los usuarios con sus emails

**Usa el email de cualquier usuario que veas ahí.**

---

## ⚠️ SI EL LOGIN NO FUNCIONA

### Problema: "Las credenciales son incorrectas"

**Causa:** Las contraseñas en Supabase deben estar hasheadas con bcrypt.

**Solución:** En Supabase, ve al SQL Editor y ejecuta:

```sql
-- Para actualizar el password de un usuario específico
UPDATE users 
SET password_hash = crypt('password123', gen_salt('bf'))
WHERE email = 'carlos@estudiante.com';

-- Para actualizar todos los estudiantes con el mismo password
UPDATE users 
SET password_hash = crypt('password123', gen_salt('bf'))
WHERE user_type = 'estudiante';

-- Para ver si un usuario tiene contraseña
SELECT email, password_hash FROM users WHERE email = 'carlos@estudiante.com';
```

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### Error: "could not find driver"
```
❌ PostgreSQL no está habilitado en PHP
✅ Solución: Ve al PASO 1 y habilita las extensiones
✅ Reinicia Apache/Laragon después de editar php.ini
```

### Error: "Connection refused" o timeout
```
❌ No se puede conectar a Supabase
✅ Verifica tu conexión a internet
✅ Verifica que el .env tenga los datos correctos
✅ Ejecuta: php artisan config:clear
```

### Error: "FATAL: password authentication failed"
```
❌ Password incorrecto
✅ Verifica que el password en .env sea: cheluis123.
✅ Incluye el punto al final
```

### Error: "Base table or view not found: users"
```
❌ Las tablas no existen en Supabase
✅ Ve a Supabase SQL Editor
✅ Ejecuta el script SQL completo que te proporcioné
```

### El login dice "No existe cuenta con este email"
```
❌ El usuario no existe en Supabase
✅ Ve a Supabase → Table Editor → users
✅ Verifica qué emails existen
✅ O crea un usuario nuevo con el script SQL
```

---

## 📝 ARCHIVOS CONFIGURADOS

✅ `.env` - Actualizado con datos de Supabase  
✅ `app/Models/User.php` - Configurado para `password_hash`  
✅ `app/Http/Controllers/Auth/LoginController.php` - Con logs y validaciones  
✅ `CONECTAR_SUPABASE.bat` - Script de inicio automático  

---

## 🎯 COMANDOS ÚTILES

### Limpiar todo el caché:
```bash
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
```

### Probar conexión a Supabase:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
>>> \App\Models\User::count();
>>> exit
```

### Ver usuarios disponibles:
```bash
php artisan tinker
>>> \App\Models\User::select('email', 'name', 'user_type')->get();
>>> exit
```

### Iniciar servidor manualmente:
```bash
php artisan serve
```

---

## ✨ DESPUÉS DE INICIAR SESIÓN

Como **estudiante**, verás:

✅ Dashboard con estadísticas  
✅ Lista de eventos disponibles  
✅ Tus equipos y proyectos  
✅ Notificaciones  
✅ Menú lateral con todas las opciones  

---

## 🔄 SI QUIERES VOLVER A SQLITE

Si por alguna razón quieres volver a usar SQLite local:

1. Cambia en `.env`:
   ```env
   DB_CONNECTION=sqlite
   ```

2. Ejecuta:
   ```bash
   type nul > database\database.sqlite
   php artisan migrate:fresh --seed
   php artisan serve
   ```

---

## 📞 RESUMEN

1. ✅ Tu `.env` ya está configurado con Supabase
2. ⏳ Necesitas habilitar PostgreSQL en PHP (PASO 1)
3. ⏳ Ejecutar `CONECTAR_SUPABASE.bat` (PASO 2)
4. ✅ Login con cualquier usuario de tu Supabase

---

**🎯 EJECUTA `CONECTAR_SUPABASE.bat` Y PRUEBA EL LOGIN** 🚀

Si necesitas ayuda, revisa el archivo `storage/logs/laravel.log` para ver detalles de errores.
