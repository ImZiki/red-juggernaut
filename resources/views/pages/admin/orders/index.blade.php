<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">
            Gestión de pedidos
        </h1>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($orders as $order)
                @php
                    // Mapear status a color
                    $statusColors = [
                        'pagado' => 'bg-yellow-500',
                        'enviado' => 'bg-blue-500',
                        'en proceso' => 'bg-orange-500',
                        'completado' => 'bg-green-500',
                        'cancelado' => 'bg-red-500',
                        'solicitud devolucion' => 'bg-purple-500',
                        'devolucion aceptada' => 'bg-green-500',
                    ];
                    $statusClass = $statusColors[$order->status] ?? 'bg-gray-500';
                @endphp

                <div class="relative p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition-shadow">
                    <!-- Label estado arriba a la derecha -->
                    <div class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold text-white rounded-full {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </div>

                    <div class="mb-4">
                        <p class="text-xl font-bold text-gray-800">Pedido #{{ $order->id }}</p>
                        <p class="text-gray-600">Cliente: {{ $order->user->name }} ({{ $order->user->email }})</p>
                        <p class="text-gray-600">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                        Ver detalles
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No hay productos disponibles.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
