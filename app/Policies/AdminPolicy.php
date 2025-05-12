<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    public function accessAdminPanel(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin';
    }
}
