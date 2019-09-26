<?php

/**
 * init.php за *крайне* редким исключением трогать не надо.
 * Если необходимо выполнить какое-либо действие в начале каждой страницы, то следует
 * зарегистрировать хук в request_hooks.php в стэк OnPageStart или OnBeforeProlog.
 */

use Bitrix\Main\Loader;

Loader::includeModule('iblock');
Arrilot\BitrixBlade\BladeProvider::register();
Arrilot\BitrixModels\ServiceProvider::register();
Arrilot\BitrixCacher\ServiceProvider::register();
Arrilot\BitrixHLBlockFieldsFixer\ServiceProvider::register();
Arrilot\BitrixModels\ServiceProvider::registerEloquent();
MsNatali\BitrixDebug\DebugVar::register();

require "error_reporting.php";
require "container.php";
require "helpers.php";
require "loggers.php";
require "request_hooks.php";
require "handlers.php";
require "migrations.php";
