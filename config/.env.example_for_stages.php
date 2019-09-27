<?php

// Пример для мультистейджей
// Содержимое $commonFile соответсвует формату .env.example.php
// Для боевых и локалок это всё избыточно и надо вместо этого примера использовать пример .env.example.php,
// а файл $commonFile вообще не нужен

$commonFile = $_SERVER['DOCUMENT_ROOT'] . '/../../.env.php';
$common = file_exists($commonFile) ? require $commonFile : [];

$local = [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => true,
];

return array_merge($common, $local);
