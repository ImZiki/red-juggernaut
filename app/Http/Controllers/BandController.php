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
        //$members = Operative::all();
        return view('pages.racf.racf', /*compact('members')*/);
    }

    /**
     * Muestra la página de un miembro específico
     */
    public function showMember($id)
    {
        $member = Operative::findOrFail($id);
        return view('pages.racf.operatives.'.$member->codename, compact('member'));
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
