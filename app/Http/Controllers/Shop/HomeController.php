<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Site;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $theme;
    public $site_id;

    /**
     * HomeController constructor.
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
    }

    public function page($slug)
    {
        $articles = Site::find($this->site_id)->articles()->get();

        return view('shop.themes.' . $this->theme . '.index', compact('articles'));
    }
}
