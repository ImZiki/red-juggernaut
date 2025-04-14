<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-custom">
<div class="min-h-screen">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

@include('components.footer')

<!-- Botón de Volver Arriba -->
<button id="backToTopButton" class="fixed bottom-5 right-5 p-3 bg-red-700 text-white rounded-full shadow-lg hidden transition-all duration-300 hover:bg-red-300 hover:text-black"
        onclick="scrollToTop()">
    ↑
</button>

<script>
    // Detectar el scroll y mostrar el botón
    window.onscroll = function() {
        const button = document.getElementById('backToTopButton');
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    };

    // Función para volver arriba
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
</body>
</html>
