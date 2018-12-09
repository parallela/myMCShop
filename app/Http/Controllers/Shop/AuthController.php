<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreate;
use App\MCUser;
use App\Setting;
use App\Site;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
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
    }

    /**
     * @param $user
     */
    private function login($user)
    {
        Auth::guard('mcuser')->login($user);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($slug = null)
    {
        return view('shop.themes.' . $this->theme . '.pages.login');
    }

    /**
     * @param UserCreate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create($slug = null, UserCreate $request)
    {

        $createUser = MCUser::firstOrCreate(
            ['username' => $request->input('username'), 'site_id' => $this->site_id]
        );

        $this->login($createUser);

        return redirect()->to('/');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
