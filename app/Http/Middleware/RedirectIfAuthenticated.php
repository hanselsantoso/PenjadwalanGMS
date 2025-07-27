<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
          $role = Auth::user()->role;
          switch ($role) {
            // case 0:
            //    return redirect('/admin');
            // case 1:
            //    return redirect('/volunteer');

            default:
               return redirect('/');
          }
        }
        return $next($request);
      }
}
