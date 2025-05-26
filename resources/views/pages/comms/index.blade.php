<x-app-layout>


    <div class="container mx-auto flex flex-col items-center justify-center min-h-screen py-8">
        <div class="container mx-auto mb-6">
            <h2 class="text-[2em] font-bold mb-4">Calendario de conciertos</h2>
            <div id="calendar" class="shadow-lg p-4 bg-white rounded"></div>
        </div>

        <!-- Mensaje de éxito después de enviar el formulario -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        <!-- Mensaje de error si hay problemas al enviar el formulario -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Se encontraron los siguientes errores:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Formulario para solicitar un concierto -->
        <h2 class="text-[2em] font-semibold mb-4 text-center">Solicitar un concierto</h2>
        <form action="{{ route('concert.handleRequest') }}" method="POST" class="space-y-4 w-full max-w-xl">
            @csrf
            <div>
                <label for="request_name" class="block text-sm font-medium">Nombre del solicitante</label>
                <input type="text" name="request_name" id="request_name" class="mt-1 block w-full max-w-md mx-auto border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email del solicitante</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full max-w-md mx-auto border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="venue" class="block text-sm font-medium">Lugar del concierto</label>
                <input type="text" name="venue" id="venue" class="mt-1 block w-full max-w-md mx-auto border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium">Fecha del concierto</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full max-w-md mx-auto border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium">Mensaje (opcional)</label>
                <textarea name="message" id="message" rows="4" class="mt-1 block w-full max-w-md mx-auto border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 mx-auto block">Solicitar Concierto</button>
        </form>

    </div>
</x-app-layout>
