<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('pages.shop.index');
    }

    public function show($id)
    {
        // Aquí deberías obtener el producto de la base de datos usando el $id
        $product = [
            'id' => $id,
            'name' => 'Producto 1',
            'description' => 'Descripción detallada del producto...',
            'price' => '50.00',
            'image' => 'discofront.jpg',
            'additional_info' => 'Más información sobre el producto'
        ];

        return view('pages.shop.product', compact('product'));
    }

}
