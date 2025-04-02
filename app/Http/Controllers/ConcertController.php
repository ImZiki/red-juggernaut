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
        return view('pages.comms.index');
    }
}
