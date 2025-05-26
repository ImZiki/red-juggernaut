<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Red Juggernaut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Asegurate de tener Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
<div class="text-center px-4">
    <h1 class="text-7xl font-extrabold text-red-600">@yield('code')</h1>
    <h2 class="text-2xl font-semibold mt-4">@yield('message')</h2>
    <p class="mt-4 text-gray-600">@yield('description')</p>
    <a href="{{ url('/') }}" class="inline-block mt-6 px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Volver al inicio
    </a>
</div>
</body>
</html>
