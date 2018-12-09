<?php

namespace App\Http\Controllers\Panel;

use Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $userSites = Auth::user()->sites()->get();

        return view('panel.index',compact('userSites'));
    }
}
