<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()){
            if(auth()->user()->role === 'admin'){
                return $next($request);
            } else {
                return redirect()
                    ->route('home')
                    ->with('message','Usted no tiene los permisos para ingresar a esta sección')
                    ->with('message_type','bg-red-300 text-red-800');
            }
        }
        return redirect()
            ->route('auth.loginForm')
            ->with('message','No tiene permisos, para ingresar a ese enlace')
            ->with('message_type','bg-violet-600 text-white');
    }
}
