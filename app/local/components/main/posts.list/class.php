<?php

use Bitrix\Main;
use App\Models\Post;
use App\Models\User;
use App\Models\Hub;

class PostsList extends \App\Components\BaseComponent
{

    protected function getResult()
    {
        $filterRating = filter_var($this->arParams['FILTER'], FILTER_SANITIZE_NUMBER_INT);
        if ($this->arParams['FILTER'] != '') {
            $filter = [
                '>=PROPERTY_RATING' => $filterRating
            ];
        }
        if($this->arParams['CURPAGE'] == "") {
            $this->arResult['CURPAGE'] = 1;
        } else {
            $this->arResult['CURPAGE'] = $this->arParams['CURPAGE'];
        }

        $postList = Post::select('FIELDS', 'PROPS')->fetchUsing('GetNext')->sort(['ACTIVE_FROM' => 'DESC'])->filter($filter)->forPage($this->arResult['CURPAGE'], $this->arParams['POSTS_PER_PAGE'])->getList();
        $userList = User::select('FIELDS', 'PROPS')->getList();
        $hubsList = Hub::getList();

        $this->arResult['POSTS'] = $postList;
        $this->arResult['USERS'] = $userList;
        $this->arResult['HUBS'] = $hubsList;
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }

}