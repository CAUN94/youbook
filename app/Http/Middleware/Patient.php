<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Patient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role->name=="paciente" or Auth::user()->role->name == 'administrador' or Auth::user()->role->name == 'profesional'){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
