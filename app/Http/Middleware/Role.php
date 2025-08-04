<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, ...$roles) {
    if (!Auth::check())
      return redirect('/');
    
    $userRole = Auth::user()->role;
    if (!in_array((string) $userRole, $roles)) {
      return redirect('/');
    }

    return $next($request);
  }
}
