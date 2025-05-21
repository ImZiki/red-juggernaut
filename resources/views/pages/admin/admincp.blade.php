<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Panel de Administración</h1>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

        {{-- Usuarios Registrados --}}
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-gray-800">Usuarios Registrados</h2>
            <div class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <p><strong>Nombre:</strong> <span class="text-gray-700">{{ $user->name }}</span></p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a></p>
                        <p><strong>Fecha de Registro:</strong> <span class="text-gray-600">{{ $user->created_at->format('d M Y') }}</span></p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Pedidos Realizados --}}
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-gray-800">Pedidos Realizados</h2>
            <div class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                        <p><strong>Usuario:</strong> <span class="text-gray-700">{{ $order->user->name }}</span></p>
                        <p><strong>Fecha:</strong> <span class="text-gray-600">{{ $order->created_at->format('d M Y') }}</span></p>
                        <p><strong>Estado:</strong> <span class="capitalize font-semibold">{{ $order->status }}</span></p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Solicitudes de Conciertos --}}
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-gray-800">Solicitudes de Conciertos</h2>
            <div class="divide-y divide-gray-200">
                @foreach($concertRequests as $request)
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                        <p><strong>Email:</strong> <a href="mailto:{{ $request->email }}" class="text-blue-600 hover:underline">{{ $request->email }}</a></p>
                        <p><strong>Fecha de Solicitud:</strong> <span class="text-gray-600">{{ $request->created_at->format('d M Y') }}</span></p>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
</x-app-layout>
