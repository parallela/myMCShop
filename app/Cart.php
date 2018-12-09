<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'user_id', 'site_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(MCUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * @param $HaveAnotherItem
     * @return bool
     */
    public function addItem($HaveAnotherItem, $userId, $productId, $siteId)
    {
        if (!empty($HaveAnotherItem)) {
            self::where('user_id', $userId)->where('site_id', $siteId)->delete();
            $addNewItem = new self([
                'product_id' => $productId,
                'user_id' => $userId,
                'site_id' => $siteId,
            ]);
            $addNewItem->save();

            return true;
        }

        $addNewItem = new self([
            'product_id' => $productId,
            'user_id' => $userId,
            'site_id' => $siteId,
        ]);
        $addNewItem->save();

        return true;

    }

    /**
     * @param $servID
     * @param $code
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function mobio_check($servID, $code)
    {
        $api = file("http://www.mobio.bg/code/checkcode.php?servID=$servID&code=$code");

        $reader = $api;

        if ($api) {
            if (strstr("PAYBG=OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }


    }

    /**
     * @param $servID
     * @param $userID
     * @param $code
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function smspay_check($servID, $userID, $code)
    {
        $api = file("http://rcv.smspay.bg/users/check_code.php?user_id=$userID&service_id=$servID&code=$code");

        $reader = $api;

        if ($api) {
            if (strstr("CODE_OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return response()->json(['error', __('messages.apiError')]);
        }

    }

    /**
     * @param $servID
     * @param $userID
     * @param $code
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function yesspay_check($servID, $code)
    {
        $api = file("http://admin.telebid.org/campaign/check-code?service=$servID&code=$code");

        $reader = $api;

        if ($api) {
            if (strstr("OK", $reader[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function success($product,$user,$siteID)
    {
        $token = new Token();

        $cart = new self();

        $order = new Order([
            'product_id' => $product->id,
            'm_c_user_id' => $user->id,
            'site_id' => $siteID,
        ]);

        $commands = $product->commands()->where('site_id',$siteID)->get();
        $expired_cmds = $product->expiredcmds()->where('site_id',$siteID)->get();
        $cart->where('user_id',$user->id)->where('site_id',$siteID)->delete();

        $cmds_array = [];
        $expired_cmds_array = [];

        foreach($expired_cmds as $ecmd) {
            $replace_nick = str_replace(['{player}'], $user->username, $ecmd->command);
            $replace_date = str_replace(['{date}'], Carbon::now(), $replace_nick);
            $replace_product = str_replace(['{product}'], $product->name, $replace_date);
            $replaced_cmd = $replace_product;
            $expired_cmds_array[] = [
                'token'=>$ecmd->server->token,
                'cmd'=>$replaced_cmd,
                'runned'=>1,
                'expirable'=>1,
                'run_at' => $ecmd->run_at,
            ];
        }
        $token->insert($expired_cmds_array);

        foreach($commands as $cmd) {
            $replace_nick = str_replace(['{player}'], $user->username, $cmd->command);
            $replace_date = str_replace(['{date}'], Carbon::now(), $replace_nick);
            $replace_product = str_replace(['{product}'], $product->name, $replace_date);
            $replaced_cmd = $replace_product;
            $cmds_array[] = ['token' => $cmd->server->token, 'cmd' => $replaced_cmd,'run_at'=>Carbon::now()];
        }

        $order->save();
        $token->insert($cmds_array);
//        $token->insert($expired_cmds_array);
        $user->save();

    }

}
