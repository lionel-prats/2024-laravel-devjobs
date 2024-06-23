<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* 
        // formas de acceder al rol del usuario autenticado vvv
        dd(
            auth()->user()->rol,
            $request->user()->rol,
        ); */

        // si el usuario autenticado no es recruiter lo redirijo a home
        if($request->user()->rol !== 2) {
            return redirect()->route("home");
        }

        return $next($request);
    }
}
