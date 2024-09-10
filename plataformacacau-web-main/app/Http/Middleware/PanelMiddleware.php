<?php

namespace App\Http\Middleware;

use Closure;

class PanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            (sizeof($request->user()->roles->toArray()) === 1
                && $request->user()->has_role('collector')) ||
            !$request->user()->status
        ) {
            abort(404);
        }

        return $next($request);
    }
}
