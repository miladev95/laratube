<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    use Response;
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            return $next($request);
        }

        return $this->errorResponse(message: 'Unauthorized',code: 401);
    }
}
