<x-app-layout>
    <div class="p-6 space-y-6">
        <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <a href="{{ route('admin.concerts') }}" class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-opacity-80 transition">
                <h3 class="text-xl font-semibold mb-2">Zona 1</h3>
                <p>Gestion Conciertos</p>
            </a>
            <a href="{{ route('admin.products') }}" class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-opacity-80 transition">
                <h3 class="text-xl font-semibold mb-2">Zona 2</h3>
                <p>Gestion Productos</p>
            </a>
            <a href="#" class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-opacity-80 transition">
                <h3 class="text-xl font-semibold mb-2">Zona 3</h3>
                <p>Gestion X</p>
            </a>
        </div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Contenedor de Usuarios -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">Usuarios Registrados</h2>
                <div class="grid gap-4">
                    @foreach($users as $user)

                        <div class="p-4 border-b">
                            <p><strong>Nombre:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Contenedor de Pedidos -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">Pedidos Realizados</h2>
                <div class="grid gap-4">
                    @foreach($orders as $order)
                        <div class="p-4 border-b">
                            <p><strong>Usuario:</strong> {{ $order->user->name }}</p>
                            <p><strong>Fecha:</strong> {{ $order->created_at->format('d M Y') }}</p>
                            <p><strong>Estado:</strong> {{ucfirst($order->status)}}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Contenedor de Solicitudes de Conciertos -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Solicitudes de Conciertos</h2>
                <div class="grid gap-4">
                    @foreach($concertRequests as $request)
                        <div class="p-4 border-b">
                            <p><strong>Email:</strong> {{ $request->email }}</p>
                            <p><strong>Fecha de Solicitud:</strong> {{ $request->created_at->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2"></script>

</x-app-layout>
