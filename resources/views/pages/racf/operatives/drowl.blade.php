<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 leading-tight">Ficha de Dr Owl</h1>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Imagen a la izquierda --}}
            <div class="md:w-1/2 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/dr-owl-file.png') }}" alt="Otto Stein" class="w-full object-cover h-64 md:h-auto">
            </div>

            {{-- Texto a la derecha --}}
            <div class="md:w-1/2 bg-white rounded-lg shadow p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Nombre: <span class="font-normal">Otto Stein</span></h2>
                <p><span class="font-semibold">Alias:</span> Dr. Owl</p>
                <p><span class="font-semibold">Lugar de origen:</span> Saint Fernandorf (Estado de Cadizfornia)</p>
                <p><span class="font-semibold">Fecha de nacimiento:</span> 07JUN1979</p>

                <h3 class="text-lg font-semibold mt-4">Perfil Psicológico:</h3>
                <p class="text-black leading-relaxed">
                    Reservado, metódico, tranquilo, sereno, observador, le cuesta exteriorizar sus emociones. Obsesivo, creativo, calculador. De pensamiento frío y meditado. Excelente pensador.
                </p>

                <h3 class="text-lg font-semibold">Especialidad:</h3>
                <p class="text-black leading-relaxed">
                    Psicología, biología, ingeniería, ciencía, mecánica, electrónica, fisíca y fisíca cuantica. Psicokinesis.
                </p>

                <h3 class="text-lg font-semibold">Anteriores ocupaciones:</h3>
                <p>No se tienen datos.</p>

                <h3 class="text-lg font-semibold">Historia:</h3>
                <p class="text-black leading-relaxed">
                    Procedente de una familia humilde de clase baja, poco se sabe de su época de estudiante. Pasó desapercibido entre los mejores de su promoción hasta su salida de la universidad. Donde desapareció durante 10 años.
                    Localizado de nuevo a la edad de 35 años, en varios proyectos corporativos relacionados con el desarrollo de células, trabajando en investigaciones de dudosa moralidad, subvencionadas por fabricantes de armas y ejércitos privados.
                    Junto a otro científico llamado "Frederik Nash", destacaron en la creación de una nueva célula mutante, capaz de replicar a la pefección el comportamiento del adn humano.
                    Debido al descubrimiento, muchas organizaciones tanto gubernamentales como privadas, corporaciones y accionistas, se unían a una batalla al mejor postor, llegando incluso a peligrar sus vidas, junto a todo su trabajo.
                    El "C.I.D." (Crimson Intelligence Department) consigue descifrar unos códigos ocultos que se interceptaron en una transmisión fantasma de radio. Desvelando así un inminente asalto a las residencias de los 2 científicos espeficados (Dr Stein y Dr Nash), con la intención de secuestrarlos. Nunca se supo quienes fueron los emisores y quien los receptores para ejecutar las operaciones.
                    La "Red Force" consiguió proteger al Dr. Stein con éxito.
                    La operación para la protección a Dr. Nash fracasó y en la actualidad, sigue en paradero desconocido.
                    El Dr. Stein, tras varios años de trabajos conjuntos con la "Red Force", consigue un puesto indiscutido en el escuadrón de élite R.A.C.F. (Red Advance Covering Force), a parte de la vicepresidencia en la cámara del "C.I.D." (Crimson Intelligence Department), en I+D.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
