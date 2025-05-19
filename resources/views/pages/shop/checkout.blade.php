<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-black">Checkout</h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-10 text-black max-w-3xl">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-semibold mb-4">Tu pedido</h3>
            <ul class="mb-6">

                @foreach($cart as $item)
                    <li class="flex justify-between mb-2">
                        <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="text-right font-bold text-lg mb-6">
                Total: ${{ number_format($total, 2) }}
            </div>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- PASAMOS LA CLAVE PÚBLICA DE STRIPE A JS --}}
            <script>
                window.STRIPE_KEY = @json(env('STRIPE_KEY'));
            </script>

            <form id="payment-form" method="POST" action="{{ route('checkout.process') }}" x-data="stripeCheckout()" x-init="initStripe()" novalidate>
                @csrf

                <label for="shipping_address" class="block mb-2 font-semibold">Dirección de envío</label>
                <input type="text" name="shipping_address" id="shipping_address" class="w-full mb-4 p-2 border rounded" required>

                <label for="billing_address" class="block mb-2 font-semibold">Dirección de facturación</label>
                <input type="text" name="billing_address" id="billing_address" class="w-full mb-4 p-2 border rounded" required>

                <label for="order_notes" class="block mb-2 font-semibold">Notas adicionales</label>
                <input type="text" name="order_notes" id="order_notes" class="w-full mb-4 p-2 border rounded">

                <label class="block mb-2 font-semibold">Tarjeta de crédito</label>
                <div id="card-element" class="p-3 border rounded mb-4"></div>

                <input type="hidden" name="payment_method" x-ref="paymentMethod" x-bind:value="paymentMethod">

                <button type="submit" :disabled="loading" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-500">
                    <span x-text="loading ? 'Procesando...' : 'Pagar ahora'"></span>
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
</x-app-layout>
