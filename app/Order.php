<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id', 'm_c_user_id', 'site_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(MCUser::class, 'm_c_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return int
     */
    public function getTotalPrice($siteID)
    {

        $orders = self::with('product')->where('site_id', $siteID)->get();
        $total = $orders->sum('product.price');
        return $total;
    }

    /**
     * @return mixed
     */
    public function getTodayTurnover($siteID)
    {
        $orders = self::with('product')->where('site_id', $siteID)->get();
        $total = $orders->where('created_at', '>=', Carbon::today())->sum('product.price');

        return $total;
    }

    public function getYearRevenue($yearRevenue)
    {
        $yearmounths = [0,0,0,0,0,0,0,0,0,0,0,0];
        $mounthly_sum_price = array();

        foreach (range(1,12) as $mount) {

            foreach ($yearRevenue as $yr) {
                $yearmounths[$yr->mounth-1] = $mount->product->price->sum();
            }

        }

        return $yearmounths;


    }

}
