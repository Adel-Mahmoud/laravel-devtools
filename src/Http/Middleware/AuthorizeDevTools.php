<?php

namespace Adel\DevTools\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizeDevTools
{
    public function handle(Request $request, Closure $next)
    {
        $config = config('devtools');

        if (!$config['enabled']) {
            abort(404);
        }

        if (!in_array(app()->environment(), $config['allowed_environments'])) {
            abort(403);
        }

        return $next($request);
    }
}
