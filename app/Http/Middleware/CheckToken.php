<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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
        if ($request->input('token')!='laravel.com'){
            return redirect()->to('https://www.baidu.com/');
        }

//        echo 'this is handle middleware <br>';
        return $next($request);
    }

    public function terminate($request,$response)
    {
        echo 'this is terminate middleware';
        
    }
}
