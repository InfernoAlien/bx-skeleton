<?php

/**
 * Данный файл подключается при любом необработанном исключении в случае если не включен режим отладки.
 * За включения режима отладки отвечает `exception_handling => debug` в .settings.php, а точнее в итоге APP_DEBUG в .env.php
 * В итоге:
 * 1. Если режим отладки включен (сервера разработки), то на экране браузера будет исключение с трейсом
 * 2. Если режим отладки выключен (боевые сервера), то мы в коде ниже заменям стандартную Битриксовую заглушку
 * "The script encountered an error and will be aborted. To view extended error messages, enable this feature in..."
 * на красивую страницу-заглушку индивидуальную для проекта.
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$config = \Bitrix\Main\Config\Configuration::getInstance();
if ($config->get('exception_handling')['debug'] === true) {
    return;
}

CHTTP::SetStatus('503 Service Temporary Unavailable');

$errorPage = $_SERVER['DOCUMENT_ROOT'].'/error_50x/index.html';
if (file_exists($errorPage)) {
    if (!empty($GLOBALS['APPLICATION']) && is_object($GLOBALS['APPLICATION'])) {
        $GLOBALS['APPLICATION']->RestartBuffer();
    }
    echo file_get_contents($errorPage);
} else {
    echo 'A error occurred during execution of this script. You can turn on extended error reporting in .settings.php file.';
}

