<?php

use Bitrix\Main;
use App\Models\Post;

class PostsNav extends \App\Components\BaseComponent
{
    protected function getResult()
    {
        $postCount = $this->arParams['POST_COUNT'];
        $pages = ceil($postCount / $this->arParams['POSTS_PER_PAGE']);

        if($this->arParams['CURPAGE'] <= 5) {
            $nStartPage = 1;
        } elseif(($this->arParams['CURPAGE'] + 4) >= $pages) {
            $nStartPage = $this->arParams['CURPAGE'] - (7 - ($pages - $this->arParams['CURPAGE']));
        } else {
            $nStartPage = $this->arParams['CURPAGE'] - 4;
        }

        if($this->arParams['CURPAGE'] <= 4) {
            $nEndPage = 8;
        } elseif(($this->arParams['CURPAGE'] + 4) >= $pages) {
            $nEndPage = $pages;
        } else {
            $nEndPage = $this->arParams['CURPAGE'] + 4;
        }
        if($pages < 8) {
            $nEndPage = $pages;
            $nStartPage = 1;
        }
        $baseUrl = $this->arParams['HUB']."/".$this->arParams['FILTER'];

        $this->arResult['PAGE_COUNT'] = $pages;
        $this->arResult['NPAGE_START'] = $nStartPage;
        $this->arResult['NPAGE_END'] = $nEndPage;
        $this->arResult['BASE_URL'] = $baseUrl;
    }

    public function executeComponent ()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }
}