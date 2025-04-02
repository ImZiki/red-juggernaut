<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-0 place-items-center">
            <img src="{{ asset('images/banner2.jpg') }}" alt="Logo 2" class="h-96 w-auto">

        </div>
    </x-slot>

    <div class="py-12">
        <!-- Sección de bienvenida -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Sección de Imágenes -->
                <div class="flex flex-col items-center space-y-4">
                    <img src="{{ asset('images/redjuggracf.jpg') }}" alt="Portada Red Juggernaut" class="w-full max-w-md rounded-lg shadow-lg">

                </div>

                <!-- Sección de Texto -->
                <div class="mt-4 text-lg text-black space-y-4">
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


            <div class="grid grid-cols-2 md:grid-cols-2 gap-3">
                <a href="{{ route('bio') }}" class="p-4 w-64 mx-auto bg-black  shadow sm:rounded-lg text-center transition duration-300 hover:bg-opacity-75">
                    <h3 class="text-lg font-semibold text-white">{{ __('Biografía') }}</h3>
                    <p class="text-xs text-white">{{ __('Texto') }}</p>
                </a>

                <a href="{{ route('skills') }}" class="p-4 w-64 mx-auto bg-black  shadow sm:rounded-lg text-center transition duration-300 hover:bg-opacity-75">
                    <h3 class="text-lg font-semibold text-white">{{ __('Competencias') }}</h3>
                    <p class="text-xs text-white">{{ __('Texto') }}</p>
                </a>
            </div>



        </div>
    </div>
</x-app-layout>
