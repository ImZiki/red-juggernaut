<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pagado,enviado,en proceso,completado,cancelado,solicitud devolucion,devolucion completada',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return back()->with('success', 'Estado del pedido actualizado.');
    }

    public function approveReturn(Order $order)
    {
        // Lógica para aprobar devolución
        $order->status = 'devolucion completada';
        $order->save();

        return back()->with('success', 'Devolución aprobada.');
    }

    public function rejectReturn(Order $order)
    {
        // Lógica para rechazar devolución, por ejemplo regresar a "completado" o "pagado"
        $order->status = 'completado';
        $order->save();

        return back()->with('success', 'Devolución rechazada.');
    }
}

