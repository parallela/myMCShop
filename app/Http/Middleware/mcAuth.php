<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class mcAuth
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
        if(!Auth::guard('mcuser')->user()) {
            return redirect()->to(url('/auth/login'));
        }
        return $next($request);
    }
}
