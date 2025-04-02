<div class="max-w-xs mx-auto p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
    <a href="{{ route('product.show', ['id' => $product['id']]) }}">
        <img src="{{ asset('images/'.$product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-64 object-cover mb-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-2">{{ $product['name'] }}</h3>
        <p class="text-gray-700 mb-4">{{ $product['description'] }}</p>
        <div class="flex justify-between items-center">
            <span class="text-lg font-semibold">${{ $product['price'] }}</span>
        </div>
    </a>
</div>
