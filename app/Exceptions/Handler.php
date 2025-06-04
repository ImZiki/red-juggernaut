<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    // Lista de excepciones que no se reportan
    protected $dontReport = [
        //
    ];

    // Registra callbacks para reportar excepciones
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        // Error 404 - Página no encontrada
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Error 403 - Sin permiso
        if ($exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.403', [], 403);
        }

        // Error 419 - Página expiró (CSRF token mismatch)
        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        // Error 500 - Error de base de datos u otros errores internos
        if ($exception instanceof QueryException) {
            return response()->view('errors.500', ['exception' => $exception], 500);
        }

        // Easter egg 418 - I'm a teapot (ejemplo muy raro)
        if ($exception instanceof HttpException && $exception->getStatusCode() === 418) {
            return response()->view('errors.418', [], 418);
        }

        // Si es HttpException (otros códigos), mostrar la vista con su código o fallback a 500
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            if (view()->exists("errors.$statusCode")) {
                return response()->view("errors.$statusCode", [], $statusCode);
            }
            return response()->view('errors.500', ['exception' => $exception], 500);
        }

        // Por defecto, para cualquier otra excepción, mostrar error 500
        return response()->view('errors.500', ['exception' => $exception], 500);
    }
}
