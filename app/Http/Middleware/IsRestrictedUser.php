<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsRestrictedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->super_admin || in_array(array(1,2,3),Auth::user()->role))
        {
            return $next($request);
        }
        else
        {
            return $next($request);
        }
    }
}
