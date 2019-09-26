<?php

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__.'/../../public');
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define('CHK_EVENT', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!in_production()) {
    die('Cron events should only run in production' . PHP_EOL);
}

@set_time_limit(0);
@ignore_user_abort(true);

CAgent::CheckAgents();
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);
CEvent::CheckEvents();

if (CModule::IncludeModule("subscribe"))
{
    $cPosting = new CPosting;
    $cPosting->AutoSend();
}

require($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/tools/backup.php");
