<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Plan;
use Auth;
use App\Site;
use Illuminate\Http\Request;

class UpgradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Auth::user()->sites()->get();

        return view('panel.pages.upgrade', compact('sites'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function show(Request $request)
    {

        $request->validate(['site_id'=>'required|integer']);

        $highest_plan_name = "DIAMOND";

        $site = Site::find($request->input('site_id'));
        $plans = Plan::where('name','!=',$site->plan->name)->where('name','!=','IRON')->get();
        return view('panel.pages.site_upgrade',compact('site','highest_plan_name','plans'));

    }

}
