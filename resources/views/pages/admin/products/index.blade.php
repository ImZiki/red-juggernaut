<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-black leading-tight">
            {{ __('Gestión de Productos') }}
        </h1>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">
        <div class="flex justify-end">
            <a href="{{ route('admin.products.create') }}"
               class="bg-black hover:bg-opacity-80 text-white px-4 py-2 rounded shadow">
                + Añadir Producto
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow rounded-xl p-4 pt-10 pr-4 relative">
                    {{-- Badges --}}
                    <div class="absolute top-2 right-2 z-10 space-y-1 text-right">
                        @if (!$product->is_active)
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full block">Desactivado</span>
                        @endif

                        @if ($product->is_featured)
                            <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full block">Destacado</span>
                        @endif
                    </div>

                    <h4 class="text-lg font-semibold text-black">{{ $product->name }}</h4>
                    <p class="text-gray-600 text-sm mb-2">ID: {{$product->id}}</p>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>

                    <div class="mb-3">
                        <span class="font-bold text-black">${{ number_format($product->price, 2) }}</span>
                        <span class="ml-2 text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                    </div>
                    {{-- Category --}}
                    <div class="text-sm text-gray-500 mb-2">Categoría: {{ $product->category }}</div>

                    <div class="flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Editar
                        </a>

                        <form method="POST" action="{{ route('admin.products.toggleFeatured', $product) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">
                                {{ $product->is_featured ? 'Quitar Destacado' : 'Destacar' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.products.toggleActive', $product) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="bg-{{ $product->is_active ? 'red' : 'green' }}-600 hover:bg-{{ $product->is_active ? 'red' : 'green' }}-700 text-white px-3 py-1 rounded text-sm">
                                {{ $product->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')">
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
                <p class="text-gray-500">No hay productos disponibles.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
