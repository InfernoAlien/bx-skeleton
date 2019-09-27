<?php

namespace App\Models;

use Arrilot\BitrixModels\Models\UserModel;

class User extends UserModel
{
    public function personalPage()
    {
        return "/users/" . $this['LOGIN'] . "/";
    }
}