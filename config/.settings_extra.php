<?php

use Bitrix\Main\DB\MysqliConnection;

require_once 'bootstrap.php';

return [
    'app' => [
        'value' => [
            'env'  => env('APP_ENV', 'production'),
            'sandbox' => SANDBOX,
        ],
        'readonly' => true,
    ],
    'analytics_counter'  => [
        'value' => [
            'enabled' => false, // отключаем сбор статистики и http://bitrix.info/bx_stat на всех страницах сайта, если вдруг нужно - можно включить назад.
        ],
        'readonly' => true,
    ],
    'exception_handling' => [
        'value'    => [
            'debug'                      => env('APP_DEBUG', false),
            'handled_errors_types'       => 4437,
            'exception_errors_types'     => 4437,
            'ignore_silence'             => false,
            'assertion_throws_exception' => true,
            'assertion_error_type'       => 256,
            'log'                        => null,
        ],
        'readonly' => false,
    ],
    'connections'        => [
        'value'    => [
            'default' => [
                'className' => MysqliConnection::class,
                'host'      => env('DB_HOST', 'localhost'),
                'database'  => env('DB_DATABASE', ''),
                'login'     => env('DB_LOGIN', ''),
                'password'  => env('DB_PASSWORD', ''),
                'options'   => 2,
            ],
        ],
        'readonly' => true,
    ],
    'cache'              => [
        'value'    => [
            'type' => env('CACHE_TYPE', 'files'),
            'sid' => env('CACHE_SID', $_SERVER["DOCUMENT_ROOT"]."#01"),
            'memcache' => [
                'host' => env('MEMCACHE_HOST', 'unix:///tmp/memcached.sock'),
                'port' => env('MEMCACHE_PORT', '0'),
            ],
        ],
        'readonly' => false,
    ],
    'bitrix-sync' => [
        'value' => [
            'emailAlertsTo' => env('BITRIX_SYNC_ALERTS_EMAILS', []),
            'sendAlertsToTelegram' => [env('TELEGRAM_ALERTS_BOT', ''), env('TELEGRAM_ALERTS_CHANNEL', ''), env('TELEGRAM_PROXY', 'http://tg.greensight.ru')],
            'cleanOldLogs' => 30, //days
        ],
        'readonly' => false,
    ],
    'bitrix-systemcheck' => [
        'value' => [
            'env' => env('APP_ENV', 'production'),
            'domain' => SANDBOX,
            'basicAuth' => env('APP_BASIC_AUTH', ''),
            'monitorings' => [
                \System\SystemCheck\Monitorings\FullMonitoring::class,
                \System\SystemCheck\Monitorings\BriefMonitoring::class,
            ]
        ],
        'readonly' => true,
    ],
    'bitrix-blade' => [
        'value'    => [
            'baseViewPath' => app_path('views/blade'),
            'cachePath' => app_path('local/cache/blade'),
        ],
        'readonly' => false,
    ],
    'recaptcha' => [
        'value' => [
            'public_key' => env('RECAPTCHA_PUBLIC_KEY', ''),
            'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
        ],
        'readonly' => false,
    ],
    'telegram' => [
        'value' => [
            'proxy' => env('TELEGRAM_PROXY', 'http://tg.greensight.ru'),
            'alerts_bot' => env('TELEGRAM_ALERTS_BOT', ''),
            'alerts_channel' => env('TELEGRAM_ALERTS_CHANNEL', ''),
        ],
        'readonly' => false,
    ],
    'languages' => [
        'value' => [
            'default' => \System\LanguageManager::getInstance()->getDefaultLanguage(),
            'additional' => \System\LanguageManager::getInstance()->getAdditionalLanguages(),
            'all' => \System\LanguageManager::getInstance()->getAllLanguages(),
        ],
        'readonly' => true,
    ],
];
