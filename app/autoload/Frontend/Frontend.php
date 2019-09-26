<?php

namespace App\Frontend;

class Frontend
{
    /**
     * Директория где лежит сборка.
     *
     * @var string
     */
    public $dir = '/html/';

    /**
     * Абсолютный серверный путь до файла-манифеста с ассетами фронтэнда.
     *
     * @return string
     */
    public function manifestPath()
    {
        return project_path('html/public/webpack-assets.json');
    }

    /**
     * @param array|string $page
     */
    public function setPage($page)
    {
        $pages = (array) $page;
        $manifestPath = $this->manifestPath();
        $manifestData = file_get_contents($manifestPath);
        if ($manifestData === false) {
            throw new \RuntimeException("Cannot read manifest $manifestPath");
        }

        $manifest = json_decode($manifestData, true);
        if ($manifest === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Error decoding manifest {$manifestPath}: " . json_last_error());
        }

        $js = $css = $preloadJs = $preloadCss = [];
        foreach ($manifest as $pageKey => $assets) {
            if (in_array($pageKey, $pages)) {
                if (!empty($assets['js'])){
                    $js = array_merge($js, (array) $assets['js']);
                }

                if (!empty($assets['css'])){
                    $css = array_merge($css, (array) $assets['css']);
                }
            }
        }

        $this->addCriticalCssToHeader(array_unique($css), $pages);
        $this->addPreloadToHeader(!empty($manifest['preload']) ? $manifest['preload'] : []);
        $this->addPrefetchToHeader(!empty($manifest['prefetch']) ? $manifest['prefetch'] : []);
        $this->addFontsToHeader(!empty($manifest['fonts']) ? $manifest['fonts'] : []);
        $this->addScriptsToFooter(array_unique($js));
    }

    /**
     * Функция для формирования браузерного пути до ресурса из сборщика.
     * Если у вас используется спец домен для статики (например s.leroymerlin.ru)
     * то вы можете добавить сюда логику по добавлению его к пути.
     *
     * @param string $path
     * @return string
     */
    public function path($path)
    {
        return $this->dir . $path;
    }

    /**
     * Adds $js to AddViewContent->scripts.
     *
     * @param array $js
     */
    protected function addScriptsToFooter(array $js)
    {
        if (!$js) {
            return;
        }

        $content = '';
        foreach ($js as $srcInStatic) {
            $src = $this->path($srcInStatic);
            $content .= '<script src="' . $src . '"></script>';
        }

        if ($content) {
            global $APPLICATION;
            $APPLICATION->AddViewContent('scripts', $content);
        }
    }

    /**
     * Adds $preload to AddViewContent->preload.
     *
     * @param array $preload
     */
    protected function addPreloadToHeader(array $preload)
    {
        if (!$preload) {
            return;
        }

        $content = '';
        if (!empty($preload['js'])) {
            foreach ((array) $preload['js'] as $jsInStatic) {
                $src = $this->path($jsInStatic);
                $content .= '<link as="script" href="' . $src . '" rel="preload">';
            }
        }

        if (!empty($preload['css'])) {
            foreach ((array) $preload['css'] as $cssInStatic) {
                $src = $this->path($cssInStatic);
                $content .= '<link as="style" href="' . $src . '" rel="preload">';
            }
        }

        if ($content) {
            global $APPLICATION;
            $APPLICATION->AddViewContent('preload', $content);
        }
    }

    /**
     * Adds $prefetch to AddViewContent->prefetch.
     *
     * @param array $prefetch
     */
    protected function addPrefetchToHeader(array $prefetch)
    {
        if (!$prefetch) {
            return;
        }

        $content = '';
        foreach ($prefetch as $prefetchItem) {
            $src = $this->path($prefetchItem);
            $content .= '<link href="' . $src . '" rel="prefetch">';
        }

        if ($content) {
            global $APPLICATION;
            $APPLICATION->AddViewContent('prefetch', $content);
        }
    }

    /**
     * Adds $fonts to AddViewContent->fonts.
     *
     * @param array $fonts
     */
    protected function addFontsToHeader(array $fonts)
    {
        if (!$fonts) {
            return;
        }

        $content = '';
        foreach ($fonts as $fontInStatic) {
            $src = $this->path($fontInStatic);
            $content .= '<link as="font" crossorigin="anonymous" href="' . $src . '" rel="preload">';
        }

        if ($content) {
            global $APPLICATION;
            $APPLICATION->AddViewContent('fonts', $content);
        }
    }

    /**
     * Adds $css and css from special to AddViewContent->critical-css.
     *
     * @param array $css
     * @param array $pages
     */
    protected function addCriticalCssToHeader(array $css, array $pages)
    {
        $content = '';
        foreach ($pages as $page) {
            $criticalCss = file_get_contents(project_path("html/public/critical/{$page}.html"));
            if ($criticalCss) {
                $content .= "<style>{$criticalCss}</style>";
            }
        }

        foreach ($css as $cssInStatic) {
            $src = $this->path($cssInStatic);
            $content .= '<link href="' . $src . '" rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
            $content .= '<noscript><link href="' . $src . '" rel="stylesheet"></noscript>';
        }

        $content .= '<script>!function(n){"use strict";n.loadCSS||(n.loadCSS=function(){});var o=loadCSS.relpreload={};if(o.support=function(){var e;try{e=n.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),o.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},o.poly=function(){if(!o.support())for(var t=n.document.getElementsByTagName("link"),e=0;e<t.length;e++){var a=t[e];"preload"!==a.rel||"style"!==a.getAttribute("as")||a.getAttribute("data-loadcss")||(a.setAttribute("data-loadcss",!0),o.bindMediaToggle(a))}},!o.support()){o.poly();var t=n.setInterval(o.poly,500);n.addEventListener?n.addEventListener("load",function(){o.poly(),n.clearInterval(t)}):n.attachEvent&&n.attachEvent("onload",function(){o.poly(),n.clearInterval(t)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:n.loadCSS=loadCSS}("undefined"!=typeof global?global:this);</script>';

        global $APPLICATION;
        $APPLICATION->AddViewContent('critical-css', $content);
    }
}
