# 📧 Sistema de Envío de Emails con Brevo - EventTecNM

## ✅ Implementación Completada

Se ha implementado un sistema completo de envío de emails usando **Brevo** (anteriormente Sendinblue) para tu proyecto Laravel.

### 📦 Archivos Creados

#### Mailables (7 clases):
```
app/Mail/
├── WelcomeMail.php              - Email de bienvenida
├── EventCreatedMail.php         - Notificación de nuevo evento
├── TeamRegisteredMail.php       - Confirmación de registro de equipo
├── AdvisorRequestMail.php       - Solicitud de asesoría
├── AdvisorAcceptedMail.php      - Asesor aceptado
├── JudgeAssignedMail.php        - Asignación de juez
└── ProjectEvaluatedMail.php     - Proyecto evaluado
```

#### Vistas de Email (8 plantillas):
```
resources/views/emails/
├── layout.blade.php             - Layout base con diseño profesional
├── welcome.blade.php            - Vista de bienvenida
├── event-created.blade.php      - Vista de nuevo evento
├── team-registered.blade.php    - Vista de equipo registrado
├── advisor-request.blade.php    - Vista de solicitud de asesoría
├── advisor-accepted.blade.php   - Vista de asesor aceptado
├── judge-assigned.blade.php     - Vista de juez asignado
└── project-evaluated.blade.php  - Vista de proyecto evaluado
```

#### Documentación:
- `GUIA_ENVIO_EMAILS.md` - Guía completa de configuración y uso
- `EJEMPLO_INTEGRACION_EMAILS.php` - Ejemplos de código
- `README_EMAILS.md` - Este archivo (inicio rápido)

---

## 🚀 Inicio Rápido

### 1. Configurar Brevo (5 minutos)

1. **Crea una cuenta gratuita en Brevo:**
   - Ve a https://app.brevo.com/
   - Regístrate con tu email

2. **Obtén tu API Key:**
   - En Brevo, ve a `Settings` → `SMTP & API`
   - Click en `Create a new SMTP key` o `Generate a new API key`
   - Copia la API key generada

3. **Configura tu `.env`:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp-relay.brevo.com
   MAIL_PORT=587
   MAIL_USERNAME=tu-email-brevo@example.com
   MAIL_PASSWORD=xsmtpsib-tu-api-key-aqui
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="noreply@eventtecnm.com"
   MAIL_FROM_NAME="EventTecNM"
   ```

   **⚠️ IMPORTANTE:**
   - `MAIL_USERNAME` = el email con el que te registraste en Brevo
   - `MAIL_PASSWORD` = la API key que copiaste (NO tu contraseña de Brevo)

### 2. Probar la Configuración

Abre la terminal y ejecuta:

```bash
php artisan tinker
```

Luego ejecuta este código:

```php
Mail::raw('Email de prueba desde EventTecNM', function ($message) {
    $message->to('tu-email@example.com')
            ->subject('Test Email');
});
```

Si todo está configurado correctamente, recibirás el email en tu bandeja de entrada.

### 3. Usar en tus Controladores

#### Ejemplo básico:

```php
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

// En tu método del controlador
public function crearUsuario(Request $request)
{
    // ... crear usuario ...

    // Enviar email
    Mail::to($usuario->email)->send(new WelcomeMail($usuario));

    return redirect()->back()->with('success', 'Usuario creado!');
}
```

---

## 📖 Tipos de Emails Disponibles

### 1. Email de Bienvenida
```php
use App\Mail\WelcomeMail;
Mail::to($usuario->email)->send(new WelcomeMail($usuario));
```

### 2. Nuevo Evento Creado
```php
use App\Mail\EventCreatedMail;
Mail::to($estudiante->email)->send(new EventCreatedMail($evento));
```

### 3. Equipo Registrado
```php
use App\Mail\TeamRegisteredMail;
Mail::to($miembro->email)->send(new TeamRegisteredMail($equipo, $evento));
```

### 4. Solicitud de Asesoría
```php
use App\Mail\AdvisorRequestMail;
Mail::to($lider->email)->send(new AdvisorRequestMail($asesor, $equipo, $mensaje));
```

### 5. Asesor Aceptado
```php
use App\Mail\AdvisorAcceptedMail;
Mail::to($miembro->email)->send(new AdvisorAcceptedMail($asesor, $equipo));
```

### 6. Juez Asignado
```php
use App\Mail\JudgeAssignedMail;
Mail::to($juez->email)->send(new JudgeAssignedMail($juez, $evento));
```

### 7. Proyecto Evaluado
```php
use App\Mail\ProjectEvaluatedMail;
Mail::to($miembro->email)->send(new ProjectEvaluatedMail($proyecto));
```

---

## ⚙️ Configuración para Producción

### Usar Colas (Recomendado)

Las colas evitan que el envío de emails bloquee las peticiones HTTP.

1. **Configurar en `.env`:**
   ```env
   QUEUE_CONNECTION=database
   ```

2. **Crear tablas de cola:**
   ```bash
   php artisan queue:table
   php artisan migrate
   ```

3. **Cambiar `send()` por `queue()`:**
   ```php
   // Antes
   Mail::to($email)->send(new WelcomeMail($user));

   // Después (con cola)
   Mail::to($email)->queue(new WelcomeMail($user));
   ```

4. **Ejecutar el worker:**
   ```bash
   php artisan queue:work
   ```

---

## 🧪 Probar sin Enviar Emails Reales

### Opción 1: Usar el driver `log`

En `.env`:
```env
MAIL_MAILER=log
```

Los emails se guardarán en `storage/logs/laravel.log` en lugar de enviarse.

### Opción 2: Usar Mailtrap (Recomendado para desarrollo)

1. Crea cuenta en https://mailtrap.io/
2. Obtén credenciales SMTP
3. En `.env`:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=tu-username
   MAIL_PASSWORD=tu-password
   ```

---

## 📊 Límites de Brevo

### Plan Gratuito:
- **300 emails/día**
- SMTP y API incluidos
- Sin límite de contactos

### Recomendaciones:
- Monitorea tu uso en el dashboard de Brevo
- Considera actualizar el plan si necesitas más envíos
- Usa colas para distribuir los envíos

---

## ✨ Características del Sistema

### Diseño Profesional:
- Layout responsive con gradientes modernos
- Compatible con todos los clientes de email
- Diseño coherente en todas las plantillas

### Personalización:
- Variables dinámicas en cada email
- Información específica del usuario/evento
- Botones de acción con links directos

### Seguridad:
- Validación de emails antes de enviar
- Manejo de errores sin interrumpir el flujo
- Logs de todos los envíos

---

## 🔧 Solución de Problemas Comunes

### ❌ "Connection could not be established"

**Solución:**
- Verifica que `MAIL_HOST` sea `smtp-relay.brevo.com`
- Confirma que `MAIL_PORT` sea `587`
- Asegúrate de que `MAIL_ENCRYPTION` sea `tls`

### ❌ "Authentication failed"

**Solución:**
- Verifica que `MAIL_PASSWORD` sea tu API Key de Brevo
- Confirma que `MAIL_USERNAME` sea tu email de registro en Brevo
- Regenera la API Key si es necesaria

### ❌ Email llega a spam

**Solución:**
- Verifica tu dominio en Brevo
- Configura registros SPF y DKIM
- Evita palabras spam en el asunto

### ❌ Emails no se envían en desarrollo

**Solución:**
- Verifica el archivo `.env` (no `.env.example`)
- Ejecuta `php artisan config:clear`
- Revisa los logs: `storage/logs/laravel.log`

---

## 📚 Documentación Adicional

Para más información detallada, consulta:

1. **GUIA_ENVIO_EMAILS.md** - Guía completa con todos los detalles
2. **EJEMPLO_INTEGRACION_EMAILS.php** - Ejemplos de código avanzados
3. [Documentación oficial de Brevo](https://developers.brevo.com/)
4. [Documentación de Laravel Mail](https://laravel.com/docs/mail)

---

## 🎯 Próximos Pasos

1. ✅ Configurar credenciales de Brevo
2. ✅ Probar envío básico con `tinker`
3. ⬜ Integrar emails en AdminController
4. ⬜ Integrar emails en AsesorController
5. ⬜ Configurar colas para producción
6. ⬜ Probar cada tipo de email
7. ⬜ Personalizar plantillas según necesites

---

## 💡 Tips y Mejores Prácticas

1. **Usa colas en producción** - Mejora el rendimiento
2. **Maneja errores con try-catch** - No interrumpas el flujo por un email
3. **Registra los envíos** - Útil para debugging
4. **Valida emails antes de enviar** - Evita rebotes
5. **Respeta los límites de Brevo** - No satures el servicio
6. **Personaliza las plantillas** - Añade tu branding
7. **Prueba en diferentes clientes** - Gmail, Outlook, etc.

---

## 🆘 ¿Necesitas Ayuda?

Si tienes problemas:

1. Revisa los logs: `storage/logs/laravel.log`
2. Consulta la guía completa: `GUIA_ENVIO_EMAILS.md`
3. Verifica el dashboard de Brevo para ver el estado de los envíos
4. Revisa la documentación de Laravel Mail

---

**¡Todo listo para empezar a enviar emails! 🚀**
