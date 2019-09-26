<?php

/**
 * В данном файле регистрируются сервисы в Service Container из пакете illuminate/container
 * Починать как с ним работать можно здесь: https://habrahabr.ru/post/331982/
 *
 * В компонентах которые extends BaseComponent можно вместо executeComponent использовать метод execute().
 * Он резолвится из контейнера и таким образом в него можно внедрять зависимости через параметры с тайп-хинтами
 * Например execute(\Mobile_Detect $md) {}
 */

$container = \Illuminate\Container\Container::getInstance();

//$container->singleton(Mobile_Detect::class, function () {
//    return new Mobile_Detect();
//});
