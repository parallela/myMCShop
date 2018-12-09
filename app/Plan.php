<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'servers', 'products', 'categories', 'giftcards', 'paypal', 'sms', 'upgrades', 'show_brand', 'commands'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->hasMany(Site::class);
    }
}
