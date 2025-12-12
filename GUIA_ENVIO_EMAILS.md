# Guía de Envío de Emails con Brevo

## Configuración Completada ✅

Tu proyecto ya está configurado para enviar emails usando **Brevo (Sendinblue)**.

## Mailables Disponibles

Se han creado los siguientes Mailables en `app/Mail/`:

1. **WelcomeMail** - Email de bienvenida (ya integrado en el registro)
2. **EventCreatedMail** - Notificación de nuevo evento
3. **TeamRegisteredMail** - Confirmación de registro de equipo
4. **AdvisorRequestMail** - Solicitud de asesoría
5. **AdvisorAcceptedMail** - Asesor aceptó solicitud
6. **JudgeAssignedMail** - Asignación de juez a evento
7. **ProjectEvaluatedMail** - Notificación de proyecto evaluado

## Cómo Usar los Mailables

### 1. Email de Bienvenida (Ya implementado)
```php
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

Mail::to($user->email)->send(new WelcomeMail($user));
```

### 2. Email cuando se Crea un Evento
```php
use App\Mail\EventCreatedMail;

$estudiantes = User::where('user_type', 'estudiante')->get();
foreach ($estudiantes as $estudiante) {
    Mail::to($estudiante->email)->send(new EventCreatedMail($evento));
}
```

### 3. Email cuando un Equipo se Registra
```php
use App\Mail\TeamRegisteredMail;

Mail::to($team->leader->email)->send(new TeamRegisteredMail($team, $event));
```

### 4. Email de Solicitud de Asesoría
```php
use App\Mail\AdvisorRequestMail;

Mail::to($user->email)->send(new AdvisorRequestMail($user, $proyecto->team, $mensaje));
```

### 5. Email cuando Asesor Acepta
```php
use App\Mail\AdvisorAcceptedMail;

Mail::to($lider->email)->send(new AdvisorAcceptedMail($user, $proyecto->team));
```

### 6. Email cuando se Asigna un Juez
```php
use App\Mail\JudgeAssignedMail;

Mail::to($judge->email)->send(new JudgeAssignedMail($judge, $evento));
```

### 7. Email cuando un Proyecto es Evaluado
```php
use App\Mail\ProjectEvaluatedMail;

foreach ($teamMembers as $member) {
    Mail::to($member->user->email)->send(new ProjectEvaluatedMail($project));
}
```

## Envío en Segundo Plano (Queue)

Para no hacer esperar al usuario:
```php
Mail::to($user->email)->queue(new WelcomeMail($user));
```

Ejecutar worker:
```bash
php artisan queue:work
```

## Testing

```bash
php artisan config:clear
php artisan cache:clear
```

## Mejores Prácticas

```php
try {
    Mail::to($user->email)->send(new WelcomeMail($user));
} catch (\Exception $e) {
    \Log::error('Error al enviar email: ' . $e->getMessage());
}
```

