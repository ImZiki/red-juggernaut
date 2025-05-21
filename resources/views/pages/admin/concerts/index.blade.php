<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Gestión de Conciertos') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <div class="flex justify-end">
            <a href="{{ route('admin.concerts.create') }}"
               class="bg-black text-white px-4 py-2 rounded hover:bg-opacity-80 transition">+ Crear concierto manualmente</a>
        </div>

        <!-- Conciertos futuros -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Conciertos programados</h3>
            <ul class="divide-y">
                @forelse($concerts as $concert)
                    <li class="py-3">
                        <strong>{{ $concert->title }}</strong> — {{ $concert->formatted_date }} en {{ $concert->location }}
                    </li>
                @empty
                    <p>No hay conciertos futuros.</p>
                @endforelse
            </ul>
        </div>

        <!-- Solicitudes pendientes -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Solicitudes de conciertos pendientes</h3>
            <ul class="space-y-6">
                @forelse($requests as $request)
                    <li class="border rounded p-4">
                        <p><strong>Nombre:</strong> {{ $request->request_name }}</p>
                        <p><strong>Email:</strong> {{ $request->email }}</p>
                        <p><strong>Lugar:</strong> {{ $request->venue }}</p>
                        <p><strong>Fecha:</strong> {{ $request->formatted_date }}</p>
                        <p><strong>Mensaje:</strong> {{ $request->message }}</p>

                        <div class="flex items-center space-x-4 mt-4">
                            <form method="POST" action="{{ route('admin.concerts.acceptRequest', $request) }}">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Aceptar y crear concierto
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.concerts.rejectRequest', $request) }}">
                                @csrf @method('PUT')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Rechazar solicitud
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <p>No hay solicitudes pendientes.</p>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
