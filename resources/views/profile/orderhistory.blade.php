<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial de Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Recent Orders') }}</h3>
                <div class="mt-4">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2 border dark:border-gray-600">{{ __('Order ID') }}</th>
                            <th class="px-4 py-2 border dark:border-gray-600">{{ __('Date') }}</th>
                            <th class="px-4 py-2 border dark:border-gray-600">{{ __('Total') }}</th>
                            <th class="px-4 py-2 border dark:border-gray-600">{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ([
                            ['id' => '12345', 'date' => '2024-03-25', 'total' => '59.99', 'status' => 'Completed'],
                            ['id' => '12346', 'date' => '2024-03-20', 'total' => '89.50', 'status' => 'Pending'],
                            ['id' => '12347', 'date' => '2024-03-15', 'total' => '29.99', 'status' => 'Shipped'],
                        ] as $order)
                            <tr class="border dark:border-gray-700 text-gray-600 dark:text-gray-400">
                                <td class="px-4 py-2 border dark:border-gray-600">#{{ $order['id'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-600">{{ $order['date'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-600">${{ $order['total'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-600">
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
