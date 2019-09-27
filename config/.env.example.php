<?php

use System\CacheEngines\CacheEngineLocalFiles;

return [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => true,

    'DB_HOST' => 'localhost',
    'DB_DATABASE' => '',
    'DB_LOGIN' => '',
    'DB_PASSWORD' => '',

    'CACHE_TYPE' => file_exists(project_path('system/CacheEngines/CacheEngineLocalFiles.php')) ? ['class_name' => CacheEngineLocalFiles::class] : 'files',
    'CACHE_SID' => $_SERVER["DOCUMENT_ROOT"]."#01",

    'MEMCACHE_HOST' => 'unix:///tmp/memcached.sock',
    'MEMCACHE_PORT' => '0',
];