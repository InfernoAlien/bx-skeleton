<?php

namespace App\Models;
use Arrilot\BitrixModels\Models\D7Model;

class Tag extends D7Model
{
    public static function tableClass()
    {
        return highloadblock_class('habr_tags');
    }
}