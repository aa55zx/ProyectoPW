# 🔧 SOLUCIÓN AL ERROR: "could not find driver"

## ❌ Problema
Laravel está configurado para PostgreSQL (Supabase) pero tu sistema no tiene las extensiones instaladas.

## ✅ SOLUCIÓN RÁPIDA: Usar SQLite (TEMPORAL)

Ya he configurado tu proyecto para usar SQLite temporalmente. Sigue estos pasos:

### Paso 1: Limpiar Caché
Abre tu terminal en la raíz del proyecto y ejecuta:

```bash
php artisan config:clear
php artisan cache:clear
```

### Paso 2: Ejecutar Migraciones
```bash
php artisan migrate
```

### Paso 3: Crear Usuarios de Prueba (Opcional)
```bash
php artisan tinker
```

Dentro de tinker, ejecuta:
```php
$admin = new App\Models\User();
$admin->name = 'Administrador';
$admin->email = 'admin@tecnm.mx';
$admin->numero_control = 'ADMIN001';
$admin->password = bcrypt('admin123');
$admin->user_type = 'admin';
$admin->email_verified_at = now();
$admin->save();

$docente = new App\Models\User();
$docente->name = 'Profesor Juan';
$docente->email = 'docente@tecnm.mx';
$docente->numero_control = 'DOC001';
$docente->password = bcrypt('docente123');
$docente->user_type = 'docente';
$docente->email_verified_at = now();
$docente->save();

$estudiante = new App\Models\User();
$estudiante->name = 'María García';
$estudiante->email = 'estudiante@tecnm.mx';
$estudiante->numero_control = '20240001';
$estudiante->password = bcrypt('estudiante123');
$estudiante->user_type = 'estudiante';
$estudiante->email_verified_at = now();
$estudiante->save();

exit
```

### Paso 4: Iniciar Servidor
```bash
php artisan serve
```

### Paso 5: Probar
Abre http://localhost:8000 y prueba con:
- **Admin**: ADMIN001 / admin123
- **Docente**: DOC001 / docente123
- **Estudiante**: 20240001 / estudiante123

---

## 🎯 ALTERNATIVA: Script Automático (Windows)

Si estás en Windows, ejecuta este archivo:
```bash
setup_sqlite.bat
```

Este script hará todo automáticamente.

---

## 🚀 SOLUCIÓN PERMANENTE: Instalar PostgreSQL para Supabase

Si quieres usar Supabase (recomendado a largo plazo), necesitas instalar las extensiones de PostgreSQL:

### Windows (XAMPP/WAMP)

1. **Localiza tu archivo php.ini**:
   - XAMPP: `C:\xampp\php\php.ini`
   - WAMP: `C:\wamp64\bin\php\phpX.X.XX\php.ini`

2. **Abre php.ini con un editor de texto**

3. **Busca estas líneas y quita el punto y coma (;) del inicio**:
   ```ini
   ;extension=pdo_pgsql
   ;extension=pgsql
   ```
   
   Debe quedar así:
   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```

4. **Guarda el archivo**

5. **Reinicia Apache** desde el panel de control de XAMPP/WAMP

6. **Verifica la instalación**:
   ```bash
   php -m | findstr pgsql
   ```
   
   Deberías ver:
   ```
   pdo_pgsql
   pgsql
   ```

### Linux (Ubuntu/Debian)

```bash
sudo apt-get update
sudo apt-get install php-pgsql php-pdo-pgsql
sudo systemctl restart apache2
# o si usas nginx:
sudo systemctl restart php-fpm
```

### macOS (Homebrew)

```bash
brew install php-pgsql
brew services restart php
```

---

## 🔄 Cambiar de SQLite a Supabase (Después de instalar extensiones)

1. **Edita `.env`** y descomenta las líneas de Supabase:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=db.xxxxx.supabase.co
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres
   DB_PASSWORD=tu_password
   DB_SSLMODE=require
   ```

2. **Comenta las líneas de SQLite**:
   ```env
   # DB_CONNECTION=sqlite
   ```

3. **Limpia caché**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Verifica la conexión**:
   ```bash
   php verify_connection.php
   ```

---

## 📝 Resumen

**AHORA (TEMPORAL)**: 
✅ Tu proyecto usa SQLite
✅ Puedes desarrollar y probar
✅ Los archivos están modificados

**DESPUÉS (PERMANENTE)**:
1. Instala extensiones PostgreSQL
2. Configura Supabase
3. Cambia el `.env` de SQLite a pgsql
4. Ejecuta el SQL en Supabase

---

## ❓ ¿Qué Base de Datos Usar?

| Opción | Ventajas | Desventajas |
|--------|----------|-------------|
| **SQLite (Actual)** | ✅ Sin instalación<br>✅ Funciona inmediatamente<br>✅ Fácil para desarrollo | ❌ Solo para desarrollo local<br>❌ No escalable<br>❌ No para producción |
| **Supabase (PostgreSQL)** | ✅ Producción-ready<br>✅ Escalable<br>✅ Cloud<br>✅ Backups automáticos | ❌ Requiere extensiones PHP<br>❌ Requiere configuración |

**Recomendación**: Usa SQLite AHORA para probar, luego cambia a Supabase.

---

¡Tu aplicación debería funcionar ahora! 🎉
