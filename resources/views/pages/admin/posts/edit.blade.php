<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-black leading-tight">
            {{ __('Editar Post') }}
        </h1>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>¡Ups!</strong> Hubo algunos problemas con los datos ingresados.
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" class="w-full rounded border-gray-300" value="{{ old('title', $post->title) }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="content" rows="5" class="w-full rounded border-gray-300">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-black text-white px-4 py-2 rounded shadow">
                    Editar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
