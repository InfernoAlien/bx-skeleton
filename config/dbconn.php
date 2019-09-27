<?php

require_once 'bootstrap.php';

define("BX_USE_MYSQLI", true);
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = env('DB_HOST');
$DBLogin = env('DB_LOGIN');
$DBPassword = env('DB_PASSWORD');
$DBName = env('DB_DATABASE');
$DBDebug = env('APP_DEBUG', false);
$DBDebugToFile = false;
define("MYSQL_TABLE_TYPE", "INNODB");

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0775);
define("BX_DIR_PERMISSIONS", 0775);
@umask(~BX_DIR_PERMISSIONS);
define("BX_DISABLE_INDEX_PAGE", true);
define("BX_COMPRESSION_DISABLED", true); // отключаем модуль компрессии, этим занимаемся nginx.

define("LOG_FILENAME", logs_path('bitrix.log'));
define("BX_CACHE_TYPE", env('CACHE_TYPE', 'files'));
define("BX_CACHE_SID", env('CACHE_SID', $_SERVER["DOCUMENT_ROOT"]."#01"));

// https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=32&LESSON_ID=5507
if(!(defined("CHK_EVENT") && CHK_EVENT===true)) {
    define("BX_CRONTAB_SUPPORT", true);
}

if (env('CACHE_TYPE', 'files') === 'memcache') {
    define("BX_MEMCACHE_HOST", env('MEMCACHE_HOST', 'unix:///tmp/memcached.sock'));
    define("BX_MEMCACHE_PORT", env('MEMCACHE_PORT', '0'));
}
