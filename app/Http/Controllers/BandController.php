<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class BandController extends Controller
{
    /**
     * Muestra la página principal de la banda
     */
    public function index()
    {
        $members = Member::all();
        return view('pages.band.index', compact('members'));
    }

    /**
     * Muestra la página de un miembro específico
     */
    public function showMember($id)
    {
        $member = Member::findOrFail($id);
        return view('pages.band.member', compact('member'));
    }

    /**
     * Muestra la página del universo RED FORCE
     */
    public function universe()
    {
        return view('pages.band.universe');
    }

    /**
     * Muestra la página de historia de la banda
     */
    public function history()
    {
        return view('pages.band.history');
    }
}
