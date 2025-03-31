<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\ConcertRequest;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /**
     * Muestra la lista de conciertos próximos
     */
    public function index()
    {
        $upcomingConcerts = Concert::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        $pastConcerts = Concert::where('date', '<', now())
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('pages.concerts.index', compact('upcomingConcerts', 'pastConcerts'));
    }

    /**
     * Muestra la página de un concierto específico
     */
    public function show($id)
    {
        $concert = Concert::findOrFail($id);
        return view('pages.concerts.show', compact('concert'));
    }

    /**
     * Muestra el formulario para solicitar un concierto
     */
    public function requestForm()
    {
        return view('pages.concerts.request');
    }

    /**
     * Procesa la solicitud de concierto
     */
    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'local' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'fecha' => 'required|date|after:today',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'detalles' => 'nullable|string',
        ]);

        ConcertRequest::create($validated);

        return redirect()->route('concerts.index')
            ->with('success', 'Tu solicitud de concierto ha sido recibida. Nos pondremos en contacto contigo pronto.');
    }
}
