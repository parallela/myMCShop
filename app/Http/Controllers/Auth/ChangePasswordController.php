<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'new_password_confirm' => 'required|min:4|same:new_password'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


        $current_password = Auth::user()->password;

        if(Hash::check($request->input('old_password'),$current_password)) {
            $user = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return back()->withErrors(['successpwd'=>'Вашата парола е обновена успешно!']);
        } else {
            return back()->withErrors(['Сегашната парола не съвпада!']);
        }



    }
}
