<?php
$arUrlRewrite=array (
    0 =>
    array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
    ),
    1 =>
    array (
        'CONDITION' => '#^/posts/([a-zA-Z0-9\-\_\%]+)/.*$#',
        'RULE' => 'ELEMENT_ID=$1',
        'ID' => '',
        'PATH' => '/posts/detail.php',
        'SORT' => 100,
    ),
    2 =>
        array (
            'CONDITION' => '#^/hub/([a-zA-Z0-9\-\_\%]+)/([a-zA-Z0-9\-\_\%]+)/$#',
            'RULE' => 'HUB=$1&FILTER=$2',
            'ID' => '',
            'PATH' => '/hub/$1/index.php',
            'SORT' => 100,
        ),
    3 =>
        array (
            'CONDITION' => '#^/hub/([a-zA-Z0-9\-\_\%]+)/([a-zA-Z0-9\-\_\%]+)/([a-zA-Z0-9\-\_\%]+)/.*$#',
            'RULE' => 'HUB=$1&FILTER=$2&CURPAGE=$3',
            'ID' => '',
            'PATH' => '/hub/$1/index.php',
            'SORT' => 100,
        ),
);
