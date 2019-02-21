<?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleWare
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
        $request = $next($request);
        return $next($request);
    }
}
