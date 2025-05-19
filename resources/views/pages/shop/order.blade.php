<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Detalle del Pedido #{{ $order->id }}</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black max-w-3xl">
        <div class="bg-white p-6 rounded shadow">

            <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            <p><strong>Método de pago:</strong> {{ ucfirst($order->payment_method) }}</p>

            <h3 class="mt-6 font-semibold text-lg">Productos:</h3>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name ?? 'Producto eliminado' }} x {{ $item->quantity }} — ${{ number_format($item->price, 2) }}</li>
                @endforeach
            </ul>

            <h3 class="mt-6 font-semibold text-lg">Dirección de envío:</h3>
            <p>{{ $order->shipping_address }}</p>

            <h3 class="mt-6 font-semibold text-lg">Dirección de facturación:</h3>
            <p>{{ $order->billing_address }}</p>
            <div class="mt-8 text-center">
                <a href="{{ route('shop') }}"
                   class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
