<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1) Sidebar: todas las categorías
        $categories = Category::orderBy('name')->get();

        // 2) Featured
        $featured = Product::where('is_featured', true)
            ->take(5)
            ->get();

        // 3) Query base de productos activos
        $query = Product::query()->where('is_active', true);

        // 4) Filtro de categoría
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) =>
            $q->where('slug', $request->category)
            );
        }

        // 5) Búsqueda
        if ($request->filled('q')) {
            $q = $request->q;
            $words = explode(' ', $q);

            $query->where(function ($qWhere) use ($words) {
                foreach ($words as $word) {
                    $qWhere->where(function ($subQuery) use ($word) {
                        $subQuery->where('name', 'like', "%{$word}%")
                            ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            });
        }


        // 6) Paginación
        $products = $query->paginate(12)->withQueryString();

        return view('pages.shop.index', compact('categories','featured','products'));
    }

    public function show($id)
    {
        // Obtener el producto desde la base de datos
        $product = Product::findOrFail($id);

        return view('pages.shop.product', compact('product'));
    }




}
