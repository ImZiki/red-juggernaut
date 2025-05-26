<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Tienda</h2>
            <div class="flex justify-end mt-2">
                <a href="{{ route('cart.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                    <!-- ícono carrito -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293a1 1 0 00.293 1.414l.707.707a1 1 0 001.414 0L12 13m0 0l2.293 2.293a1 1 0 001.414 0l.707-.707a1 1 0 00.293-1.414L17 13m-10 0h10" />
                    </svg>

                    @php
                        $cart = session('cart', []);
                        $count = array_sum(array_column($cart, 'quantity'));
                    @endphp

                    <span class="ml-2">Carrito ({{ $count }})</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-4 gap-6">
        {{-- Sidebar --}}
        <aside class="space-y-6 pr-6 border-r border-gray-200">
            {{-- Buscador --}}
            <form method="GET" action="{{ route('shop') }}" class="flex w-full max-w-xs">
                <input name="q" value="{{ request('q') }}" placeholder="Buscar…"
                       class="flex-1 p-2 border rounded-l block w-full box-border" />
                <button class="px-4 bg-black hover:bg-opacity-80 text-white rounded-r">Buscar</button>
            </form>

            {{-- Categorías --}}
            <div>
                <h3 class="font-semibold mb-2">Categorías</h3>
                <ul class="space-y-1">
                    <li class="mb-3">
                        <a href="{{ route('shop') }}"
                            @class([
                                'font-bold border-b-4 border-red-500 shadow-md' => !request('category'),
                                'inline-block pb-1' // para que el border-bottom quede pegado al texto
                            ])>- Todas</a>
                    </li>
                    @foreach($categories as $cat)
                        <li class="mb-3">
                            <a href="{{ route('shop', ['category'=>$cat->slug]) }}"
                                @class([
                                    'font-bold border-b-4 border-red-500 shadow-md' => request('category') == $cat->slug,
                                    'inline-block pb-1'
                                ])>
                                - {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>


            {{-- Featured --}}
            <div>
                <h3 class="font-semibold mb-2">Destacados</h3>
                <ul class="space-y-4">
                    @foreach($featured as $f)
                        <li class="flex items-center">
                            @php
                                $fImage = $f->images->first();
                            @endphp
                            <img src="{{ $fImage
                                ? asset('storage/product_images/' . $fImage->filename)
                                : asset('images/placeholder.png') }}"
                                 class="w-12 h-12 object-cover rounded mr-3" alt="Imagen producto"/>
                            <a href="{{ route('product.show',$f) }}" class="hover:underline">
                                {{ $f->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Productos --}}
        <section class="lg:col-span-3 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        <a href="{{ route('product.show',$product) }}">
                            @php
                                $productImage = $product->images->first();
                            @endphp
                            <img src="{{ $productImage
    ? asset('storage/product_images/' . $productImage->filename)
    : asset('images/placeholder.png') }}"
                                 class="w-48 h-48 object-cover" alt="Imagen producto"/>
                        </a>
                        <div class="p-4">
                            <a href="{{ route('product.show',$product) }}" class="font-semibold hover:underline">
                                {{ $product->name }}
                            </a>
                            <p class="text-gray-600 text-sm mt-1">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="font-bold">${{ number_format($product->price,2) }}</span>
                                <a href="{{ route('product.show',$product) }}"
                                   class="text-blue-600 hover:underline text-sm">Ver</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No se encontraron productos.</p>
                @endforelse
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </section>
    </div>
</x-app-layout>
