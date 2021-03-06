<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginAD
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
        if(Auth::check())
        {
         $user = Auth::user();
            return $next($request);
        }
        else
        {
            return redirect(route('get.login'));
        }
    }
}
