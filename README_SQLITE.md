# 🚀 EventTec - Sistema con SQLite

## ✅ TODO CONFIGURADO PARA SQLITE

Tu proyecto ahora usa SQLite (base de datos local) - ¡No necesitas configurar nada más!

---

## 🎯 CÓMO INICIAR (1 PASO)

### Haz doble clic en:
```
INICIAR.bat
```

**Eso es todo.** El script hará automáticamente:
1. Limpiar caché
2. Crear base de datos SQLite
3. Crear todas las tablas
4. Insertar datos de prueba
5. Iniciar el servidor

**Espera 2-3 minutos** hasta que veas:
```
Laravel development server started: http://127.0.0.1:8000
```

---

## 👤 INICIAR SESIÓN

### Abre tu navegador en:
```
http://127.0.0.1:8000/login
```

### Usuarios disponibles:

#### 🎓 Estudiante:
```
Email: carlos@estudiante.com
Password: password123
```

#### 👨‍🏫 Maestro:
```
Email: juan@maestro.com
Password: password123
```

#### ⚖️ Juez:
```
Email: maria@juez.com
Password: password123
```

#### 👑 Admin:
```
Email: admin@eventec.com
Password: admin123
```

---

## 📊 DATOS INCLUIDOS

✅ **17 usuarios** (10 estudiantes, 3 maestros, 3 jueces, 1 admin)  
✅ **4 eventos** completos:
   - Hackathon de Innovación 2024
   - Feria de Ciencias 2024
   - Expo Emprendedores
   - Concurso de Robótica

✅ **2 equipos** con miembros:
   - Tech Innovators (3 miembros)
   - Green Coders (3 miembros)

✅ **2 proyectos** evaluados con calificaciones  
✅ **Rúbricas** de evaluación con 4 criterios  
✅ **Cronograma** completo del Hackathon  
✅ **Notificaciones** de prueba  
✅ **Sistema de logros** activado  

---

## ✨ FUNCIONALIDADES

### Como Estudiante verás:
- ✅ Dashboard con estadísticas
- ✅ Lista de eventos disponibles
- ✅ Detalle de eventos con cronograma
- ✅ Crear y gestionar equipos
- ✅ Ver tus proyectos
- ✅ Notificaciones
- ✅ Logros desbloqueados

---

## 🔧 COMANDOS ÚTILES

### Reiniciar todo desde cero:
```bash
INICIAR.bat
```

### Ver datos en la base de datos:
```bash
php artisan tinker
>>> \App\Models\User::count()
>>> \App\Models\User::where('email', 'carlos@estudiante.com')->first()
>>> exit
```

### Limpiar caché manualmente:
```bash
php artisan optimize:clear
```

### Iniciar servidor manualmente:
```bash
php artisan serve
```

---

## 📁 ARCHIVOS IMPORTANTES

✅ `.env` - Configurado para SQLite  
✅ `database/database.sqlite` - Tu base de datos local  
✅ `database/migrations/` - Esquema de tablas  
✅ `database/seeders/DatabaseSeeder.php` - Datos de prueba  
✅ `app/Models/User.php` - Modelo actualizado  
✅ `INICIAR.bat` - Script de inicio automático  

---

## ⚠️ SOLUCIÓN DE PROBLEMAS

### "Base table or view not found"
```bash
# Ejecuta de nuevo:
INICIAR.bat
```

### "Class 'User' not found"
```bash
composer dump-autoload
php artisan config:clear
```

### El servidor no inicia
```bash
# Prueba otro puerto:
php artisan serve --port=8001
# Luego accede a: http://127.0.0.1:8001/login
```

### Quiero resetear todo
```bash
# Simplemente ejecuta de nuevo:
INICIAR.bat
```

---

## 🎯 RESUMEN

1. ✅ Configuración: SQLite (sin configuración adicional)
2. ✅ Iniciar: Doble clic en `INICIAR.bat`
3. ✅ Login: `http://127.0.0.1:8000/login`
4. ✅ Usuario: `carlos@estudiante.com` / `password123`

---

## 💾 ¿DÓNDE ESTÁN MIS DATOS?

Todo está en un solo archivo:
```
database\database.sqlite
```

Este archivo contiene TODA tu base de datos:
- Usuarios
- Eventos
- Equipos
- Proyectos
- Evaluaciones
- Todo

**Puedes hacer backup** simplemente copiando este archivo.

---

## 🚀 PRÓXIMOS PASOS

Una vez que funcione el login:

1. ✅ Explora el dashboard
2. ✅ Ve la lista de eventos
3. ✅ Crea un equipo nuevo
4. ✅ Explora las funcionalidades

---

**¡TODO LISTO! Solo ejecuta `INICIAR.bat` y prueba el login** 🎉

Si hay algún error, revisa: `storage/logs/laravel.log`
