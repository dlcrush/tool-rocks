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
        $hasAccess = strpos(url()->current(), 'toolrocks.test/') > -1 || strpos(url()->current(), '/tags') > -1 || $request->input('key') === \Config::get('api.api_key');

        if (! $hasAccess) {
            return response('Unauthenticated.', 401);
        }

        return $next($request);
    }
}
