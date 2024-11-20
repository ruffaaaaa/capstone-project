<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestTimeoutMiddleware
{
    public function handle($request, Closure $next)
    {
        // Register a shutdown function to catch timeouts
        register_shutdown_function(function () {
            if (connection_aborted()) {
                abort(408, 'Request Timeout');
            }
        });

        return $next($request);
    }
}