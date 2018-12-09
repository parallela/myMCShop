<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{

    /**
     * @param null $slug
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLang($slug=null, $lang)
    {
        session(['locale' => $lang]);
        App::setLocale($lang);

        return redirect()->to('/');
    }
}
