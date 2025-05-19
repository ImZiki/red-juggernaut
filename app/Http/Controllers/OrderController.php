<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);

        //$this->authorize('view', $order); // Autorizar ver el pedido

        return view('pages.shop.order', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        //$this->authorize('updateStatus', $order); // Autorizar actualizar estado

        $request->validate([
            'status' => 'required|string|in:pendiente,enviado,completado,cancelado,solicitud_devolucion',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function cancel(Request $request, Order $order)
    {
        //$this->authorize('cancel', $order); // Autorizar cancelar pedido

        // Solo permitir cancelar si no está enviado ni completado
        if (!in_array($order->status, ['pendiente'])) {
            return back()->withErrors('No puedes cancelar este pedido en su estado actual.');
        }

        $order->status = 'cancelado';
        $order->save();

        return back()->with('success', 'Pedido cancelado correctamente.');
    }

    public function requestReturn(Request $request, Order $order)
    {
        //$this->authorize('requestReturn', $order); // Autorizar solicitud de devolución

        if ($order->status !== 'completado') {
            return back()->withErrors('No puedes solicitar devolución en este estado.');
        }

        $order->status = 'solicitud_devolucion';
        $order->save();

        return back()->with('success', 'Solicitud de devolución enviada.');
    }
}
