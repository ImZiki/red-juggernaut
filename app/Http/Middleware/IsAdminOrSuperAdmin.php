<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminOrSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->isAdmin() || $user->isSuperAdmin())) {
            return $next($request);
        }

        abort(403, 'Acceso denegado.');
    }
}
