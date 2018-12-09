<?php

namespace App\Http\Controllers\ShopPanel;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;

class CategoryController extends Controller
{
    public $site_id;

    /**
     * CategoryController constructor.
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
        $categories = Category::where('site_id',$this->site_id)->get();

        return view('shop_panel.pages.categories',compact('categories'));
    }


    public function create(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'icon' => 'required',
        ]);

        dd($request->all());
    }
}
