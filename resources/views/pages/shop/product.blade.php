<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Detalle del Producto</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg"
             x-data="{
                quantity: 1,
                showToast: false,
                toastMessage: '',
                selectedOption: null,
                productPrice: parseFloat({{ $product['price'] }}),
                finalPrice: parseFloat({{ $product['price'] }}),
                calculatePrice() {
                    if (this.selectedOption === 'VIP') {
                        this.finalPrice = this.productPrice + 50;
                    } else if (this.selectedOption === 'Discapacitado') {
                        this.finalPrice = this.productPrice * 0.9;
                    } else {
                        this.finalPrice = this.productPrice;
                    }
                },
                async addToCart() {
                    try {
                        const res = await fetch('{{ route("cart.add") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: {{ $product['id'] }},
                                name: '{{ $product['name'] }}',
                                price: this.finalPrice.toFixed(2),
                                quantity: this.quantity,
                                option: this.selectedOption // <-- enviamos la opción aquí
                            })
                        });
                        if (!res.ok) throw new Error('Error al añadir');
                        this.toastMessage = '¡Producto añadido al carrito!';
                    } catch (e) {
                        this.toastMessage = 'No se pudo añadir al carrito.';
                    } finally {
                        this.showToast = true;
                        setTimeout(() => this.showToast = false, 3000);
                    }
                }

             }"
        >

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="w-full">
                    <h3 class="text-2xl font-semibold mb-4">{{ $product['name'] }}</h3>
                    <p class="text-gray-700 mb-4">{{ $product['description'] }}</p>
                    <span class="text-lg font-semibold mb-4">Precio: $<span x-text="finalPrice.toFixed(2)"></span></span>
                    <p class="text-gray-600 mb-4">{{ $product['additional_info'] }}</p>

                    @if($product['category'] === 'Conciertos')
                        <label for="seatType" class="block mb-2">Tipo de asiento:</label>
                        <select x-model="selectedOption" @change="calculatePrice()" class="w-full p-2 border rounded mb-4">
                            <option value="Estandar">Estandar</option>
                            <option value="VIP">VIP (+50€)</option>
                            <option value="Discapacitado">Discapacitado (-10%)</option>
                        </select>
                    @elseif($product['category'] === 'Clothing')
                        <label for="size" class="block mb-2">Talla:</label>
                        <select x-model="selectedOption" class="w-full p-2 border rounded mb-4">
                            @foreach(['S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    @endif

                    <div class="mt-4 flex items-center">
                        <label for="quantity" class="mr-2 font-semibold">Cantidad</label>
                        <input type="number" id="quantity" x-model.number="quantity" min="1" class="w-20 p-1 border rounded" />
                        <button @click.prevent="addToCart()"
                                class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                            Agregar al carrito
                        </button>
                    </div>

                    <div x-show="showToast"
                         x-transition
                         class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
                        <span x-text="toastMessage"></span>
                    </div>

                    <a href="{{ route('shop') }}"
                       class="inline-block mt-6 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition">
                        &larr; Volver a la tienda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
