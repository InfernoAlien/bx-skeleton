<?php

use Arrilot\BitrixCacher\Cache;
use Arrilot\DotEnv\DotEnv;

define('PROJECT_PATH', realpath(__DIR__."/../"));

// Константа с названием площадки, например, release.mysite.greensight.ru на одной из тестовых площадок или mysite.ru на бою
$documentRootExploded = explode('/', rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/'));
define('SANDBOX', $documentRootExploded[count($documentRootExploded) - 2] ?? '');

function project_path($path = '')
{
    return PROJECT_PATH.'/'.$path;
}

function public_path($path = '')
{
    return project_path("public/$path");
}

function app_path($path = '')
{
    return project_path("app/$path");
}

function local_path($path = '')
{
    return project_path("app/local/$path");
}

function logs_path($path = '')
{
    return project_path("logs/$path");
}

/**
 * @param null|string $key
 * @param null|int $seconds
 * @param null|Closure $callback
 * @param string $initDir
 * @param string $basedir
 * @return \Arrilot\BitrixCacher\CacheBuilder|mixed
 */
function cache($key = null, $seconds = null, $callback = null, $initDir = '/', $basedir = 'cache')
{
    if (func_num_args() === 0) {
        return new \Arrilot\BitrixCacher\CacheBuilder();
    }

    return Cache::remember($key, $seconds, $callback, $initDir, $basedir);
}

function env($key, $default = null)
{
    return DotEnv::get($key, $default);
}

/**
 * Получение значения из конфига.
 *
 * config('foo') -> вернёт ['foo']['value'] из .settings_extra.php
 * config('foo.bar') -> в ['foo']['value']['bar']
 * config('foo.bar.baz') -> в ['foo']['value']['bar.baz']
 *
 * @param  string  $key
 * @param  mixed  $default
 * @return mixed
 */
function config($key, $default = null)
{
    $keyParts = explode('.', $key);
    $keyPartsCount = count($keyParts);
    $values = Bitrix\Main\Config\Configuration::getValue($keyParts[0]);
    if ($keyPartsCount < 2) {
        $value = $values;
    } elseif ($keyPartsCount === 2) {
        $value = $values[$keyParts[1]] ?? null;
    } else {
        $keyPartsWithoutFirst = [];
        foreach ($keyParts as $i => $part) {
            if ($i === 0) {
                continue;
            }
            $keyPartsWithoutFirst[] = $part;
        }
        $value = $values[implode('.', $keyPartsWithoutFirst)] ?? null;
    }
    
    return is_null($value) ? $default : $value;
}

require_once project_path('vendor/autoload.php');

$languageManager = new \System\LanguageManager(require(project_path('config/languages.php')));
$languageManager->setLanguageForThisRequest();
$languageManager->setAsGlobal();

DotEnv::load(project_path('config/.env.php'));