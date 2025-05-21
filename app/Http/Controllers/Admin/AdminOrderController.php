<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('pages.admin.orders.index', compact('orders'));
    }

    // Ver detalles de un pedido
    public function show(Order $order)
    {
        $order->load('user', 'items.product'); // Asumiendo que tienes relación items → product
        return view('pages.admin.orders.show', compact('order'));
    }

    // Cambiar el estado de un pedido
    public function updateStatus(Order $order)
    {
        // Validar (opcional pero recomendado)
       request()->validate([
               'status' => [
                   'required',
                   'string',
                   'in:pendiente,completado,cancelado,pagado,devolucion aceptada,devolucion rechazada'
               ],
           ]);


        $order->status = request()->status;
        $order->save();

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }

}

