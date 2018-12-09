<?php

namespace App\Http\Controllers\Shop;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Setting;
use App\Site;
use App\Sms;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $theme;
    public $site_id;

    /**
     * CartController constructor.
     */
    public function __construct(Request $request)
    {
        $site = Site::where('slug', $request->route()->parameter('slug'))->first();
        if (empty($site)) {
            abort(404);
        }

        $site_id = $site->id;

        $theme = Setting::where('key', 'theme')->where('site_id', $site_id)->first()->value;

        $this->theme = $theme;
        $this->site_id = $site_id;
        $this->middleware('mcAuth');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        session()->remove('coupon');
        session()->remove('couponID');
        $cart = new Cart();
        $sms = new Sms();

        // ids
        $userId = Auth::guard('mcuser')->user()->id;
        $product = Product::where('id', $request->input('product_id'))->where('site_id', $this->site_id)->first();
        if ($product->paypal_only != 1) {
            $smsText = $product->sms->text;
            $smsNumber = $product->sms->number;
        }
        $haveItem = $cart->where('user_id', $userId)->where('site_id', $this->site_id)->first();
        $smsX = $sms->smsX($product->price);

        $cart->addItem($haveItem, $userId, $product->id, $this->site_id);

        return view('shop.themes.' . $this->theme . '.pages.cart', compact('product', 'smsX', 'smsText', 'smsNumber'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        Cart::where('product_id', $request->input('product_id'))->where('site_id', $this->site_id)->delete();
        return redirect('/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function failed()
    {
        return view('shop.themes.' . $this->theme . '.pages.cart_status');
    }

}
