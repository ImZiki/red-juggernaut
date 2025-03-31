<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Muestra la página principal de la tienda
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filtrar por categoría si se proporciona
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Destacar productos si se solicita
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $products = $query->paginate(12);
        $categories = Product::distinct('category')->pluck('category');

        return view('pages.shop.index', compact('products', 'categories'));
    }

    /**
     * Muestra la página de un producto específico
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('pages.shop.product', compact('product', 'relatedProducts'));
    }

    /**
     * Agrega un producto al carrito
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'options' => 'nullable|array',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Obtener el carrito actual o crear uno nuevo
        $cart = session()->get('cart', []);

        $cartItemId = $validated['product_id'] . '-' . md5(json_encode($validated['options'] ?? []));

        // Verificar si ya existe el producto en el carrito
        if (isset($cart[$cartItemId])) {
            $cart[$cartItemId]['quantity'] += $validated['quantity'];
        } else {
            $cart[$cartItemId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $validated['quantity'],
                'options' => $validated['options'] ?? [],
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Muestra el carrito de compras
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('pages.shop.cart', compact('cart'));
    }

    /**
     * Actualiza la cantidad de un producto en el carrito
     */
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'cart_item_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$validated['cart_item_id']])) {
            $cart[$validated['cart_item_id']]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    /**
     * Elimina un producto del carrito
     */
    public function removeFromCart($cartItemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$cartItemId])) {
            unset($cart[$cartItemId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Muestra la página de checkout
     */
    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión para continuar con la compra.');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Tu carrito está vacío.');
        }

        return view('pages.shop.checkout', compact('cart'));
    }
}
