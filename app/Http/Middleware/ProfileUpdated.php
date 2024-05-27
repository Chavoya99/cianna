<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileUpdated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user()->profile_update){
            if(Auth::user()->tipo == 'A'){
                return redirect('/formularioRegistroA');
            }else if(Auth::user()->tipo == 'B'){
                return redirect('/formularioRegistroB');
            }
        }
        
        return $next($request);
    }
}
