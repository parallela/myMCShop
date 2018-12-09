<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'recommended', 'image', 'required_product_id', 'max_buys', 'discount', 'sms_id', 'show_on_server', 'site_id','paypal_only'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories($site_id)
    {
        return $this->belongsToMany(Category::class)->wherePivot('site_id', $site_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sms()
    {
        return $this->hasOne(Sms::class,'id','sms_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expiredcmds()
    {
        return $this->hasMany(ExpireCmd::class);
    }

}
