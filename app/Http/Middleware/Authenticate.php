<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // kalau bukan request API / JSON
        if (! $request->expectsJson()) {

            // redirect ke halaman login + kirim pesan error
            return route('login');
        }

        return null;
    }
}