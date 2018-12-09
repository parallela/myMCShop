<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(MCUser::class);
    }

}
