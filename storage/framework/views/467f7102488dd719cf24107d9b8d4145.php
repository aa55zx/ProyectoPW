<?php $__env->startSection('title', 'Nuevo Evento Creado'); ?>

<?php $__env->startSection('content'); ?>
    <h2>¡Nuevo Evento Disponible!</h2>

    <p>Se ha creado un nuevo evento en EventTecNM que podría interesarte.</p>

    <div class="info-box">
        <strong><?php echo e($event->title); ?></strong><br><br>
        <strong>Categoría:</strong> <?php echo e($event->category); ?><br>
        <strong>Fecha del evento:</strong> <?php echo e(\Carbon\Carbon::parse($event->event_start_date)->format('d/m/Y')); ?> - <?php echo e(\Carbon\Carbon::parse($event->event_end_date)->format('d/m/Y')); ?><br>
        <strong>Registro hasta:</strong> <?php echo e(\Carbon\Carbon::parse($event->registration_end_date)->format('d/m/Y')); ?><br>
        <?php if($event->is_online): ?>
            <strong>Modalidad:</strong> En línea
        <?php else: ?>
            <strong>Ubicación:</strong> <?php echo e($event->location ?? 'Por definir'); ?>

        <?php endif; ?>
    </div>

    <p><strong>Descripción:</strong></p>
    <p><?php echo e($event->description); ?></p>

    <div class="divider"></div>

    <p><strong>Requisitos del equipo:</strong></p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Tamaño mínimo: <?php echo e($event->min_team_size); ?> integrantes</li>
        <li>Tamaño máximo: <?php echo e($event->max_team_size); ?> integrantes</li>
        <?php if($event->max_teams): ?>
            <li>Cupo máximo: <?php echo e($event->max_teams); ?> equipos</li>
        <?php endif; ?>
    </ul>

    <center>
        <a href="<?php echo e(config('app.url')); ?>/eventos/<?php echo e($event->id); ?>" class="button">Ver Detalles del Evento</a>
    </center>

    <p style="font-size: 13px; color: #888; margin-top: 20px;">
        ¡No pierdas esta oportunidad! Registra tu equipo antes de que se agoten los lugares.
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\merin\Downloads\ProyectoPW\resources\views/emails/event-created.blade.php ENDPATH**/ ?>