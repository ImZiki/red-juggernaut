<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Historial de Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-black">{{ __('Recent Orders') }}</h3>
                <div class="mt-4">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100 text-black">
                        <tr>
                            <th class="px-4 py-2 border">{{ __('Order ID') }}</th>
                            <th class="px-4 py-2 border">{{ __('Date') }}</th>
                            <th class="px-4 py-2 border">{{ __('Total') }}</th>
                            <th class="px-4 py-2 border">{{ __('Status') }}</th>
                            <th class="px-4 py-2 border">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr class="border text-black">
                                <td class="px-4 py-2 border">#{{ $order['id'] }}</td>
                                <td class="px-4 py-2 border">{{ $order['date'] }}</td>
                                <td class="px-4 py-2 border">${{ $order['total'] }}</td>
                                <td class="px-4 py-2 border">
                                    <span class="px-2 py-1 rounded text-white text-sm
                                        @switch($order['status'])
                                            @case('pagado') bg-yellow-500 @break
                                            @case('enviado') bg-blue-500 @break
                                            @case('en proceso') bg-orange-500 @break
                                            @case('completado') bg-green-500 @break
                                            @case('cancelado') bg-red-500 @break
                                            @case('solicitud devolucion') bg-purple-500 @break
                                            @case('devolucion aceptada') bg-green-500 @break
                                            @default bg-gray-500
                                        @endswitch">
                                        {{ __(ucfirst($order['status'])) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">
                                    @can('cancel', $order)
                                        <form method="POST" action="{{ route('orders.cancel', $order) }}">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-2 py-1 rounded">
                                                {{ __('Cancelar') }}
                                            </button>
                                        </form>
                                    @endcan

                                    @can('requestReturn', $order)
                                        <form method="POST" action="{{ route('orders.returnRequest', $order) }}" class="mt-1">
                                            @csrf
                                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-2 py-1 rounded">
                                                {{ __('Solicitar Devolución') }}
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
