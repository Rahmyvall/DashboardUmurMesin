<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // kalau sudah login → redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}