<?php

namespace App\Http\Middleware;

use App\Site;
use Closure;

class ShopExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $site = Site::where('slug', $request->route()->parameter('slug'))->first();

        if (empty($site)) {
            abort(404);
        } else {
            return $next($request);
        }
    }
}
