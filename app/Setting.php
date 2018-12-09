<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'site_id'];
    public $timestamps = false;

    /**
     * @param $site_id
     */
    public function siteSettingSeed($site_id)
    {
        self::insert([
            [
                'key'  => 'logo',
                'value' => 'https://i.imgur.com/RPy5k.png',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'title',
                'value' => 'SERVERNAME',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'background',
                'value' => 'https://i.ytimg.com/vi/Rkydse1LVX0/maxresdefault.jpg',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'sms_pay_method',
                'value' => 'mobio',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'show_log_amount',
                'value' => '3',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'server_status',
                'value' => 'play.server.eu:25565',
                'site_id' => $site_id,
            ],
            [
                'key'  => 'donation_goal',
                'value' => '100',
                'site_id' => $site_id,
            ],
            [
                'key' => 'donation_goal_text',
                'value' => 'Трябват ни 100 лева за да подържаме сървъра',
                'site_id' => $site_id,
            ],
            [
                'key' => 'theme',
                'value' => 'Default',
                'site_id' => $site_id,
            ],
            [
                'key' => 'paypal_client_id',
                'value' => 'paypal_client_token',
                'site_id' => $site_id,
            ],
            [
                'key' => 'paypal_secret',
                'value' => 'paypal_secret_token',
                'site_id' => $site_id,
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'Minecraft store, your servername, mainkraft, moqt_server,server,store, buycraft_store,minecraft.net,server',
                'site_id' => $site_id,
            ]
        ]);
    }

}
