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
                @dump($cart)
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

            <form id="payment-form" method="POST" action="{{ route('checkout.process') }}" x-data="stripeCheckout()" x-init="initStripe()">
                @csrf

                <label for="shipping_address" class="block mb-2 font-semibold">Dirección de envío</label>
                <input type="text" name="shipping_address" id="shipping_address" class="w-full mb-4 p-2 border rounded" required>

                <label for="billing_address" class="block mb-2 font-semibold">Dirección de facturación</label>
                <input type="text" name="billing_address" id="billing_address" class="w-full mb-4 p-2 border rounded" required>
                <label for="order_notes" class="block mb-2 font-semibold">Notas adicionales</label>
                <input type="text" name="order_notes" id="order_notes" class="w-full mb-4 p-2 border rounded">

                <label class="block mb-2 font-semibold">Tarjeta de credito</label>
                <div id="card-element" class="p-3 border rounded mb-4"></div>
                <input type="hidden" name="payment_method" x-ref="paymentMethod" x-bind:value="paymentMethod">


                <button type="submit" :disabled="loading" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-500">
                    <span x-text="loading ? 'Procesando...' : 'Pagar ahora'"></span>
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function stripeCheckout() {
            return {
                stripe: null,
                elements: null,
                card: null,
                paymentMethod: '',
                loading: false,

                initStripe() {
                    this.stripe = Stripe('{{ env('STRIPE_KEY') }}');
                    const elements = this.stripe.elements();
                    this.card = elements.create('card');
                    this.card.mount('#card-element');

                    // Escuchar el evento de cambio en la tarjeta
                    this.card.on('change', (event) => {
                        if (event.error) {
                            alert(event.error.message);
                        }
                    });

                    // Configurar el envío del formulario
                    const form = document.getElementById('payment-form');
                    form.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        this.loading = true;

                        try {
                            // Crear el método de pago usando la tarjeta
                            const { paymentMethod, error } = await this.stripe.createPaymentMethod({
                                type: 'card',
                                card: this.card,
                            });

                            if (error) {
                                alert(error.message);
                                this.loading = false;
                                return;
                            }

                            // Asignar el ID del método de pago al campo oculto
                            this.paymentMethod = paymentMethod.id;
                            this.$refs.paymentMethod.value = paymentMethod.id;

                            // Verificar que el valor esté presente
                            if (!this.paymentMethod) {
                                alert('Error: No se pudo obtener el método de pago.');
                                this.loading = false;
                                return;
                            }

                            // Enviar el formulario después de establecer el valor
                            form.submit();
                        } catch (err) {
                            console.error('Error al procesar el pago:', err);
                            alert('Error al procesar el pago.');
                            this.loading = false;
                        }
                    });
                }
            }
        }
    </script>

</x-app-layout>
