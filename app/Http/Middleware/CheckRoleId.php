<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRoleId
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if the role_id from the URL matches the authenticated user's role_id
        if ($request->route('role_id') != $user->role_id) {
            return redirect()->route('dashboard'); // Redirect to a safe page
        }

        return $next($request);
    }
}
