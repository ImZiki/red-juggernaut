<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Crear Concierto') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow space-y-6">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>Se encontraron los siguientes errores:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.concerts.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="request_id" value="{{ $request->id ?? '' }}">

                <div>
                    <label class="block font-semibold mb-1">Título del concierto</label>
                    <input type="text" name="title" value="{{ old('title', $request->request_name ?? '') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Lugar</label>
                    <input type="text" name="location" value="{{ old('location', $request->venue ?? '') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Fecha y hora</label>
                    <input type="datetime-local" name="date" value="{{ old('date', isset($request) ? \Carbon\Carbon::parse($request->date)->format('Y-m-d\TH:i') : '') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="with_ticket" id="with_ticket" class="mr-2" onchange="document.getElementById('ticket_fields').classList.toggle('hidden')">
                        Añadir producto (entrada)
                    </label>
                </div>

                <div id="ticket_fields" class="hidden mt-4 space-y-4">
                    <div>
                        <label class="block font-semibold mb-1">Nombre del producto</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Descripción</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Precio</label>
                            <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Stock</label>
                            <input type="number" name="stock" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-opacity-80 transition">
                        Guardar concierto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
