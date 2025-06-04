<x-app-layout>
    @push('scripts')
        <script type="module" src="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.2.0/src/lite-yt-embed.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.2.0/src/lite-yt-embed.css" />
    @endpush

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
        <!-- Sección de Videos -->
        <div class="shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-black mb-6">{{ __('Videos') }}</h2>

            <div x-data="{ activeSlide: 0, slides: {{ count($videos['items']) }} }" class="relative">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-300 ease-in-out"
                         :style="{ transform: `translateX(-${activeSlide * 100}%)` }">
                        @foreach($videos['items'] as $index => $video)
                            <div class="w-3/4 sm:w-2/3 md:w-1/2 flex-shrink-0 px-2 mx-auto">
                                <div class="rounded-lg shadow-lg overflow-hidden bg-white">
                                    <div class="relative pt-[56.25%]">
                                        <lite-youtube videoid="{{ $video['id'] }}"
                                                      class="absolute top-0 left-0 w-full h-full"
                                                      playlabel="Reproducir video de YouTube">
                                        </lite-youtube>
                                    </div>
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold text-black mb-2">
                                            {{ $video['snippet']['title'] }}
                                        </h5>
                                        <p class="text-black mb-3">
                                            {{ \Illuminate\Support\Str::limit($video['snippet']['description'], 100) }}
                                        </p>
                                        <p class="text-black text-sm">
                                            {{ __('Publicado:') }} {{ \Carbon\Carbon::parse($video['snippet']['publishedAt'])->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones -->
                <button @click="activeSlide = (activeSlide === 0) ? 0 : activeSlide - 1"
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r-lg hover:bg-opacity-75">
                    <x-heroicon-o-chevron-left class="h-6 w-6" />
                    <span class="sr-only">Anterior</span>
                </button>

                <button @click="activeSlide = (activeSlide === slides - 1) ? slides - 1 : activeSlide + 1"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l-lg hover:bg-opacity-75">
                    <x-heroicon-o-chevron-right class="h-6 w-6" />
                    <span class="sr-only">Siguiente</span>
                </button>

                <!-- Indicadores -->
                <div class="flex justify-center mt-4">
                    @foreach($videos['items'] as $index => $video)
                        <button @click="activeSlide = {{ $index }}"
                                class="h-2 w-2 mx-1 rounded-full"
                                :class="{ 'bg-red-600': activeSlide === {{ $index }}, 'bg-gray-300': activeSlide !== {{ $index }} }">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sección de Posts -->
        <div class="shadow-sm sm:rounded-lg p-6 bg-white">
            <h2 class="text-2xl font-semibold text-black mb-6">{{ __('Últimas Operaciones') }}</h2>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($posts as $post)
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition duration-300 overflow-hidden">
                        @if($post->images->first())
                            <img src="{{ $post->images->first()->url }}" alt="Imagen del post"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4 space-y-2">
                            <h3 class="text-lg font-bold text-gray-800 truncate">{{ $post->title }}</h3>

                            <p class="text-gray-600 text-sm">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                            </p>

                            <div class="text-xs text-gray-500">
                                <span>Por {{ $post->user->name ?? 'Anónimo' }}</span> ·
                                <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div>
                                <a href="{{ route('ops.show', $post->id) }}"
                                   class="inline-block mt-2 text-sm text-blue-600 hover:underline font-medium">
                                    Ver más →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No hay posts para mostrar.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
