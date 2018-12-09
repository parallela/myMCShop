<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        $plans = Plan::all();

        return view('index', compact('sites','plans'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gdpr(Request $request)
    {
        if ($request->has('accepted')) {
            Session::put('gdpr', 'accepted');
            return response()->json(['accepted'], 201);
        }
        return response()->json(['problem'], 400);
    }
}
