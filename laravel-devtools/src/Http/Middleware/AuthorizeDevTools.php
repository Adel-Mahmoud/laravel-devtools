<?php

namespace Adel\DevTools\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizeDevTools
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('devtools.enabled')) {
            abort(404);
        }

        if (!in_array(app()->environment(), config('devtools.allowed_environments', []))) {
            abort(403);
        }

        return $next($request);
    }
}
