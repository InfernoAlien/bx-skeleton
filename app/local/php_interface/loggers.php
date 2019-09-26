<?php

/**
 * В данном файле регистрируются Monolog-логгеры.
 * https://github.com/Seldaek/monolog
 * Никакие другие php-инструменты для логирования в проекте использоваться не должны (включая встроенные в Битрикс AddMessage2Log и т д)
 * Для удобства получения нужного логгера из регистра в helpers.php есть хэлпер logger($name = 'common')
 */

use Arrilot\BitrixSync\Telegram\TelegramFormatter;
use Arrilot\BitrixSync\Telegram\TelegramHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Registry;

// common logger
$logger = new Logger('common');
$logger->pushHandler(new StreamHandler(logs_path('common.log')));
if (class_exists(TelegramHandler::class) && config('telegram.alerts_bot') && config('telegram.alerts_channel')) {
    $proxy = config('telegram.proxy', '');
    $handler = new TelegramHandler(config('telegram.alerts_bot'), config('telegram.alerts_channel'), Logger::ALERT);
    $handler->setFormatter(new TelegramFormatter());
    if (method_exists($handler, 'setProxy')) {
        $handler->setProxy($proxy);
    }
    $logger->pushHandler($handler);
}
Registry::addLogger($logger, 'common');

//api logger
$logger = new Logger('api');
$logger->pushHandler(new StreamHandler(logs_path('api.log')));
Registry::addLogger($logger, 'api');

// import logger example
//$logger = new Logger('import');
//$logger->pushHandler(new StreamHandler(logs_path('import.log')));
//Registry::addLogger($logger, 'import');
