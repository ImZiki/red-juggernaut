<?php
//TODO preparar el middleware para poder identificar si los usuarios son admin o no.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }
}
