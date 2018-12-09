<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isSiteBelongsToUser
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

        $site_slug = $request->route()->parameter('slug');
        $userSites = Auth::user()->sites();

        $check = $userSites->where('slug',$site_slug)->first();

        if(count($check) < 1) {
            abort(404);
        }

        return $next($request);
    }
}
