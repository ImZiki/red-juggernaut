<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-black leading-tight">
            {{ __('Crear Producto') }}
        </h1>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>Se encontraron los siguientes errores:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-semibold text-gray-700 mb-1">Nombre *</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                           required>

                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold text-gray-700 mb-1">Descripción</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block font-semibold text-gray-700 mb-1">Precio *</label>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                               value="{{ old('price') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                               required>

                    </div>
                    <div>
                        <label for="stock" class="block font-semibold text-gray-700 mb-1">Stock *</label>
                        <input type="number" name="stock" id="stock" min="0"
                               value="{{ old('stock', 0) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                               required>

                    </div>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block font-semibold text-gray-700 mb-1">Categoría</label>
                    <select name="category_id" id="category_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200">
                        <option value="">-- Seleccionar categoría --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-4 flex items-center gap-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1" class="form-checkbox"
                            {{ old('is_featured') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Destacado</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="form-checkbox"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Activo</span>
                    </label>
                </div>

                <div class="mb-6">
                    <label for="images" class="block font-semibold text-gray-700 mb-1">Imágenes (múltiples, máximo 100MB c/u)</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*" class="block w-full text-gray-600">
                    <div id="image-preview" class="mt-3 flex flex-wrap gap-3"></div>
                </div>

                <div>
                    <button type="submit"
                            class="bg-black hover:opacity-80 text-white px-5 py-2 rounded shadow">
                        Crear Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
