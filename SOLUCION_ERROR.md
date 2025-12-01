# PASOS PARA SOLUCIONAR EL ERROR

## Error Actual:
"file is not a database" - El archivo database.sqlite está corrupto o vacío

## ✅ SOLUCIÓN RÁPIDA (Ejecuta estos comandos UNO POR UNO)

Abre tu terminal en: `D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW`

### Paso 1: Borrar base de datos corrupta
```bash
del database\database.sqlite
```

### Paso 2: Crear base de datos nueva (vacía)
```bash
type nul > database\database.sqlite
```

### Paso 3: Limpiar caché de Laravel
```bash
php artisan config:clear
php artisan cache:clear
```

### Paso 4: Ejecutar migraciones (crear tablas)
```bash
php artisan migrate
```

### Paso 5: Crear usuarios de prueba
```bash
php artisan tinker
```

Dentro de tinker, copia y pega esto (todo de una vez):
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
$docente->name = 'Profesor Juan Pérez';
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

echo "¡3 usuarios creados exitosamente!\n";
exit
```

### Paso 6: Iniciar servidor
```bash
php artisan serve
```

### Paso 7: Probar en navegador
Abre: http://localhost:8000

Login con:
- Usuario: `ADMIN001`
- Password: `admin123`

---

## 🚀 ALTERNATIVA: Script Automático

Si quieres que todo se haga automáticamente, ejecuta:
```bash
configurar.bat
```

Esto hará todos los pasos anteriores automáticamente.

---

## ✅ Después de esto:

- ✅ Base de datos funcionando
- ✅ 3 usuarios creados
- ✅ Aplicación lista para usar
- ✅ Puedes hacer login

---

## 🆘 Si sigue sin funcionar:

1. Verifica que el archivo `database/database.sqlite` existe
2. Verifica que el `.env` tenga: `DB_CONNECTION=sqlite`
3. Ejecuta: `php artisan migrate:status` para ver el estado
4. Revisa los logs: `storage/logs/laravel.log`
