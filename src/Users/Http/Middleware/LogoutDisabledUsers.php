<?php

namespace Myrtle\Core\Users\Http\Middleware;

use Closure;

class LogoutDisabledUsers
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
        if(auth()->user()->disabled_at)
        {
            auth()->logout();
        }

        return $next($request);
    }
}
