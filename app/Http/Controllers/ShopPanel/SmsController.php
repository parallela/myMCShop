<?php

namespace App\Http\Controllers\ShopPanel;

use App\Http\Controllers\Controller;
use App\Product;
use App\Setting;
use App\Sms;
use App\Site;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public $site_id;
    public $sms_methods;
    public $prices;

    /**
     * SmsController constructor.
     */
    public function __construct(Request $request)
    {
        $sms_methods = ['smspay' => 'SMSPAY', 'mobio' => 'Mobio', 'yesspay' => 'YessPay'];
        $prices = ['1.20' => '1.20 BGN (Лв.)', '2.40' => '2.40 BGN (Лв.)', '4.80' => '4.80 BGN (Лв.)', '6.00' => '6.00 BGN (Лв.)', '9.60' => '9.60 BGN (Лв.)', '12.00' => '12.00 BGN (Лв.)', '18.00' => '18.00 BGN (Лв.)', '24.00' => '24.00 BGN (Лв.)',];
        $site_id = Site::where('slug', $request->route()->parameter('slug'))->first()->id;
        $this->site_id = $site_id;
        $this->sms_methods = $sms_methods;
        $this->prices = $prices;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sms_records = Sms::where('site_id',$this->site_id)->get();
        return view('shop_panel.pages.sms')
            ->with([
                'sms_methods' => $this->sms_methods,
                'prices' => $this->prices,
                'sms_records'=>$sms_records
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if (array_key_exists($request->input('method'),$this->sms_methods)) {
            Setting::where('key', 'sms_pay_method')->where('site_id',$this->site_id)->update(['value' => $request->input('method')]);

            return response()->json(['Успешно'], 201);
        } else {
            return response()->json(['Няма такава цена в базата данни'],400);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_sms(Request $request)
    {

        if($request->action == "delete"){
            $sms = Sms::where('site_id',$this->site_id)->where('id',$request->input('id'));
            Product::where('sms_id',$sms->first()->id)->where('site_id',$this->site_id)->update(['sms_id'=>0]);
            $sms->delete();

            return response()->json(['delete'=>1],200);
        }
        if($request->action == "edit"){
            $sms = Sms::where('site_id',$this->site_id)->where('id',$request->input('id'));
            $sms->update([
                'servID'=>$request->input('servID'),
                'userID'=>$request->input('userID'),
                'number'=>$request->input('number'),
                'text'=>$request->input('text'),
            ]);

            return response()->json(['Успешно'],201);
        }
    }

    public function create(Request $request)
    {
        $sms = new Sms();
        $sms->servID = $request->input('servID');
        $sms->userID = $request->input('userID');
        $sms->number = $request->input('number');
        $sms->site_id = $this->site_id;
        $sms->text = $request->input('text');

        $sms->save();

        return response()->json(['Успешно'],201);
    }
}
