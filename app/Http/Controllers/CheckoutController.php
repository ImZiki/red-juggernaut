<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('pages.shop.checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $user = $request->user();
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $paymentMethod = $request->input('payment_method');

        if (!$paymentMethod) {
            return back()->withErrors('El método de pago es requerido');
        }

        try {
            // Crear cliente en Stripe si no existe
            if (!$user->hasStripeId()) {
                $user->createAsStripeCustomer();
            }

            // Actualizar el método de pago predeterminado
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Crear un PaymentIntent y cobrar al cliente
            $charge = $user->charge(
                $total * 100,  // Monto en centavos
                $paymentMethod,
                [
                    'currency' => 'eur',
                    'description' => 'Compra en Tienda Online',
                    'payment_method_types' => ['card'],
                    'metadata' => [
                        'user_id' => $user->id,
                        'order_number' => uniqid('order_')
                    ]
                ]
            );

            if ($charge->status === 'succeeded') {
                DB::beginTransaction();

                // Crear la orden en la base de datos
                $order = $user->orders()->create([
                    'total' => $total,
                    'status' => 'pagado',
                    'payment_method' => 'stripe',
                    'notes' => $request->input('order_notes'),
                    'shipping_address' => $request->input('shipping_address', ''),
                    'billing_address' => $request->input('billing_address', ''),
                ]);

                foreach ($cart as $cartKey => $item) {
                    // Extraer el product_id numérico (antes del guion, o toda la clave si no hay guion)
                    $productId = explode('-', $cartKey)[0];

                    $order->items()->create([
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'option' => $item['option'], // o 'options' si prefieres plural
                    ]);
                }


                DB::commit();

                // Vaciar el carrito
                Session::forget('cart');

                return redirect()->route('order.show', $order->id)->with('success', 'Pago realizado correctamente.');
            } else {
                return back()->withErrors('El pago no se pudo procesar.');
            }

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
