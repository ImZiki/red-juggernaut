<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('pages.shop.cart', compact('cart', 'total'));
    }

    // Añadir producto al carrito
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'option' => 'nullable|string',
        ]);

        $productId = $request->product_id;
        $option = $request->option ?? null;

        $itemKey = $productId;
        if ($option) {
            $itemKey .= '-' . str_replace(' ', '_', $option);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $request->quantity;
        } else {
            $cart[$itemKey] = [
                'name' => $request->name . ($option ? " ($option)" : ''),
                'price' => $request->price,
                'quantity' => $request->quantity,
                'option' => $option,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }


    // Vaciar carrito
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado.');
    }
}
