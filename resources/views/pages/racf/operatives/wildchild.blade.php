<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 leading-tight">Ficha de Wild Child</h1>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Imagen a la izquierda --}}
            <div class="md:w-1/2 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/wild-child-file.png') }}" alt="Warren Scott" class="w-full object-cover h-64 md:h-auto">
            </div>

            {{-- Texto a la derecha --}}
            <div class="md:w-1/2 bg-white rounded-lg shadow p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Nombre: <span class="font-normal">Warren Scott</span></h2>
                <p><span class="font-semibold">Alias:</span> Wild Child</p>
                <p><span class="font-semibold">Lugar de origen:</span> Lebrijapolis (Estado de Sevillinois)</p>
                <p><span class="font-semibold">Fecha de nacimiento:</span> 11DIC2002</p>

                <h3 class="text-lg font-semibold mt-4">Perfil Psicológico:</h3>
                <p class="text-black leading-relaxed">
                    Impulsivo, pero sigiloso, impetuoso, nervioso pero silencioso, impaciente pero cauteloso. Irascible, con la cualidad de aumentar su poder contra mas colérico se encuentra. Excelente capacidad de aprendizaje y adaptación. Superviviente nato.
                </p>

                <h3 class="text-lg font-semibold">Especialidad:</h3>
                <p class="text-black leading-relaxed">
                    Combate cuerpo a cuerpo, supervivencia, armas blancas, emboscada, rastreador, curación, camuflaje, escaramuza. Velocidad física aumentada. Sensibilidad olfativa y auditiva. Evasión.
                </p>

                <h3 class="text-lg font-semibold">Anteriores ocupaciones:</h3>
                <p>Cazador.</p>

                <h3 class="text-lg font-semibold">Historia:</h3>
                <p class="text-black leading-relaxed">
                    A muy temprana edad, y por causas que están fuera del nivel de desclasificación, fue dejado a cargo de un antiguo chamán eremita, que vivía en las montañas.
                    Desde bien pequeño, desarrolló un virtuisismo por la superivencia que estaba fuera de los alcances establecidos. Adiestrado en el combate con mano dura, rápidamente aumentaban sus capacidades y, siendo solo un adolescente, acabó con más de 10 cazadores furtivos con sus propias manos.
                    Su vida cambió al recibir un extraño mensaje en forma de carta, que portaba un zorro rojo con un collar al cuello. Un testamento donde era el único heredero de los bienes de la familia "Scottefield", dueña de la corporación "Scottefield enterprise" y máximo accionista de la "Red Force".
                    Su reclutamiento fue inmediato y pasó a formar parte importante de la "R.A.C.F" (Red Advance Covering Force) de forma directa. Busca utilizar su situación para esclarecer el porqué de su herencia, la familia y su extraño adiestramiento a tan temprana edad.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
