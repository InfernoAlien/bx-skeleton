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
        $post = Post::select('FIELDS', 'PROPS')->fetchUsing('GetNext')->getById($this->arParams['ELEMENT_ID']);
        $user = User::select('FIELDS', 'PROPS')->getById($post['CREATED_BY']);
        $hubsList = Hub::getList();

        $this->arResult['POST'] = $post;
        $this->arResult['USER'] = $user;
        $this->arResult['HUBS'] = $hubsList;
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }
}