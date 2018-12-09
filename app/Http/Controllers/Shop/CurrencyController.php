<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function change($slug=null,$currency)
    {
        session()->put('currency',$currency);
        return redirect()->to('/');
    }

}
