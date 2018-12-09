<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;
use App\Site;
use Illuminate\Support\Facades\Auth;

class isPurchased
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
        $site = Site::where('slug',$request->route()->parameter('slug'))->first();

        $userOrders =  Auth::guard('mcuser')->user()->orders()->where('site_id',$site->id)->get();
        $product = Product::where('id',$request->input('product_id'))->where('site_id',$site->id)->first();

        if($userOrders->contains('product_id',$request->input('product_id')) && $product->max_buys == 1) {
            return redirect()->to('/');
        }



        return $next($request);
    }
}
