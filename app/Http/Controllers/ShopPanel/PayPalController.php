<?php

namespace App\Http\Controllers\ShopPanel;

use App\Setting;
use Illuminate\Http\Request;
use App\Site;
use App\Http\Controllers\Controller;

class PayPalController extends Controller
{
    public $site_id;

    /**
     * PayPalController constructor.
     */
    public function __construct(Request $request)
    {
        $site_id = Site::where('slug', $request->route()->parameter('slug'))->first()->id;
        $this->site_id = $site_id;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('shop_panel.pages.paypal');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate(['clientID'=>'required','secretID'=>'required']);

        Setting::where('key','paypal_client_id')->where('site_id',$this->site_id)->update(['value'=>$request->input('clientID')]);
        Setting::where('key','paypal_secret')->where('site_id',$this->site_id)->update(['value'=>$request->input('secretID')]);

        return response()->json(['Успешно'],201);

    }
}
