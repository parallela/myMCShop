<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public $theme;
    public $site_id;
    private $site;

    /**
     * CouponController constructor.
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
        $this->site = $site;
        $this->middleware('mcAuth');
    }

    /**
     * @param Request $request
     */
    public function check(Request $request)
    {
        if ($this->site->plan->giftcards != 0) {
            $coupon = $request->input('coupon');

            if (strlen($coupon) == 0) {
                return response()->json([__('messages.nopromo')], 400);
            }

            $check_if_exist = Auth::guard('mcuser')->user()->coupons()->where('site_id', $this->site_id)->where('code', $coupon)->first();

            if (count($check_if_exist) > 0) {
                $budget = session()->get('currency') == "EUR" ? floor($check_if_exist->budget / 1.95) : $check_if_exist->budget;
                $currency = session()->has('currency') ? session()->get('currency') : 'BGN';
                session()->put('coupon', true);
                session()->put('couponID', $check_if_exist->id);

                return response()->json([
                    'dataBag' => $check_if_exist,
                    'msg' => __('messages.promook', ['coupon' => $check_if_exist->code]),
                    'budget' => __('messages.promobudget', ['budget' => round($budget), 'currency' => $currency]),
                ], 200);
            }

            return response()->json([__('messages.nopromovalid')], 400);

        } else {
            return response()->json(['Coupon not allowed',400]);
        }
    }
}
