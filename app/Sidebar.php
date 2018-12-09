<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable = ['name', 'type', 'content', 'position'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo('site');
    }

    /**
     * @param $site_id
     */
    public function sidebarSeed($site_id)
    {
        self::insert([
            ['name'=>'Сървър статус','type'=>'status','position'=>1,'site_id'=>$site_id],
            ['name'=>'Потребителски панел','type'=>'upanel','position'=>2,'site_id'=>$site_id],
            ['name'=>'Скорощни покупки','type'=>'lpurchase','position'=>3,'site_id'=>$site_id],
            ['name'=>'Препоръчани пакети','type'=>'recpackate','position'=>4,'site_id'=>$site_id],
            ['name'=>'Приходи','type'=>'payments','position'=>5,'site_id'=>$site_id],
        ]);
    }
}
