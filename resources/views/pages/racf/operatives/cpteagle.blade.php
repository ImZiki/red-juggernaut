<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 leading-tight">Ficha de Cpt. Eagle</h1>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Imagen a la izquierda --}}
            <div class="md:w-1/2 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/cpt-eagle-file.png') }}" alt="Tradde McArthy" class="w-full object-cover h-64 md:h-auto">
            </div>

            {{-- Texto a la derecha --}}
            <div class="md:w-1/2 bg-white rounded-lg shadow p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Nombre: <span class="font-normal">Tradde McArthy</span></h2>
                <p><span class="font-semibold">Alias:</span> Captain Eagle</p>
                <p><span class="font-semibold">Lugar de origen:</span> Chiclana City (Estado de Cadizfornia)</p>
                <p><span class="font-semibold">Fecha de nacimiento:</span> 07DIC1987</p>

                <h3 class="text-lg font-semibold mt-4">Perfil Psicológico:</h3>
                <p class="text-black leading-relaxed">
                    Osado, estratega, analista, resolutivo, empático, agradecido y emotivo. Nunca se rinde. Grandes dotes de Líder.
                </p>

                <h3 class="text-lg font-semibold">Especialidad:</h3>
                <p class="text-black leading-relaxed">
                    Visión ampliada, reflejos sobrehumanos, fuerza, aguanta grandes cantidades de presión. Excelente piloto en todo tipo de vehículos. Ignífugo.
                </p>

                <h3 class="text-lg font-semibold">Anteriores ocupaciones:</h3>
                <p>Piloto de aviación de combate. Taxista.</p>

                <h3 class="text-lg font-semibold">Historia:</h3>
                <p class="text-black leading-relaxed">
                    Tras años de operaciones con un 100% de efectividad resolutiva, incluso venciendo adversidades no pronosticadas,
                    el señor McArthy sufre una emboscada fatal.
                    Enviado a una simple operación de reconocimiento aéreo, junto a su escuadrón de cazas, escoltado por territerio de nadie,
                    cayeron por error en un señuelo de aves de rapiña.
                    Desde tierra, atacaban con misiles antiaéreos, mientras una fuerza no identificada, arremetía desde el aire confundiendo las telecomunicaciones y creando campos magnéticos que sacudía cada aparato electrónico de las aeronaves.
                    Solo él pudo salir con vida, tras ser recogido sin atisbos de consciencia en medio del desierto, por un ganadero que transportaba su rebaño por la zona.
                    Nunca se encontró ninguna prueba, ni restos, ni caja negra, que pueda explicar con detalles lo sucedido.
                    Solo quedarán las radiotransmisiones de socorro del señor McArthy mientras fue asaltado.
                    Tras lo ocurrido, cayó en una profunda depresión por la impotencia de no haber podido esclarecer el porqué de toda la situación. Consumido por la culpa de no predecir el ataque, dejó la aviación, sucumbió en la bebida y, en sus horas de sobriedad, conducía un taxi en el turno de noche.
                    Todo cambió de nuevo cuando recibió la llamada personal del "Red Lord", y tras varias horas de conversación, se unió oficialmente al escuadrón de élite R.A.C.F. (Red Advance Covering Force).
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
