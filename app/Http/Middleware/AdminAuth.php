<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        // TODO: actually implement the hasAccess check
        $hasAccess = true;

        if (! $hasAccess) {
            return redirect('/');
        }

        return $next($request);
    }
}
