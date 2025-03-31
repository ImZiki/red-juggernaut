<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Constructor para asegurar que solo usuarios autenticados accedan
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la página del perfil del usuario
     */
    public function show()
    {
        $user = auth()->user();
        return view('pages.user.profile', compact('user'));
    }

    /**
     * Muestra el formulario para editar el perfil
     */
    public function edit()
    {
        $user = auth()->user();
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Actualiza la información del perfil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('profile.dashboard')
            ->with('success', 'Tu perfil ha sido actualizado.');
    }

    /**
     * Muestra el historial de compras del usuario
     */
    public function orders()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('profile.orderhistory', compact('orders'));
    }
}
