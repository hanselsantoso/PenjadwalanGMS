<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
            case 0:
               return redirect('/admin/index');
               break;
            case 1:
               return redirect('/user/index');
               break;

            default:
               return redirect('/home');
               break;
          }
        }
        return $next($request);
      }

    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;
    //     if (Auth::guard($guards)->check()) {
    //         $role = Auth::user()->role;

    //         switch ($role) {
    //           case 'admin':
    //              return redirect('/admin_index');
    //              break;
    //           case 'seller':
    //              return redirect('/user_index');
    //              break;

    //           default:
    //              return redirect('/home');
    //              break;
    //         }
    //       }
    //       return $next($request);
    // }
}
