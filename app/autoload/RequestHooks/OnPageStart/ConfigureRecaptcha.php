<?php

namespace App\RequestHooks\OnPageStart;

use Arrilot\GoogleRecaptcha\Recaptcha;

/**
 * Конфигурирует google recaptcha 2
 */
class ConfigureRecaptcha
{
    /**
     * Основной обработчик хука.
     */
    public static function handle()
    {
        Recaptcha::getInstance()
            ->setPublicKey(config('recaptcha.public_key'))
            ->setSecretKey(config('recaptcha.secret_key'))
            ->setLanguage('ru');
    }
}
