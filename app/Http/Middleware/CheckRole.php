<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\Response;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    use Response;
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->hasRole($role)) {
            return $next($request);
        }

        return $this->successResponse(message: 'Unauthenticated');
    }
}
