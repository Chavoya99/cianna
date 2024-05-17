<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userType = Auth::user()->tipo;
        if($userType != 'A'){
           if($userType == 'admin'){
                return redirect(route('homeAdmin'));
           }else if($userType == 'B'){
                return redirect(route('homeB'));
           }
        }
        return $next($request);
    }
}
