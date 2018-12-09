<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = ['servID', 'userID', 'number', 'text'];
    public $timestamps = false;


    /**
     * @param $servID
     * @param $code
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function mobio_check($servID, $code)
    {
        $api_uri = file("http://www.mobio.bg/code/checkcode.php?servID=$servID&code=$code");

        $reader = $api_uri;

        if ($api_uri) {
            if (strstr("PAYBG=OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return redirect()->to(route('mcCheckoutFailed'))->withErrors(['codeError' => __('messages.apiError')]);
        }

        return false;
    }

    /**
     * @param $servID
     * @param $code
     * @param $userID
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function smspay_check($servID, $code, $userID)
    {
        $api_uri = file("http://rcv.smspay.bg/users/check_code.php?user_id=$userID&service_id=$servID&code=$code");

        $reader = $api_uri;

        if ($api_uri) {
            if (strstr("CODE_OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return redirect()->to(route('mcCheckoutFailed'))->withErrors(['codeError' => __('messages.apiError')]);
        }

        return false;
    }

    public function yesspay_check($servID, $code)
    {
        $api_uri = file("http://admin.telebid.org/campaign/check-code?service=$servID&code=$code");

        $reader = $api_uri;

        if ($api_uri) {
            if (strstr("OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return redirect()->to(route('mcCheckoutFailed'))->withErrors(['codeError' => __('messages.apiError')]);
        }

        return false;

    }

    /**
     * @param $price
     * @return string
     */
    public function smsX($price)
    {
        $smsX = '';

        if ($price <= 6) {
            $smsX = '';
        } else if ($price == 9.6 || $price == 12) {
            $smsX = '2x';
        } else if ($price == 18) {
            $smsX = '3x';
        } else if ($price == 24) {
            $smsX = '4x';
        }

        return $smsX;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
