<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Constructor para asegurar que solo usuarios autenticados accedan
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Procesa la creación de un nuevo pedido
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total del pedido
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Crear el pedido
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
        ]);

        // Crear los items del pedido
        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if ($product) {
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'options' => $item['options'] ?? null,
                ]);

                // Actualizar el stock
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Limpiar el carrito
        session()->forget('cart');

        // Aquí añadirías la lógica para procesar el pago

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Tu pedido ha sido creado con éxito.');
    }

    /**
     * Muestra un pedido específico
     */
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // Verificar que el usuario actual sea el dueño del pedido
        if ($order->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        return view('pages.orders.show', compact('order'));
    }

    /**
     * Lista todos los pedidos del usuario actual
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    /**
     * Cancela un pedido (si aún está en estado pendiente)
     */
    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Verificar que el usuario actual sea el dueño del pedido
        if ($order->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para cancelar este pedido.');
        }

        // Solo permitir cancelar pedidos pendientes
        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            $order->save();

            // Restaurar el stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            return redirect()->route('orders.index')
                ->with('success', 'Tu pedido ha sido cancelado.');
        }

        return redirect()->route('orders.index')
            ->with('error', 'No se puede cancelar este pedido.');
    }
}
