<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // just dump something and proceed
        logger('TestAdminMiddleware is called');
        return $next($request);
    }
}
