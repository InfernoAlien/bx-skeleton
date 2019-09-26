<?php

use Bitrix\Main;
use App\Models\Post;

class PostsNav extends \App\Components\BaseComponent
{
    protected function getResult()
    {
        $filterRating = filter_var($this->arParams['FILTER'], FILTER_SANITIZE_NUMBER_INT);
        if ($this->arParams['FILTER'] != '') {
            $filter = [
                '>=PROPERTY_RATING' => $filterRating
            ];
        }
        $postList = Post::select('FIELDS', 'PROPS')->fetchUsing('GetNext')->sort(['ACTIVE_FROM' => 'DESC'])->filter($filter)->getList();
        $postCount = count($postList);
        $pages = ceil($postCount / $this->arParams['POSTS_PER_PAGE']);


        if($this->arParams['CURPAGE'] <= 5) {
            $nStartPage = 1;
        }
        elseif(($this->arParams['CURPAGE'] + 4) >= $pages) {
            $nStartPage = $this->arParams['CURPAGE'] - (7 - ($pages - $this->arParams['CURPAGE']));
        }
        else {
            $nStartPage = $this->arParams['CURPAGE'] - 4;
        }

        if($this->arParams['CURPAGE'] <= 4) {
            $nEndPage = 8;
        }
        elseif(($this->arParams['CURPAGE'] + 4) >= $pages) {
            $nEndPage = $pages;
        }
        else {
            $nEndPage = $this->arParams['CURPAGE'] + 4;
        }
        if($pages < 8) {
            $nEndPage = $pages;
            $nStartPage = 1;
        }

        $this->arResult['PAGE_COUNT'] = $pages;
        $this->arResult['NPAGE_START'] = $nStartPage;
        $this->arResult['NPAGE_END'] = $nEndPage;
        if($this->arParams['CURPAGE'] == "") {
            $this->arResult['CURPAGE'] = 1;
        }
        else {
            $this->arResult['CURPAGE'] = $this->arParams['CURPAGE'];
        }
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }
}