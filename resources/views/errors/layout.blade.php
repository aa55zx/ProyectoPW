<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        @yield('additional-styles')
    </style>
</head>
<body class="@yield('body-class', 'bg-gradient-to-br from-gray-50 to-gray-100') min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full text-center fade-in">
            @yield('content')
        </div>
    </div>

    <!-- Elementos decorativos opcionales -->
    @yield('decorative-elements')

    @yield('additional-scripts')
</body>
</html>
