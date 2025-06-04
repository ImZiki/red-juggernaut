<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
            <h1 class="text-2xl font-bold text-black">{{ $post->title }}</h1>

            <div class="text-sm text-gray-500">
                Publicado por {{ $post->user->name ?? 'Anónimo' }} el {{ $post->created_at->format('d/m/Y') }}
            </div>

            @if($post->images->first())
                <img src="{{ $post->images->first()->url }}" alt="Imagen del post" class="w-full h-auto rounded-md">
            @endif

            <div class="prose max-w-none text-gray-800">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </div>
</x-app-layout>
