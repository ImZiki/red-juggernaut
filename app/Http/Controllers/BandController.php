<?php

namespace App\Http\Controllers;

use App\Models\Operative;
use Illuminate\Http\Request;

class BandController extends Controller
{
    /**
     * Muestra la página principal de la banda
     */
    public function index()
    {

        return view('pages.racf.racf');
    }

    /**
     * Muestra la página de un miembro específico
     */
    public function showMember($codename)
    {
        $viewNames = [
            'dr-owl' => 'drowl',
            'red-juggernaut' => 'redjugg',
            'wild-child' => 'wildchild',
            'captain-eagle' => 'cpteagle',
        ];

        $viewName = $viewNames[$codename] ?? null;

        if (!$viewName) {
            abort(404, 'Miembro no encontrado');
        }

        return view('pages.racf.operatives.'.$viewName);
    }

    /**
     * Muestra la página de biografia real de la banda
     */
    public function bio()
    {
        return view('pages.bio');
    }

    /**
     * Muestra la pagina de competencias de la banda
     */
    public function skills()
    {
        return view('pages.skills');
    }
}
