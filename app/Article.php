<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function seedArticle($site_id)
    {
        self::insert([
            ['title'=>'Welcome','content'=>'Thanks for purchase!','site_id'=>$site_id],
        ]);
    }
}
