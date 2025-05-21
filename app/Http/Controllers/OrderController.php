<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use AuthorizesRequests;
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
            'status' => 'required|string|in:pendiente,enviado,completado,cancelado,solicitud devolucion',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $this->authorize('cancel', $order);

        if (!in_array($order->status, ['pagado'])) {
            return back()->withErrors('No puedes cancelar este pedido en su estado actual.');
        }

        $order->status = 'cancelado';
        $order->save();

        return back()->with('success', 'Pedido cancelado correctamente.');
    }

    public function requestReturn(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $this->authorize('requestReturn', $order);

        if ($order->status !== 'completado') {
            return back()->withErrors('No puedes solicitar devolución en este estado.');
        }

        $order->status = 'solicitud devolucion';
        $order->save();

        return back()->with('success', 'Solicitud de devolución enviada.');
    }



}
