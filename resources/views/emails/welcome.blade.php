@extends('emails.layout')

@section('title', 'Bienvenido a EventTecNM')

@section('content')
    <h2>¡Bienvenido, {{ $user->name }}!</h2>

    <p>Nos complace darte la bienvenida a <strong>EventTecNM</strong>, la plataforma oficial para la gestión de eventos académicos del Tecnológico Nacional de México.</p>

    <p>Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a todas las funcionalidades de la plataforma.</p>

    <div class="info-box">
        <strong>Información de tu cuenta:</strong><br>
        <strong>Nombre:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Tipo de usuario:</strong> {{ ucfirst($user->user_type ?? $user->role ?? 'estudiante') }}
    </div>

    <p>Con tu cuenta puedes:</p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Participar en eventos académicos</li>
        <li>Formar y gestionar equipos</li>
        <li>Subir y presentar proyectos</li>
        <li>Recibir retroalimentación de jueces y asesores</li>
    </ul>

    <center>
        <a href="{{ config('app.url') }}/login" class="button">Iniciar Sesión</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.
    </p>
@endsection
