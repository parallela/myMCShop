<?php

namespace App\Http\Controllers\Shop;

use App\Category;
use App\Http\Controllers\Controller;
use App\MCUser;
use App\Setting;
use App\Site;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public $theme;
    public $site_id;

    /**
     * CategoryController constructor.
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
     * @param $slug
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($slug=null, Category $category)
    {

        $extras= $category->products()->wherePivot('site_id',$this->site_id)->get()->where('site_id',$this->site_id);
        $notifications = $category->notifications()->where('site_id',$this->site_id)->get();

        $userOrders = Auth::guard('mcuser')->user()->orders()->where('site_id',$this->site_id)->get();

        return view('shop.themes.'.$this->theme.'.pages.products',compact('extras','userOrders','notifications'));

    }
}
