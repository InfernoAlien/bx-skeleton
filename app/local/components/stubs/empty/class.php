<?php

namespace App\Components;

class EmptyComponent extends BaseComponent
{
    public function execute()
    {
        $this->includeComponentTemplate();
    }
}
