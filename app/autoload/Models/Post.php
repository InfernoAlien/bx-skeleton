<?php

namespace App\Models;
use Arrilot\BitrixModels\Models\ElementModel;

class Post extends ElementModel
{
    public static function iblockId() : int
    {
        return iblock_id('posts');
    }
}