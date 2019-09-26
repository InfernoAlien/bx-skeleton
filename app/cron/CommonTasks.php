<?php

/*
|--------------------------------------------------------------------------------------
|  Task File
|--------------------------------------------------------------------------------------
|
| Этот файл - аналог crontab. В нём регистрируются все задания, а в кронтаб добавляется
| лишь одна строка.
| Подробности: https://github.com/lavary/crunz#scheduling-frequency-and-constraints
|
*/

use Crunz\Schedule;

$projectRoot = __DIR__.'/../../';
$scheduler = new Schedule();

$scheduler->run('php -f app/cron/bitrix_cron_events.php')
    ->in($projectRoot)
    ->everyMinute()
    ->description('Bitrix agents');

$scheduler->run('php bxcli tools:clear_outdated_data')
    ->in($projectRoot)
    ->dailyAt('04:00')
    ->description('Clear outdated data');

// Эта команда должна выполняться в кроне пользователя с sudo.
// Если вы запускаете crunz от такого пользователя - раскоментируйте
// В противном случае добавьте отдельный крон пользователю с sudo (но лучше не root-у)
// 0 * * * * cd /srv/www/mysite.ru/mysite.ru && php bxcli tools:fix_files_permissions > /dev/null 2>&1
//$scheduler->run('php bxcli tools:fix_files_permissions')
//    ->in($projectRoot)
//    ->everyHour()
//    ->description('Fix files permissions');

$scheduler->run('php bxcli system:check brief')
    ->in($projectRoot)
    ->everyFiveMinutes()
    ->description('Brief monitoring');

$scheduler->run('php bxcli system:check full')
    ->in($projectRoot)
    ->dailyAt('03:00')
    ->description('Full monitoring');

return $scheduler;
