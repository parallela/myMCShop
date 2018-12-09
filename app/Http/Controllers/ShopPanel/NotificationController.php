<?php

namespace App\Http\Controllers\ShopPanel;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Sidebar;
use Illuminate\Http\Request;
use App\Site;

class NotificationController extends Controller
{
    public $site_id;

    /**
     * NotificationController constructor.
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
        $categories = Category::where('parent_id', NULL)->where('site_id', $this->site_id)->get();
        $subcategories = Category::where('parent_id', '!=', NULL)->where('site_id', $this->site_id)->get();
        $notifications = Notification::where('site_id',$this->site_id)->get();

        return view('shop_panel.pages.notification',compact('categories','subcategories','notifications'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate(['title'=>'min:3|required']);

        $notification = new Notification();
        $notification->title = $request->input('title');
        $notification->content = $request->input('notification_content') == null ? 'Empty content' : $request->input('notification_content');
        $notification->category_id = $request->input('category');
        $notification->site_id = $this->site_id;
        $notification->save();

        return response()->json(['Успешно'],201);

    }

    /**
     * @param null $slug
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($slug=null, $id)
    {
        $notification = Notification::where('site_id',$this->site_id)->where('id',$id);
        $notification->delete();

        return response()->json(['Успешно'],200);
    }

    /**
     * @param null $slug
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editTitle($slug=null, Request $request, $id)
    {
        $request->validate(['title'=>'min:3|required']);

        $sidebar = Notification::where('id',$id)->where('site_id',$this->site_id);
        $sidebar->update(['title'=>$request->input('title')]);

        return response()->json(['Успешно'],201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $request->validate(['category'=>'required|integer']);

        $id = $request->input('notification_id');
        $sidebar= Notification::where('id',$id)->where('site_id',$this->site_id);
        $sidebar->update(['content'=>$request->input('new_notification_content'),'category_id'=>$request->input('category')]);

        return response()->json(['Успешно'],201);

    }


}
