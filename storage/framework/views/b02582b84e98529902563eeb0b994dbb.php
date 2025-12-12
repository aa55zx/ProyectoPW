<?php $__env->startSection('title', 'Bienvenido a EventTecNM'); ?>

<?php $__env->startSection('content'); ?>
    <h2>¡Bienvenido, <?php echo e($user->name); ?>!</h2>

    <p>Nos complace darte la bienvenida a <strong>EventTecNM</strong>, la plataforma oficial para la gestión de eventos académicos del Tecnológico Nacional de México.</p>

    <p>Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a todas las funcionalidades de la plataforma.</p>

    <div class="info-box">
        <strong>Información de tu cuenta:</strong><br>
        <strong>Nombre:</strong> <?php echo e($user->name); ?><br>
        <strong>Email:</strong> <?php echo e($user->email); ?><br>
        <strong>Tipo de usuario:</strong> <?php echo e(ucfirst($user->user_type ?? $user->role ?? 'estudiante')); ?>

    </div>

    <p>Con tu cuenta puedes:</p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Participar en eventos académicos</li>
        <li>Formar y gestionar equipos</li>
        <li>Subir y presentar proyectos</li>
        <li>Recibir retroalimentación de jueces y asesores</li>
    </ul>

    <center>
        <a href="<?php echo e(config('app.url')); ?>/login" class="button">Iniciar Sesión</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\merin\Downloads\ProyectoPW\resources\views/emails/welcome.blade.php ENDPATH**/ ?>