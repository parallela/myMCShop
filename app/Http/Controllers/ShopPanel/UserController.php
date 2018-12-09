<?php

namespace App\Http\Controllers\ShopPanel;

use App\MCUser;
use App\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public $site_id;

    /**
     * UserController constructor.
     */
    public function __construct(Request $request)
    {
        $site_id = Site::where('slug', $request->route()->parameter('slug'))->first()->id;
        $this->site_id = $site_id;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function json()
    {
        $users = MCUser::where('site_id',$this->site_id)->get();
        $results = [];

        foreach($users as $user) {
            $results[] = $user->username;
        }
        return response()->json($results);
    }
}
