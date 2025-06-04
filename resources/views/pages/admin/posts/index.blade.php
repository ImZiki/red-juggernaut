<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-black leading-tight">
            {{ __('Gestión de Posts') }}
        </h1>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.posts.create') }}"
               class="bg-black hover:bg-opacity-80 text-white px-4 py-2 rounded shadow">
                + Crear Post
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <div class="bg-white shadow rounded-xl p-4 pt-6 pr-4 relative">
                    <h4 class="text-lg font-semibold text-black">{{ $post->title }}</h4>
                    <p class="text-gray-600 text-sm mb-2">ID: {{$post->id}}</p>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($post->content, 100) }}</p>

                    @if ($post->image)
                        <img src="{{ asset('storage/media/' . $post->image) }}" class="rounded-lg mt-2 mb-4 max-h-40 object-cover w-full">
                    @endif

                    <div class="flex flex-wrap gap-2 mt-2">
                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Editar
                        </a>

                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No hay posts creados.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
