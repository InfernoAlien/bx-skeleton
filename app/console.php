<?php

/**
 * Здесь регистрируются консольные команды.
 *
 * В большинстве случае команды из директории `autoload/Console` регистрируются автоматически и ничего в этом файле менять не нужно.
 * Однако если у команды есть специфический конструктор с обязательными параметрами, то её всё же необходимо зарегистрировать вручную
 * Делается это при помощи строчки вида  `$app->add(new ClearCacheCommand());`
 * 
 * Список зарегистрированных команд можно посмотреть набрав `php bxcli`
 */

use App\Console;
use Arrilot\BitrixSystemCheck\Console\SystemCheckCommand;
use Arrilot\BitrixTinker\Console\TinkerCommand;
use SensioLabs\Security\Command\SecurityCheckerCommand;
use SensioLabs\Security\SecurityChecker;
use Symfony\Component\Console\Application;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__.'/../public');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// для консоли установим
\Bitrix\Main\Application::getConnection()->query('SET wait_timeout=28800');
if (!empty(\Arrilot\BitrixModels\ServiceProvider::$illuminateDatabaseIsUsed)) {
    \Illuminate\Database\Capsule\Manager::select('SET wait_timeout=28800');
}

function register_console_commands(Application $app, $path, $namespace)
{
    $finder = new Symfony\Component\Finder\Finder();
    $finder->files()->name('*.php')->in($path);

    foreach ($finder as $file) {
        $ns = $namespace;
        if ($relativePath = $file->getRelativePath()) {
            $ns .= '\\'.strtr($relativePath, '/', '\\');
        }
        $class = $ns.'\\'.$file->getBasename('.php');

        $r = new ReflectionClass($class);
        if ($r->isSubclassOf('Symfony\\Component\\Console\\Command\\Command')
            && !$r->isAbstract()
            && !$r->getConstructor()->getNumberOfRequiredParameters()
        ) {
            $app->add($r->newInstance());
        }
    }
}

$app = new Application('Bitrix CLI');
register_console_commands($app, app_path('autoload/Console'), 'App\\Console');

if (class_exists(SecurityCheckerCommand::class)) {
    $app->add(new SecurityCheckerCommand(new SecurityChecker())); // https://github.com/sensiolabs/security-checker
}

if (class_exists(SystemCheckCommand::class)) {
    $app->add(new SystemCheckCommand());
}

if (class_exists(TinkerCommand::class)) {
    $app->add(new TinkerCommand());
}

$app->run();
