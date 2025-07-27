<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //admin role = 0
        //user role = 1
        if (Auth::check()) {
            switch (Auth::user()->role) {
                case "0":
                    return $next($request);
                case "1":
                    return $next($request);
                case "2":
                    return $next($request);
                case "3":
                    return $next($request);

                default: 
                    return redirect('/')->with('message','Access Denied!, Your are not an admin');
            }
        } else{
            return redirect('/login')->with('message','Login to access');
        }
    }
}
