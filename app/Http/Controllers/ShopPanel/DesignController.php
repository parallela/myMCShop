<?php

namespace App\Http\Controllers\ShopPanel;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Site;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public $site_id;
    public $designs;

    /**
     * HomeController constructor.
     */
    public function __construct(Request $request)
    {
        $designs = [
            'Default' => 'Default',
            'RedDragon' => 'RedDragon',
            'Sky' => 'Sky',
            'Stony' => 'Stony',
        ];

        $site_id = Site::where('slug', $request->route()->parameter('slug'))->first()->id;
        $this->site_id = $site_id;
        $this->designs = $designs;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('shop_panel.pages.design')->with('designs',$this->designs);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate(['design'=>'required']);

        if(array_key_exists($request->input('design'),$this->designs)) {
            Setting::where('site_id',$this->site_id)->where('key','theme')->update([
                'value' => $request->input('design'),
            ]);
            return response()->json(['url'=>'http://'.$request->route()->parameter('slug').'.'.env('PLAIN_URL')],200);
        } else {
            return response()->json(['Няма такава тема в системата'],400);
        }

    }
}
