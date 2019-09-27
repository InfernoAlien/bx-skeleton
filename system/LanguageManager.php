<?php

namespace System;

class LanguageManager
{
    /**
     * @var null|static
     */
    protected static $instance = null;

    /**
     * @var array
     */
    protected $allLanguages = [];
    
    /**
     * @var array
     */
    protected $defaultLanguage = [];

    /**
     * @var array
     */
    protected $additionalLanguages = [];
    
    /**
     * LanguageManager constructor.
     * @param $languages
     */
    public function __construct(array $languages)
    {
        $this->allLanguages = $languages;
        $i = 0;
        foreach ($languages as $code => $lang) {
            if ($i === 0) {
                $this->defaultLanguage = $lang;
            } else {
                $this->additionalLanguages[$code] = $lang;
            }
            $i++;
        }
    }
    
    /**
     * @param LanguageManager $instance
     */
    public static function setInstance(LanguageManager $instance) : void
    {
        static::$instance = $instance;
    }

    public function setAsGlobal() : LanguageManager
    {
        static::setInstance($this);

        return $this;
    }
    
    /**
     * @return LanguageManager
     */
    public static function getInstance() : LanguageManager
    {
        return static::$instance;
    }

    /**
     * Установливает константу LANGUAGE_ID для текущего запроса используя его URL и заголовки.
     */
    public function setLanguageForThisRequest() : void
    {
        // сначала ищем в заголовке, через него работают аякс запросы
        if (isset($_SERVER['HTTP_X_LANGUAGE_ID']) && in_array($_SERVER['HTTP_X_LANGUAGE_ID'], array_keys($this->allLanguages))) {
            define(LANGUAGE_ID, $_SERVER['HTTP_X_LANGUAGE_ID']);
            return;
        }

        // если в заголовке нету, то во фрагменте урла, например https://mysite.ru/kz/news/
        if (!empty($_SERVER['REQUEST_URI'])) {
            foreach ($this->additionalLanguages as $langCode => $lang) {
                $search = "/$langCode/";
                if (substr($_SERVER['REQUEST_URI'], 0, strlen($search)) === $search) {
                    define(LANGUAGE_ID, $langCode);
                    return;
                }
            }
        }

        if (substr($_SERVER['REQUEST_URI'], 0, 13) == '/bitrix/admin') {
            if (isset($this->allLanguages['ru'])) {
                define(LANGUAGE_ID, 'ru');
                return;
            }
        }

        define(LANGUAGE_ID, $this->defaultLanguage['code']);
    }

    /**
     * Получение префикса вида '/en' или '/by'
     * Для языка по-умолчанию возвращает пустую строку.
     *
     * @param $languageCode
     * @return string
     */
    public function getUrlPrefix(?string $languageCode = null) : string
    {
        $languageCode = is_null($languageCode) ? LANGUAGE_ID : $languageCode;

        return $this->defaultLanguage['code'] === $languageCode ? '' : '/'. $languageCode;
    }
    
    /**
     * Удаляет префикс недефолтного языка из урла, если он там есть.
     *
     * @param string $url
     * @param null|string $languageCode
     * @return string
     */
    public function clearUrlPrefix(string $url, ?string $languageCode = null) : string
    {
        $languageCode = is_null($languageCode) ? LANGUAGE_ID : $languageCode;

        if ($this->defaultLanguage['code'] === $languageCode) {
            return $url;
        }

        $languageCodeLength = strlen($languageCode);

        return substr($url, 0, $languageCodeLength + 2) === "/$languageCode/"
            ? substr($url, $languageCodeLength + 1)
            : $url;
    }
    
    /**
     * Получение link hreflang для текущей страницы
     *
     * @param string $url
     * @return string
     */
    public function getHrefLangs(string $url) : string
    {
        if (!$this->additionalLanguages) {
            return '';
        }

        $url = $this->clearUrlPrefix($url);

        ob_start();
        ?>
        <? foreach($this->allLanguages as $code => $language): ?>
            <link rel="alternate" hreflang="<?= $code ?>" href="<?= absolute_url($url, $code)?>" />
        <? endforeach ?>
        <link rel="alternate" hreflang="x-default" href="<?= absolute_url($url, $this->defaultLanguage['code'])?>" />
        <?

        return ob_get_clean();
    }

    public function getAllLanguages() : array
    {
        return $this->allLanguages;
    }

    public function getDefaultLanguage() : array
    {
        return $this->defaultLanguage;
    }

    public function getAdditionalLanguages() : array
    {
        return $this->additionalLanguages;
    }
    
    /**
     * Получение текущего языка.
     * @return array
     */
    public function getCurrentLanguage() : array
    {
        return $this->allLanguages[LANGUAGE_ID];
    }
    
    public function getCurPageParam($strParam = "", $arParamKill = [], $getIndexPage = null) : string
    {
        global $APPLICATION;
        
        return $APPLICATION->GetCurPageParam($strParam, $arParamKill, $getIndexPage);
    }
}
