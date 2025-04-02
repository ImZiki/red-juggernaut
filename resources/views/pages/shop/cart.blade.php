<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Carrito</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
            <p class="mb-4">No tienes productos en el carrito.</p>
            <a href="{{ route('shop') }}" class="text-blue-600 hover:underline">Volver a la tienda</a>
        </div>
    </div>
</x-app-layout>
