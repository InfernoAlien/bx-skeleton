<?php

/**
 * В этом файле регистрируются роуты для апи и аякс запрсов.
 * Подробнее о роутинге читать тут - https://www.slimframework.com/docs/objects/router.html
 */

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => !in_production(),
    ],
]);

// Группа роутов для аякс запросов из Битрикса.
$app->group('/internal', function () {
    $this->any('/component/{name}[/{template}]', 'App\Api\Internal\ComponentController:show');
    $this->post('/main/rating', '\App\Api\Internal\Post\PostController:changeRating');
    //$this->get('...', '...')
});

// Заготовка под внешнее API
$app->group('/v1', function () {
    // $this->get('/users', '\App\Api\V1\UserController:index');
});

return $app;
