<?php

use Bitrix\Main;
use App\Models\Post;
use App\Models\User;
use App\Models\Hub;
use App\Models\Tag;

class PostsDetail extends \App\Components\BaseComponent
{

    protected function getResult()
    {
        $post = Post::query()
            ->fetchUsing('GetNext')
            ->with('user', 'hub')
            ->getById($this->arParams['ELEMENT_ID']);

        $this->arResult['POST'] = $post;
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }
}