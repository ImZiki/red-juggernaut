<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Carrito</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">

            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            @if(count($cart) > 0)
                <table class="w-full mb-6">
                    <thead>
                    <tr>
                        <th class="text-left py-2">Producto</th>
                        <th class="text-right py-2">Precio</th>
                        <th class="text-center py-2">Cantidad</th>
                        <th class="text-right py-2">Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td class="text-right">${{ number_format($item['price'], 2) }}</td>
                            <td class="text-center">{{ $item['quantity'] }}</td>
                            <td class="text-right">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-right font-bold text-xl mb-6">
                    Total: ${{ number_format($total, 2) }}
                </div>

                <form action="{{ route('cart.clear') }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500">Vaciar carrito</button>
                </form>

                <a href="{{ route('checkout.show') }}" class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-500">
                    Proceder al pago
                </a>
            @else
                <p>No tienes productos en el carrito.</p>
                <a href="{{ route('shop') }}" class="text-blue-600 hover:underline">Volver a la tienda</a>
            @endif

        </div>
    </div>
</x-app-layout>
