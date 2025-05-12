<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Biografía de la banda -->
        <div class="mb-16">
            <h1 class="text-[3em] font-bold text-center mb-8 text-red-900">R.A.C.F.</h1>
            <div class="rounded-lg  p-8">
                <p class="text-gray-700 mb-6">
                    El escuadrón de élite <strong>R.A.C.F.</strong> (<em>Red Advance Covering Force</em>) es una fuerza de operaciones especiales aliada del <strong>Juggernaut Rojo</strong>, brindando apoyo a las tropas de la <strong>Red Force</strong>.
                </p>
                <p class="text-gray-700 mb-6">
                    Sus tres miembros más destacados luchan codo a codo por la libertad y la justicia, incluso en ocasiones fuera de la estructura oficial. No hay registros confirmados de operaciones en solitario.
                </p>
                <p class="text-gray-700 mb-6">
                    Motivados por el sueño de una sociedad unida y armoniosa, recorren el mundo rastreando y combatiendo amenazas. Su origen se remonta a operaciones encubiertas impulsadas en secreto por <strong>Red Lord</strong>, debilitando corporaciones corruptas y desmantelando redes ilícitas.
                </p>
                <p class="text-gray-700">
                    En sus filas han participado también mercenarios especializados en misiones de bloqueo y eliminación, garantizando que las amenazas no resurjan.
                </p>
            </div>
        </div>
        <!-- Tarjetas del grupo de operaciones especiales -->
        <h2 class="text-[2em] font-bold text-center mb-10 text-red-900 uppercase">Grupo de operaciones especiales</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Tarjeta de cada miembro -->
            @php
                $members = [
                    ['nombre'=> 'Red Juggernaut', 'color' => 'bg-red-700', 'foto'=>'redjugg3.png'],
                    ['nombre' => 'Captain Eagle', 'color' => 'bg-orange-700', 'foto'=>'cpteagle3.png'],
                    ['nombre' => 'Dr. Owl', 'color' => 'bg-green-700', 'foto'=>'drowl4.png'],
                    ['nombre' => 'Wild Child', 'color' => 'bg-blue-700', 'foto'=>'wildchild3.png'],
                ];
            @endphp
            @foreach($members as $member)
                <a href="{{ route('racf.member.show', ['codename' => Str::slug($member['nombre'])]) }}">
                <div class="band-member-card relative rounded-lg overflow-hidden shadow-xl h-[673px] cursor-pointer group bg-black">
                    <!-- Capa de color -->
                    <div class="gradient-overlay absolute inset-0 {{ $member['color'] }} opacity-0 transition-opacity duration-500 group-hover:opacity-80"></div>
                    <!-- Imagen -->
                    <img src="{{ asset('images/'. $member['foto']) }}" alt="{{ $member['nombre'] }}" class="w-full h-full object-cover" />
                    <!-- Contenido con texto visible desde el inicio -->
                    <div class="member-content absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-1/2 transition-transform duration-500 group-hover:translate-y-0">
                        <!-- Nombre visible siempre -->
                        <h3 class="text-2xl font-bold mb-2 drop-shadow-md">{{ $member['nombre'] }}</h3>
                        <!-- Detalles que solo son visibles al hacer hover -->
                        <div class="member-details mt-4 opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <p class="mb-3 text-white drop-shadow-md">Acceso al perfil operativo</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
