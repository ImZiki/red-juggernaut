<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Editar Producto</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block font-semibold">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                       class="w-full border p-2 rounded" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block font-semibold">Descripción</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border p-2 rounded">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Precio -->
            <div>
                <label for="price" class="block font-semibold">Precio</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                       class="w-full border p-2 rounded" step="0.01" required>
                @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Stock -->
            <div>
                <label for="stock" class="block font-semibold">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                       class="w-full border p-2 rounded" required>
                @error('stock') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label for="category_id" class="block font-semibold">Categoría</label>
                <select name="category_id" id="category_id" class="w-full border p-2 rounded">
                    <option value="">Sin categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Destacado -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_featured" id="is_featured"
                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                <label for="is_featured">Destacado</label>
            </div>

            <!-- Activo -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_active" id="is_active"
                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <label for="is_active">Activo</label>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Editar producto
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
