<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $role_id = $request->route('role_id'); // Get role_id from the URL
        $user = auth()->user();

        // Check if the authenticated user's role_id matches the one in the URL and is within allowed roles
        if (auth()->check() && in_array($user->role_id, $roles) && $user->role_id == $role_id) {
            return $next($request);
        }

        // If the check fails, you can redirect or throw an unauthorized error
        abort(403, 'Unauthorized access');
    }

}
