<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConcertRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::select('name', 'email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener los pedidos de los últimos 30 días
        $orders = Order::with('user:id,name')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->get(['user_id', 'created_at', 'status']);

        // Obtener todas las solicitudes de conciertos
        $concertRequests = ConcertRequest::select('email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.admincp', compact('users', 'orders', 'concertRequests'));
    }
}
