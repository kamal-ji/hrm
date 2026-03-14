<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleOrSuperAdmin
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        if ($user && ($user->is_superadmin || $user->hasRole($role))) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}