<?php

namespace System\SystemCheck\Monitorings;

use Arrilot\BitrixSync\Telegram\TelegramFormatter;
use Arrilot\BitrixSync\Telegram\TelegramHandler;
use Arrilot\BitrixSystemCheck\Checks\Custom as CustomChecks;
use Arrilot\BitrixSystemCheck\Checks\Bitrix as BitrixChecks;
use Arrilot\BitrixSystemCheck\Monitorings\Monitoring;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FullMonitoring extends Monitoring
{
    /**
     * Russian monitoring name
     *
     * @return string
     */
    public function name()
    {
        return 'Полный мониторинг';
    }
    
    /**
     * Monitoring code (id)
     *
     * @return string
     */
    public function code()
    {
        return 'full';
    }
    
    /**
     * @return array
     */
    public function checks()
    {
        $domain = config('bitrix-systemcheck.domain');
        $mainPage = 'https://'. $domain . '/';
        $basicAuth = config('bitrix-systemcheck.basicAuth');
        if (in_production()) {
            return [
                new BitrixChecks\RequiredPhpModules(),
                new BitrixChecks\PhpSettings(),
                new BitrixChecks\ApacheModules(),
                new BitrixChecks\AgentsUsingCronCheck(),
                new BitrixChecks\CacheDirPermissionsCheck(),
                new BitrixChecks\ConfigFilesExcessOutputCheck(),
                new BitrixChecks\EncodingSettingsAreCorrect('UTF-8', true),
                new BitrixChecks\DataBaseConfigsMatchForBothCores(),
                new BitrixChecks\DataBaseCheck(),
                new BitrixChecks\EmailsCanBeSend(),
                new BitrixChecks\ServiceScriptsAreRemoved(),
                new BitrixChecks\UpdateServerCheck(),
                new CustomChecks\BitrixDebugIsTurnedOff(),
                new CustomChecks\RobotsTxt($mainPage, in_production(), $basicAuth),
                new CustomChecks\WwwRedirect($mainPage, $basicAuth),
                new CustomChecks\HttpsRedirect($mainPage, $basicAuth),
                new CustomChecks\SSLCertificateIsValid($domain),
                new CustomChecks\NewRelicIsLoaded(),
                new CustomChecks\XDebugIsNotLoaded(),
                new CustomChecks\DiskSpaceCheck(1000),
                new CustomChecks\RamCheck(200),
                new CustomChecks\ComposerSecurityCheck(project_path('composer.lock')),
            ];
        }

        return [
            new BitrixChecks\RequiredPhpModules(),
            new BitrixChecks\PhpSettings(),
            new BitrixChecks\ApacheModules(),
            new BitrixChecks\AgentsUsingCronCheck(),
            new BitrixChecks\CacheDirPermissionsCheck(),
            new BitrixChecks\ConfigFilesExcessOutputCheck(),
            new BitrixChecks\EncodingSettingsAreCorrect('UTF-8', true),
            new BitrixChecks\DataBaseConfigsMatchForBothCores(),
            new BitrixChecks\DataBaseCheck(),
            new BitrixChecks\EmailsCanBeSend(),
            new BitrixChecks\ServiceScriptsAreRemoved(),
            new BitrixChecks\UpdateServerCheck(),
            new CustomChecks\BitrixDebugIsTurnedOn(),
            new CustomChecks\BasicAuthIsTurnedOn($mainPage, $basicAuth),
            new CustomChecks\RobotsTxt($mainPage, in_production(), $basicAuth),
            new CustomChecks\HttpsRedirect($mainPage, $basicAuth),
            new CustomChecks\SSLCertificateIsValid($domain),
            new CustomChecks\DiskSpaceCheck(1000),
            new CustomChecks\RamCheck(200),
        ];
    }
    
    /**
     * @return Logger|null|\Psr\Log\LoggerInterface
     * @throws \Monolog\Handler\MissingExtensionException
     * @throws \Exception
     */
    public function logger()
    {
        $logger = new Logger('monitoring-full');
        $logger->pushHandler(new StreamHandler(logs_path('systemcheck/monitoring-full.log')));
        if (class_exists(TelegramHandler::class) && config('telegram.alerts_bot') && config('telegram.alerts_channel')) {
            $handler = new TelegramHandler(config('telegram.alerts_bot'), config('telegram.alerts_channel'), Logger::ALERT);
            $handler->setFormatter(new TelegramFormatter('Мониторингом ' . get_class() . ' выявлены ошибки'));
            $handler->setProxy(config('telegram.proxy'));
            $logger->pushHandler($handler);
        }

        return $logger;
    }
}
