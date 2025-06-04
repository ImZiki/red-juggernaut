<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-black leading-tight">418 - Soy una tetera☕️</h1>
    </x-slot>

    <div class="py-6 px-4 max-w-4xl mx-auto text-center">
        <img
            src="{{ asset('images/teapot.webp') }}"
            alt="Tetera"
            class="mx-auto mb-4 object-cover">

        <p class="text-lg text-gray-700">¡Lo siento! No puedo preparar café porque soy una tetera. ☕️🫖</p>
    </div>
</x-app-layout>
