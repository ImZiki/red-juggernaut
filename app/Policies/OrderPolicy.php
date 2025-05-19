<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determina si el usuario puede actualizar el estado de un pedido (solo admin).
     */
    public function updateStatus(User $user, Order $order)
    {
        // Aquí defines la lógica para admin, por ejemplo, asumiendo que tienes rol
        return $user->role === 'admin';
    }

    /**
     * Determina si el usuario puede cancelar su pedido.
     */
    public function cancel(User $user, Order $order)
    {
        // Solo puede cancelar si es dueño y el estado es 'pendiente'
        return $user->id === $order->user_id && $order->status === 'pendiente';
    }

    /**
     * Determina si el usuario puede solicitar devolución.
     */
    public function requestReturn(User $user, Order $order)
    {
        // Solo dueño y si el pedido está completado
        return $user->id === $order->user_id && $order->status === 'completado';
    }
}
