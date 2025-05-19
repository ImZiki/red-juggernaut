<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Tienda</h2>
            <!-- Enlace al carrito -->
            <div class="flex justify-end mt-2">
                <a href="{{ route('cart.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                    <!-- Ícono de carrito -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293a1 1 0 00.293 1.414l.707.707a1 1 0 001.414 0L12 13m0 0l2.293 2.293a1 1 0 001.414 0l.707-.707a1 1 0 00.293-1.414L17 13m-10 0h10" />
                    </svg>
                    <span class="ml-2">Carrito (0)</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black">
        @php
            // Datos dummy para la lista de productos
            $products = [
                [
                    'id' => 1,
                    'name' => 'Producto 1',
                    'description' => 'Descripción breve del producto. Ideal para cualquier ocasión.',
                    'price' => '50.00',
                    'image' => 'discofront.jpg'
                ],
                [
                    'id' => 2,
                    'name' => 'Producto 2',
                    'description' => 'Descripción breve del producto. Perfecto para regalar.',
                    'price' => '35.00',
                    'image' => 'discofront.jpg'
                ],
                [
                    'id' => 3,
                    'name' => 'Producto 3',
                    'description' => 'Descripción breve del producto. Calidad y confort en uno.',
                    'price' => '70.00',
                    'image' => 'discofront.jpg'
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-app-layout>
