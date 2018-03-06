<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        switch($guard){
            case 'appuser':

            if (Auth::guard($guard)->check()) {
                return redirect('user/home');
            }
            break;
            case 'superadmin':
            if (Auth::guard($guard)->check()) {
                return redirect('superadmin/home');
            }
            
            break;
            default:
            if (Auth::guard($guard)->check()) {
                return redirect('user/home');
            }
            break;
        } 


        return $next($request);
    }
}
