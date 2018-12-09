<?php

namespace App\Http\Controllers\ShopPanel;

use App\Article;
use App\Setting;
use App\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public $site_id;

    /**
     * HomepageController constructor.
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
        $homepage = Article::where('site_id',$this->site_id)->first();
        return view('shop_panel.pages.homepage',compact('homepage'));
    }

    public function update(Request $request)
    {
        $request->validate(['title'=>'min:4|required']);

        $homepage = Article::where('site_id',$this->site_id);
        $homepage->update(['title'=>$request->input('title'),'content'=>$request->input('content')]);

        return response()->json(['Успешно'],200);
    }

}
