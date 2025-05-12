<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\ConcertRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /**
     * Muestra la lista de conciertos próximos
     */
    public function index()
    {
        return view('pages.comms.index');
    }
    public function request(){
        return view('pages.comms.request');
    }

    public function getConcerts()
    {
        // Filtra conciertos con fecha posterior a hoy
        $concerts = Concert::where('date', '>=', Carbon::now())->get()->map(function ($concert) {
            return [
                'title' => $concert->title,
                'start' => $concert->date,
                'url' => $concert->product_id ? route('product.show', ['id' => $concert->product_id]) : $concert->ticket_url,
                'location' =>$concert->location,
            ];
        });
        return response()->json($concerts);
    }

    public function handleRequestForm(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'request_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'nullable|string|max:500',
        ]);
        // Crear la solicitud de concierto en la base de datos
        ConcertRequest::create($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('comms')->with('success', '¡Gracias por tu solicitud! Nos pondremos en contacto contigo pronto.');
    }

}
