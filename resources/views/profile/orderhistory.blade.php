<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black  leading-tight">
            {{ __('Historial de Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-black ">{{ __('Recent Orders') }}</h3>
                <div class="mt-4">
                    <table class="min-w-full border border-gray-300 ">
                        <thead class="bg-gray-100  text-black ">
                        <tr>
                            <th class="px-4 py-2 border">{{ __('Order ID') }}</th>
                            <th class="px-4 py-2 border ">{{ __('Date') }}</th>
                            <th class="px-4 py-2 border ">{{ __('Total') }}</th>
                            <th class="px-4 py-2 border ">{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ([
                            ['id' => '12345', 'date' => '2024-03-25', 'total' => '59.99', 'status' => 'Completed'],
                            ['id' => '12346', 'date' => '2024-03-20', 'total' => '89.50', 'status' => 'Pending'],
                            ['id' => '12347', 'date' => '2024-03-15', 'total' => '29.99', 'status' => 'Shipped'],
                        ] as $order)
                            <tr class="border  text-black">
                                <td class="px-4 py-2 border ">#{{ $order['id'] }}</td>
                                <td class="px-4 py-2 border ">{{ $order['date'] }}</td>
                                <td class="px-4 py-2 border ">${{ $order['total'] }}</td>
                                <td class="px-4 py-2 border ">
                                                    <span class="px-2 py-1 rounded text-white text-sm
                                                        {{ $order['status'] == 'Completed' ? 'bg-green-500' : ($order['status'] == 'Pending' ? 'bg-yellow-500' : 'bg-blue-500') }}">
                                                        {{ __($order['status']) }}
                                                    </span>
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
