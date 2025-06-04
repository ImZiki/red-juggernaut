<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 leading-tight">Ficha de Red Juggernaut</h1>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Imagen a la izquierda --}}
            <div class="md:w-1/2 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/red-jugg-file.png') }}" alt="Nivel de acceso KYPROS" class="w-full object-cover h-64 md:h-auto">
            </div>

            {{-- Texto a la derecha --}}
            <div class="md:w-1/2 bg-white rounded-lg shadow p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Nombre:
                    <span class="text-red-600 font-bold">Nivel de acceso KYPROS</span>
                </h2>
                <p><span class="font-semibold">Alias:</span> <span class="text-red-600 font-bold">Nivel de acceso KYPROS</span></p>
                <p><span class="font-semibold">Lugar de origen:</span> <span class="text-red-600 font-bold">Nivel de acceso KYPROS</span></p>
                <p><span class="font-semibold">Fecha de nacimiento:</span> <span class="text-red-600 font-bold">Nivel de acceso KYPROS</span></p>

                <h3 class="text-lg font-semibold mt-4">Perfil Psicológico:</h3>
                <p class="text-red-600 font-bold leading-relaxed">Nivel de acceso KYPROS</p>

                <h3 class="text-lg font-semibold">Especialidad:</h3>
                <p class="text-red-600 font-bold leading-relaxed">Nivel de acceso KYPROS</p>

                <h3 class="text-lg font-semibold">Anteriores ocupaciones:</h3>
                <p class="text-red-600 font-bold">Nivel de acceso KYPROS</p>

                <h3 class="text-lg font-semibold">Historia:</h3>
                <p class="text-red-600 font-bold leading-relaxed">Nivel de acceso KYPROS</p>
            </div>
        </div>
    </div>
</x-app-layout>
