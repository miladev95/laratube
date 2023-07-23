<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrSuperAdminRole
{
    use Response;

    /**
     * Check user has admin or super admin role
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && ($user->hasRole('admin') || $user->hasRole('super_admin'))) {
            return $next($request);
        }

        return $this->successResponse(message: 'xx');
    }
}
