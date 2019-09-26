<?php

namespace App\Components;

class EmptyWithCacheComponent extends BaseComponent
{
    public function execute()
    {
        $additionalCacheID = [];
        if($this->startResultCache(3600, $additionalCacheID)) {
            $this->includeComponentTemplate();
        }
    }
}
