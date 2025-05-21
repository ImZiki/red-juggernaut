<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class   ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('pages.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('pages.admin.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0|max:99999999.99',
            'stock'       => 'required|integer|min:0|max:2147483647',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
            'is_featured' => 'sometimes|boolean',
            'is_active'   => 'sometimes|boolean',
        ],[
        'name.required'       => 'El nombre del producto es obligatorio.',
                'name.string'         => 'El nombre del producto debe ser texto.',
                'name.max'            => 'El nombre del producto no puede tener más de 255 caracteres.',
                'description.string'  => 'La descripción debe ser texto válido.',
                'price.required'      => 'El precio del producto es obligatorio.',
                'price.numeric'       => 'El precio debe ser un número.',
                'price.min'           => 'El precio no puede ser negativo.',
                'price.max'           => 'El precio no puede superar los 99.999.999,99.',
                'stock.required'      => 'El stock del producto es obligatorio.',
                'stock.integer'       => 'El stock debe ser un número entero.',
                'stock.min'           => 'El stock no puede ser negativo.',
                'stock.max'           => 'El stock no puede superar los 2.147.483.647.',
                'images.*.image'      => 'Cada archivo debe ser una imagen válida.',
                'images.*.mimes'      => 'Las imágenes deben ser de tipo JPG, JPEG, PNG o WEBP.',
                'images.*.max'        => 'Cada imagen no debe superar los 100MB.',
            ]);

        // Defaults
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        // 1) Crear el producto
        $product = Product::create($validated);

        // 2) Subir y asociar cada imagen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Genera un nombre único
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                // Guarda en storage/app/public/product_images
                $path = $image->storeAs('product_images', $filename, 'public');
                // Registra en la tabla product_images
                $product->images()->create([
                    'filename' => basename($path),
                ]);
            }
        }

        return redirect()
            ->route('admin.products')
            ->with('success', 'Producto creado correctamente con imágenes.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? (bool) $request->is_featured : false;
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : true;

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Producto eliminado correctamente.');
    }
    public function toggleFeatured(Product $product)
    {
        $product->is_featured = !$product->is_featured;
        $product->save();

        return back()->with('success', 'Estado de destacado actualizado.');
    }

    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->is_featured = !$product->is_featured;
        $product->save();

        return back()->with('success', 'Estado de visibilidad actualizado.');
    }

}
