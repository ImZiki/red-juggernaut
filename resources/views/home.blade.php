<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-0 place-items-center">
            <img src="{{ asset('images/banner2.jpg') }}" alt="Logo 2" class="h-96 w-auto rounded-lg shadow-lg">
        </div>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">

            <!-- Bloque 1: Imagen IZQUIERDA + Texto DERECHA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/redjuggracf.jpg') }}" alt="Portada Red Juggernaut" class="w-full max-w-md rounded-lg shadow-lg">
                </div>
                <div class="space-y-4 text-black text-lg">
                    <p>
                        {{ __('La banda gaditana de "Hard Rock & Heavy Metal" está completamente inspirada en los cómics de superhéroes y las películas de acción.') }}
                    </p>
                    <p>
                        {{ __('En su corta trayectoria sobre los escenarios, Red Juggernaut ha sido telonero de bandas nacionales como "Lèpoca" o "Angelus Apatrida", e incluso de grupos internacionales como "Insanity Alert" o "Serious Black".') }}
                    </p>
                    <p>
                        {{ __('Este "power trio" ofrece un sonido enérgico y contundente, influenciado por bandas de "Hard Rock & Heavy Metal" de los 80 y 90, pero con un aire fresco que incorpora pasajes y tesituras de un "metal" más actual.') }}
                    </p>
                    <p>
                        {{ __('Su directo es un espectáculo único, tanto visual como musical. La banda cuenta con un bajista que añade toques "Funky", un joven guitarrista con una velocidad y actitud sorprendentes, y un baterista que, además de ser vocalista, es un portento en los malabares con las baquetas (Visual Stick Tricks).') }}
                    </p>
                </div>
            </div>

            <!-- Bloque 2: Imagen DERECHA + Texto IZQUIERDA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="space-y-4 text-black text-lg md:order-1 order-2">
                    <h2 class="text-[3em] font-bold text-red-900 leading-tight">Conoce nuestra historia</h2>
                    <p>{{ __('Sumérgete en la biografía de Red Juggernaut y descubre el origen del poder detrás de cada riff y baquetazo.') }}</p>
                    <a href="{{ route('bio') }}" class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-opacity-80 transition">Ir a Biografía</a>
                </div>
                <div class="flex justify-center md:order-2 order-1">
                    <img src="{{ asset('images/redjuggracf.jpg') }}" alt="Biografía" class="w-full max-w-md rounded-lg shadow-lg">
                </div>
            </div>

            <!-- Bloque 3: Imagen IZQUIERDA + Texto DERECHA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/redjuggracf.jpg') }}" alt="Competencias" class="w-full max-w-md rounded-lg shadow-lg">
                </div>
                <div class="space-y-4 text-black text-lg">
                    <h2 class="text-[3em] font-bold text-red-900 leading-tight">Descubre nuestras habilidades</h2>
                    <p>{{ __('Conoce las competencias musicales, técnicas y escénicas que hacen de Red Juggernaut una experiencia imparable.') }}</p>
                    <a href="{{ route('skills') }}" class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-opacity-80 transition">Ir a Competencias</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
