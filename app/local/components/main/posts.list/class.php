<?php

use Bitrix\Main;
use App\Models\Post;
use App\Models\User;
use App\Models\HL_hub;

class PostsList extends \App\Components\BaseComponent
{
    protected function getIblockId()
    {
        $sort = [
            'id' => 'asc'
        ];
        $filter = [
            'TYPE' => $this->arParams['IBLOCK_TYPE'],
            'CODE' => $this->arParams['IBLOCK_CODE']
        ];
        $iterator = CIBlock::GetList($sort, $filter);
        if ($iblock = $iterator->GetNext())
            $this->arParams['IBLOCK_ID'] = $iblock['ID'];
        else
        {
            throw new Main\ArgumentNullException('IBLOCK_ID');
        }
    }

    protected function getResult() {
        $filterRating = filter_var($this->arParams['FILTER'], FILTER_SANITIZE_NUMBER_INT);
        if ($this->arParams['FILTER'] != '') {
            $filter = [
                '>=PROPERTY_RATING' => $filterRating
            ];
        }
        //var_dump($_REQUEST["PAGE"]);
        if($this->arParams['CURPAGE'] == "") {
            $this->arResult['CURPAGE'] = 1;
        }
        else {
            $this->arResult['CURPAGE'] = $this->arParams['CURPAGE'];
        }
        $postList = Post::select('FIELDS', 'PROPS')->fetchUsing('GetNext')->sort(['ACTIVE_FROM' => 'DESC'])->filter($filter)->forPage($this->arResult['CURPAGE'], $this->arParams['POSTS_PER_PAGE'])->getList();
        $userList = User::select('FIELDS', 'PROPS')->getList();
        $hubsList = HL_hub::getList();

        $this->arResult['POSTS'] = $postList;
        $this->arResult['USERS'] = $userList;
        $this->arResult['HUBS'] = $hubsList;
        //dump($hubsList);
    }

    public function executeComponent ()
    {
        $this->getIblockId();
        $this->getResult();
        $this->includeComponentTemplate();
    }

}