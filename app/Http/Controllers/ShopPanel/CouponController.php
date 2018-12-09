<?php

namespace App\Http\Controllers\ShopPanel;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\MCUser;
use App\Site;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public $site_id;
    public $site;

    /**
     * CouponController constructor.
     */
    public function __construct(Request $request)
    {
        $site = Site::where('slug', $request->route()->parameter('slug'))->first();
        if($site->plan->giftcards == 0) {
            abort(404);
        }
        $this->site = $site;
        $this->site_id = $site->id;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $coupons = Coupon::where('site_id', $this->site_id)->get();
        return view('shop_panel.pages.coupons', compact('coupons'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        if ($request->action == "edit") {
            $request->validate(['budget' => 'integer']);
            $user = MCUser::firstOrCreate(
                ['username' => $request->input('user'), 'site_id' => $this->site_id]
            );

            $coupons = Coupon::where('id', $request->input('id'))->where('site_id', $this->site_id);
            $coupons->update([
                'code' => $request->input('code'),
                'user_id' => $user->id,
                'budget' => $request->input('budget'),
            ]);

            return response()->json(['Успешно'], 201);
        }

        if ($request->action == "delete") {

            $coupon = Coupon::where('id', $request->input('id'))->where('site_id', $this->site_id);
            $coupon->delete();

            return response()->json(['Успешно'],200);

        }

    }

    public function create(Request $request)
    {
        $request->validate(['budget'=>'integer']);
        $user = MCUser::firstOrCreate(
            ['username' => $request->input('user'), 'site_id' => $this->site_id]
        );
        $coupon = new Coupon();

        $coupon->code = substr($this->site->slug,0,3).'-'.str_random(4,6).'-'.substr(time(),4,4);
        $coupon->user_id = $user->id;
        $coupon->site_id = $this->site_id;
        $coupon->budget = $request->input('budget');

        $coupon->save();

        return response()->json(['Успешно'],201);
    }
}
