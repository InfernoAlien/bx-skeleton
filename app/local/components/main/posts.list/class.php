<?php

use Bitrix\Main;
use App\Models\Post;
use App\Models\User;
use App\Models\Hub;

class PostsList extends \App\Components\BaseComponent
{
    protected function getResult()
    {
        $builder = Post::query()
            ->fetchUsing('GetNext')
            ->sort(['ACTIVE_FROM' => 'DESC']);
        $filterRating = filter_var($this->arParams['FILTER'], FILTER_SANITIZE_NUMBER_INT);
        if ($this->arParams['FILTER'] != '') {
            $builder->filter(['>=PROPERTY_RATING' => $filterRating]);
        }
        if($this->arParams['CURPAGE'] == "") {
            $this->arResult['CURPAGE'] = 1;
        } else {
            $this->arResult['CURPAGE'] = $this->arParams['CURPAGE'];
        }
        $postCount = count($builder->getList());
        $postList = $builder
            ->forPage($this->arResult['CURPAGE'], $this->arParams['POSTS_PER_PAGE'])
            ->with('user', 'hub')
            ->getList();

        foreach($postList as $post) {
            $userList = $post->user;
            $hubsList = $post->hub;
        }

        $this->arResult['POSTS'] = $postList;
        $this->arResult['USERS'] = $userList;
        $this->arResult['HUBS'] = $hubsList;
        $this->arResult['POST_COUNT'] = $postCount;
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }
}