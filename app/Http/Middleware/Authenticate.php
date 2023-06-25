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
        if (! $request->expectsJson()) {
            if ($request->is('login') || $request->is('register')) {
                return route('login'); // Redirect to the login route for login and registration pages
            } else {
                return route('home'); // Redirect to a different route (e.g., home) for other non-authenticated routes
            }
        }
    }
}
