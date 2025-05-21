<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-black leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-semibold text-gray-700 mb-1">Nombre *</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                           required>
                    @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold text-gray-700 mb-1">Descripción</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block font-semibold text-gray-700 mb-1">Precio *</label>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                               value="{{ old('price') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                               required>
                        @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="stock" class="block font-semibold text-gray-700 mb-1">Stock *</label>
                        <input type="number" name="stock" id="stock" min="0"
                               value="{{ old('stock', 0) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200"
                               required>
                        @error('stock')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block font-semibold text-gray-700 mb-1">Categoría</label>
                    <select name="category_id" id="category_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200">
                        <option value="">-- Seleccionar categoría --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('images')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
