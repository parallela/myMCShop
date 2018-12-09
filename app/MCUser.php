<?php

namespace App;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class MCUser extends Authenticatable
{

    protected $guard = 'mcuser';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'site_id'];

    /**
     * Remember token.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons()
    {
        return $this->hasMany(Coupon::class,'user_id','id');
    }
}
