<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">
            {{ __('Detalle del Pedido #') . $order->id }}
        </h1>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-md shadow space-y-6">

            <div class="space-y-1">
                <p><strong>Cliente:</strong> <span class="text-gray-700">{{ $order->user->name }}</span> (<a href="mailto:{{ $order->user->email }}" class="text-blue-600 hover:underline">{{ $order->user->email }}</a>)</p>
                <p><strong>Fecha:</strong> <span class="text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</span></p>
            </div>

            @php
                $statusColors = [
                    'pagado' => 'bg-yellow-400 text-yellow-900',
                    'enviado' => 'bg-blue-400 text-blue-900',
                    'en proceso' => 'bg-orange-400 text-orange-900',
                    'completado' => 'bg-green-400 text-green-900',
                    'cancelado' => 'bg-red-400 text-red-900',
                    'solicitud devolucion' => 'bg-purple-400 text-purple-900',
                    'devolucion aceptada' => 'bg-green-400 text-green-900',
                    'devolucion rechazada' => 'bg-red-400 text-red-900',
                    'pendiente' => 'bg-gray-400 text-gray-900',
                ];
                $statusClass = $statusColors[$order->status] ?? 'bg-gray-400 text-gray-900';
            @endphp

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="font-semibold">Estado actual:</p>
                    <span class="inline-block px-3 py-1 rounded-full font-semibold {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- Formulario para actualizar estado --}}
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    <label for="status" class="sr-only">Cambiar estado</label>
                    <select name="status" id="status" onchange="this.form.submit()"
                            class="border border-gray-300 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="pendiente" @selected($order->status == 'pendiente')>Pendiente</option>
                        <option value="completado" @selected($order->status == 'completado')>Completado</option>
                        <option value="cancelado" @selected($order->status == 'cancelado')>Cancelado</option>
                        <option value="pagado" @selected($order->status == 'pagado')>Pagado</option>
                        <option value="devolucion aceptada" @selected($order->status == 'devolucion aceptada')>Aceptar devolución</option>
                        <option value="devolucion rechazada" @selected($order->status == 'devolucion rechazada')>Rechazar devolución</option>
                    </select>
                    <button type="submit" class="hidden">Actualizar</button>
                </form>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">Productos:</h3>
                <ul class="list-disc pl-6 space-y-2 text-gray-700">
                    @foreach($order->items as $item)
                        <li>
                            <span class="font-semibold">{{ $item->product->name }}</span> –
                            Cantidad: {{ $item->quantity }} –
                            Precio: ${{ number_format($item->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="pt-4">
                <a href="{{ route('admin.orders.index') }}"
                   class="inline-block text-blue-600 hover:underline text-sm">← Volver a la lista de pedidos</a>
            </div>
        </div>
    </div>
</x-app-layout>
