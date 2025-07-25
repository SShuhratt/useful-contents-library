<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin') && !auth()->user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}

