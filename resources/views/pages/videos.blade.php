@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Videos del canal</h2>

        <div x-data="{ activeSlide: 0, slides: {{ count($videos['items']) }} }" class="relative">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-300 ease-in-out"
                     :style="{ transform: `translateX(-${activeSlide * 100}%)` }">
                    @foreach($videos['items'] as $index => $video)
                        <div class="w-full flex-shrink-0 px-2">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative pt-[56.25%]">
                                    <iframe class="absolute top-0 left-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $video['id'] }}"
                                            allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold mb-2">{{ $video['snippet']['title'] }}</h5>
                                    <p class="text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit($video['snippet']['description'], 100) }}</p>
                                    <p class="text-gray-500 text-sm">
                                        Publicado: {{ \Carbon\Carbon::parse($video['snippet']['publishedAt'])->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Botones de navegación -->
            <button @click="activeSlide = (activeSlide === 0) ? 0 : activeSlide - 1"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r-lg hover:bg-opacity-75 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sr-only">Anterior</span>
            </button>

            <button @click="activeSlide = (activeSlide === slides - 1) ? slides - 1 : activeSlide + 1"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l-lg hover:bg-opacity-75 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sr-only">Siguiente</span>
            </button>

            <!-- Indicadores -->
            <div class="flex justify-center mt-4">
                @foreach($videos['items'] as $index => $video)
                    <button @click="activeSlide = {{ $index }}"
                            class="h-2 w-2 mx-1 rounded-full focus:outline-none"
                            :class="{ 'bg-blue-600': activeSlide === {{ $index }}, 'bg-gray-300': activeSlide !== {{ $index }} }">
                    </button>
                @endforeach
            </div>
        </div>
    </div>
@endsection
