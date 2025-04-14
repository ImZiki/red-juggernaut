<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Detalle del Producto</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black">
        @php
            // Datos del producto (esto será reemplazado por la lógica del controlador)
            $product = [
                'name' => 'Producto 1',
                'description' => 'Descripción detallada del producto. Aquí puedes incluir más información sobre sus características.',
                'price' => '50.00',
                'image' => ['discofront.jpg', 'discoback.jpg'],
                'additional_info' => 'Más detalles sobre el producto, como instrucciones de uso, especificaciones, etc.'
            ];
        @endphp

        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="w-full" x-data="{
                    currentImage: 0,
                    images: {{ json_encode(array_map(function($img) { return asset('images/' . $img); }, $product['image'])) }},
                    init() {}
                }">
                    <!-- Carrusel principal con tamaño fijo -->
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <!-- Contenedor de imagen con dimensiones fijas -->
                        <div class="w-full max-w-full mx-auto" style="height: 500px; aspect-ratio: 1238/979;">
                            <img :src="images[currentImage]"
                                 alt="{{ $product['name'] }}"
                                 class="object-contain w-full h-full rounded-lg transition-all duration-300 ease-in-out">
                        </div>

                        <!-- Botones de navegación -->
                        <button
                            x-show="images.length > 1"
                            @click="currentImage = (currentImage > 0 ? currentImage - 1 : images.length - 1)"
                            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"
                            class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white rounded-full w-10 h-10 flex items-center justify-center focus:outline-none"
                            aria-label="Imagen anterior">
                            &lt;
                        </button>

                        <button
                            x-show="images.length > 1"
                            @click="currentImage = (currentImage < images.length - 1 ? currentImage + 1 : 0)"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                            class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white rounded-full w-10 h-10 flex items-center justify-center focus:outline-none"
                            aria-label="Imagen siguiente">
                            &gt;
                        </button>
                    </div>

                    <!-- Miniaturas de previsualización con gap -->
                    <div x-show="images.length > 1" class="flex gap-3 overflow-x-auto py-2 justify-center">
                        <template x-for="(image, index) in images" :key="index">
                            <div
                                @click="currentImage = index"
                                class="flex-shrink-0 cursor-pointer transition-all duration-200 ease-in-out p-1"
                                :class="currentImage === index ? 'ring-2 ring-blue-500 rounded' : 'opacity-70 hover:opacity-100'">
                                <img
                                    :src="image"
                                    :alt="`Vista previa ${index + 1}`"
                                    class="h-16 w-16 object-cover rounded"
                                    :class="currentImage === index ? 'border-2 border-blue-500' : ''">
                            </div>
                        </template>
                    </div>
                </div>

                <div class="w-full">
                    <h3 class="text-2xl font-semibold mb-4">{{ $product['name'] }}</h3>
                    <p class="text-gray-700 mb-4">{{ $product['description'] }}</p>
                    <span class="text-lg font-semibold mb-4">${{ $product['price'] }}</span>
                    <p class="text-gray-600 mb-4">{{ $product['additional_info'] }}</p>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                        Agregar al carrito
                    </button>

                    <!-- Botón para volver a la tienda -->
                    <a href="{{ route('shop') }}" class="inline-block mt-6 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition">
                        <span class="mr-2">&larr;</span> Volver a la tienda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
