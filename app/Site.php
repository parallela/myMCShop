<?php

namespace App;

use Carbon\Carbon;
use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['slug', 'plan_id'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withPivot('expires_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sidebars()
    {
        return $this->hasMany(Sidebar::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @param $site_name
     * @param $user_id
     * @param $plan_id
     */
    public function createShop($site_name, $user_id, $plan_id)
    {
        $site = new self();
        $settings = new Setting();
        $sidebars = new Sidebar();
        $articles = new Article();


        // Register site to database
        $site_name = strtolower($site_name);
        $site->slug = $site_name;
        $site->plan_id = $plan_id;
        $site->save();

        // Add default menus,settings etc..
        $settings->siteSettingSeed($site->id);
        $sidebars->sidebarSeed($site->id);
        $articles->seedArticle($site->id);

        // Add site to user
        DB::table('site_user')->insert(
            [
                'site_id' => $site->id,
                'user_id' => $user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addMonth(1)
            ]
        );

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

}
