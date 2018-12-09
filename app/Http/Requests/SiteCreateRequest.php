<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class SiteCreateRequest extends FormRequest
{
    protected $redirectRoute = 'purchaseFailed';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|regex:/^[a-zA-Z]+$/u||unique:sites|min:4|max:32',
            'p_id' => 'required|integer'
        ];
    }


}
