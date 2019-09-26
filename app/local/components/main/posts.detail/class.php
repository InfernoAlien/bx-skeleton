<?php

use Bitrix\Main;
use App\Models\Post;
use App\Models\User;
use App\Models\HL_hub;
use App\Models\HL_tag;

class PostsDetail extends \App\Components\BaseComponent
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
        if ($iblock = $iterator->GetNext()) {
            $this->arParams['IBLOCK_ID'] = $iblock['ID'];
        } else {
            throw new Main\ArgumentNullException('IBLOCK_ID');
        }
    }

    protected function getResult() {
        $post = Post::select('FIELDS', 'PROPS')->fetchUsing('GetNext')->getById($this->arParams['ELEMENT_ID']);
        $user = User::select('FIELDS', 'PROPS')->getById($post['CREATED_BY']);
        $hubsList = HL_hub::getList();

        $this->arResult['POST'] = $post;
        $this->arResult['USER'] = $user;
        $this->arResult['HUBS'] = $hubsList;
    }

    public function executeComponent ()
    {
        $this->getIblockId();
        $this->getResult();
        $this->includeComponentTemplate();
    }
}