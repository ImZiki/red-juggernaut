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
        return $user->id === $order->user_id && $order->status === 'pagado';
    }

    public function requestReturn(User $user, Order $order)
    {
        return $user->id === $order->user_id && $order->status === 'completado';
    }
}
