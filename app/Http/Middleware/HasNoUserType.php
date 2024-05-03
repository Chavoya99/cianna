<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasNoUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()->tipo == 'admin'){
            return redirect(RouteServiceProvider::HOME);
        }else{
            if(Auth::user()->tipo == 'A'){
                return redirect('/dashA');
            }else if(Auth::user()->tipo == 'B'){
                return redirect('/dashB');
            }
        }

        return $next($request);
    }
}
