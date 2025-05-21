<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Concert;
use App\Models\ConcertRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminConcertController extends Controller
{
    // Mostrar vista principal
    public function index()
    {
        $concerts = Concert::where('date', '>=', now())->orderBy('date')->get()->map(function ($concert) {
            $concert->formatted_date = Carbon::parse($concert->date)->format('d/m/Y H:i');
            return $concert;
        });
        $requests = ConcertRequest::where('status', 'pendiente')
            ->orderBy('date')
            ->get()
            ->map(function ($request) {
                $request->formatted_date = Carbon::parse($request->date)->format('d/m/Y H:i');
                return $request;
            });

        return view('pages.admin.concerts.index', compact('concerts', 'requests'));
    }

    // Mostrar formulario para crear concierto manual
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.concerts.form', compact('categories'));
    }

    // Mostrar formulario para aceptar una solicitud
    public function acceptRequestForm(ConcertRequest $request)
    {
        $categories = Category::all();
        return view('pages.admin.concerts.form', compact('request', 'categories'));
    }

    // Rechazar una solicitud
    public function rejectRequest(ConcertRequest $request)
    {
        $request->update(['rejected_at' => now()]);
        $request->update(['status' => 'rechazada']);
        return redirect()->route('pages.admin.concerts.index')->with('status', 'Solicitud rechazada.');
    }

    // Aceptar una solicitud (redirige al formulario)
    public function acceptRequest(ConcertRequest $request)
    {
        $request->update(['status' => 'aceptada']);
        return redirect()->route('admin.concerts.acceptRequestForm', $request);
    }

    // Guardar concierto (desde solicitud o manual)
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string',
            'with_ticket' => 'nullable|in:on',
            // Validaciones para el producto solo si se quiere añadir ticket
            'name'        => 'required_if:with_ticket,on|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required_if:with_ticket,on|numeric|min:0|max:99999999.99',
            'stock' => 'required_if:with_ticket,on|integer|min:0|max:2147483647',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
        ], [
            // --- Campos del concierto ---
            'title.required'     => 'El título del concierto es obligatorio.',
            'title.string'       => 'El título debe ser un texto válido.',

            'date.required'      => 'La fecha del concierto es obligatoria.',
            'date.date'          => 'La fecha debe tener un formato válido.',

            'location.required'  => 'La ubicación es obligatoria.',
            'location.string'    => 'La ubicación debe ser un texto válido.',

            'with_ticket.in'     => 'El valor de la opción de entrada no es válido.',

            // --- Campos del producto (condicionales si hay entrada) ---
            'name.required_if'   => 'El nombre del producto es obligatorio si se incluye entrada.',
            'name.string'        => 'El nombre del producto debe ser texto.',
            'name.max'           => 'El nombre del producto no puede tener más de 255 caracteres.',

            'description.string' => 'La descripción debe ser un texto válido.',

            'price.required_if'  => 'El precio es obligatorio si se incluye entrada.',
            'price.numeric'      => 'El precio debe ser un número.',
            'price.min'          => 'El precio no puede ser negativo.',
            'price.max'          => 'El precio no puede superar los 99.999.999,99.',

            'stock.required_if'  => 'El stock es obligatorio si se incluye entrada.',
            'stock.integer'      => 'El stock debe ser un número entero.',
            'stock.min'          => 'El stock no puede ser negativo.',
            'stock.max'          => 'El stock no puede superar los 2.147.483.647.',

            'category_id.integer' => 'La categoría debe ser un número válido.',
            'category_id.exists'  => 'La categoría seleccionada no existe.',

            'is_featured.boolean' => 'El campo "destacado" debe ser verdadero o falso.',
            'is_active.boolean'   => 'El campo "activo" debe ser verdadero o falso.',

            'images.*.image'      => 'Cada archivo debe ser una imagen válida.',
            'images.*.mimes'      => 'Las imágenes deben ser de tipo JPG, JPEG, PNG o WEBP.',
            'images.*.max'        => 'Cada imagen no debe superar los 100MB.',
        ]);

        $product = null;

        if ($request->has('with_ticket') && $request->input('with_ticket') === 'on') {
            $validatedProduct = $request->validate([
                'name'        => 'required|string|max:255',
                'description' => 'nullable|string',
                'price'       => 'required|numeric|min:0|max:99999999.99',
                'stock'       => 'required|integer|min:0|max:2147483647',
                'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
            ], [
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

            // Ajustamos booleans (por si no vienen)
            $validatedProduct['is_featured'] = true;
            $validatedProduct['is_active']   = true;
            $validatedProduct['category'] = "Entradas";
            $validatedProduct['category_id'] = 2;



            // Crear producto
            $product = Product::create($validatedProduct);

            // Subir y asociar imágenes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('product_images', $filename, 'public');

                    $product->images()->create([
                        'filename' => basename($path),
                    ]);
                }
            }
        }

        // Crear concierto con relación al producto si existe
        $concert = Concert::create([
            'title'      => $request->input('title'),
            'date'       => new Carbon($request->input('date')),
            'location'   => $request->input('location'),
            'product_id' => $product?->id,
        ]);

        // Actualizar estado de la solicitud si viene
        if ($request->filled('request_id')) {
            ConcertRequest::where('id', $request->input('request_id'))->update([
                'accepted_at' => now(),
            ]);
        }

        return redirect()->route('admin.concerts.index')->with('status', 'Concierto creado correctamente.');
    }

}
