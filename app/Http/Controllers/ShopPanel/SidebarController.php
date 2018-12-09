<?php

namespace App\Http\Controllers\ShopPanel;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Sidebar;
use App\Site;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SidebarController extends Controller
{
    public $site_id;

    /**
     * HomeController constructor.
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
        $sidebars = Sidebar::where('site_id', $this->site_id)->orderBy('position', 'asc')->get();

        return view('shop_panel.pages.sidebar', compact('sidebars'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateposition(Request $request)
    {
        $ids = $request->id;

        foreach ($ids as $pos => $id) {
            $sidebar = Sidebar::where('id', $id)->where('site_id', $this->site_id)->update(['position' => $pos]);
        }

        return response()->json(['msg' => 'success'], 201);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'min:4|required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Проблем със създаването!'], 400);
        }

        $sidebar = new Sidebar();

        $lastSidebarPosition = $sidebar->all()->last()->position;

        $sidebar->name = $request->input('title');
        $sidebar->content = $request->input('content');
        $sidebar->site_id = $this->site_id;
        $sidebar->type = "custom";
        $sidebar->position = $lastSidebarPosition + 1;
        $sidebar->save();

        return response()->json(['Успешно'], 201);


    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($slug = null, $id)
    {
        $sidebar = Sidebar::where('id', $id)->where('site_id', $this->site_id)->where('type', 'custom');
        if (count($sidebar->get()) < 1) {
            return response()->json(['Менюто е статично'], 400);
        } else {
            $sidebar->delete();
        }

        return response()->json(['Успешно'], 200);
    }

    /**
     * @param null $slug
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatetitle($slug = null, $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'min:4|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Проблем със променянето!'], 400);
        }

        Sidebar::where('id', $id)->where('site_id', $this->site_id)->update([
            'name' => $request->input('title'),
        ]);

        return response()->json(['Успешно'], 201);
    }

    /**
     * @param null $slug
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatecontent($slug = null, $id, Request $request)
    {

        Sidebar::where('id', $id)->where('site_id', $this->site_id)->update([
            'content' => $request->input('content'),
        ]);

        return response()->json(['Успешно'], 201);
    }

    public function hidesidebar($slug = null, $id)
    {
        $sidebar = Sidebar::where('id', $id)->where('site_id', $this->site_id)->first();
        $updator = Sidebar::where('id', $id)->where('site_id', $this->site_id);

        if ($sidebar->show == 1) {
            $updator->update([
                'show' => 0,
            ]);
            return response()->json(0, 200);
        } else {
            $updator->update([
                'show' => 1,
            ]);
            return response()->json(1,200);
        }

    }

    public function static_sidebar_content(Request $request)
    {
        if($request->for == "log_amount") {
            $request->validate(['show_l_a'=>'integer']);

            Setting::where('site_id',$this->site_id)->where('key','show_log_amount')->update(['value'=>$request->input('show_l_a')]);

            return response()->json(['Успешно'],201);
        }

        if($request->for == "donations") {
            $request->validate(['donation_amount'=>'integer']);

            Setting::where('site_id',$this->site_id)->where('key','donation_goal_text')->update(['value'=>$request->input('donation_text')]);
            Setting::where('site_id',$this->site_id)->where('key','donation_goal')->update(['value'=>$request->input('donation_amount')]);
            return response()->json(['Успешно'],201);
        }

        if($request->for == "logo") {
            $request->validate(['logo'=>'min:3']);

            Setting::where('site_id',$this->site_id)->where('key','logo')->update(['value'=>$request->input('logo')]);

            return response()->json(['img'=>$request->input('logo')],201);
        }

    }


}
