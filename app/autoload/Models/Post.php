<?php

namespace App\Models;
use Arrilot\BitrixModels\Models\ElementModel;

class Post extends ElementModel
{
    public static function iblockId() : int
    {
        return iblock_id('posts');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'ID', 'CREATED_BY');
    }

    public function hub()
    {
        return $this->hasMany(Hub::class, 'UF_XML_ID', 'PROPERTY_HABS_VALUE');
    }

    public function getFormatedDate()
    {
        return formDate($this['ACTIVE_FROM'], "j F Y") . " в " . formDate($this['ACTIVE_FROM'], "H:i");
    }
}