<?php

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";

header('Content-Type:text/plain');

$env = config('app.env');
$robotsFile = file_exists("robots_$env.txt") ? "robots_$env.txt" : "robots_dev.txt";
$content =  file_get_contents($robotsFile);

echo str_replace('{{domain}}', $_SERVER['HTTP_HOST'], $content);
