<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticated
{
    use Response;

    /**
     * Check is user authenticated
     */
    public function handle($request, Closure $next)
    {
        if (! $request->expectsJson()) {
            // For non-JSON requests, let the default behavior handle it
            return Auth::check() ? $next($request) : $this->errorResponse('Unauthenticated',401);
        }

        return $this->errorResponse('Unauthenticated',401);

    }
}
