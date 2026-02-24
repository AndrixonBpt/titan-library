<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- Importante

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // VERIFICACIÓN: Si NO está logueado O NO es bibliotecario...
        if (!Auth::check() || Auth::user()->role !== 'bibliotecario') {
            
            // ...lo expulsamos con un error 403.
            abort(403, 'ACCESO DENEGADO: NIVEL DE AUTORIZACIÓN INSUFICIENTE.');
        }

        return $next($request);
    }
}
