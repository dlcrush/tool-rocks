<?php

namespace App\Http\Middleware;

use Closure;

class APIAuth
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
        $hasAccess = strpos(url()->current(), 'toolrocks.test') > -1
            || strpos(url()->current(), 'toolrocks.com') > -1
            || strpos(url()->current(), 'stage.toolrocks.com') > -1;

        if (! $hasAccess) {
            return response('Unauthenticated.', 401);
        }

        return $next($request);
    }
}
