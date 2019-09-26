<?php

namespace App\Components;

use CBitrixComponent;
use LogicException;
use Illuminate\Container\Container;

class BaseComponent extends CBitrixComponent
{
    /**
     * Массив параметров.
     *
     * @var array
     */
    protected $params = [];
    
    /**
     * Завершение работы компонента показом 404-ой страницы.
     */
    public function show404()
    {
        $this->abortResultCache();

        show404();
    }

    /**
     * @return mixed|void
     */
    public function executeComponent()
    {
        if (class_exists(Container::class)) {
            Container::getInstance()->call([$this, 'execute']);
        } else {
            $this->execute();
        }

        debug_var($this->arResult, "Результат компонента " . $this->getName());
    }
    
    /**
     * Обработка $arParams на основе $this->params.
     * Доступные ключи:
     *  'required' - помечает параметр как обязательный
     *  'default' - задает значение по умолчанию
     *  'type' - конвертирует значение к указанному типу: "bool", "int", "float", "array", "array", "null"
     *
     * @param $arParams
     * @return array
     * @throws LogicException
     */
    public function onPrepareComponentParams($arParams)
    {
        foreach ($this->params as $code => $parameter) {
            if (!empty($parameter['required']) && !isset($arParams[$code])) {
                throw new LogicException('Required parameter "' .$code . '" is not set in "$arParams"');
            }

            if (isset($parameter['default']) && !isset($arParams[$code])) {
                $arParams[$code] = $parameter['default'];
            }

            if (!empty($parameter['type'])) {
                settype($arParams[$code], $parameter['type']);
            }
        }

        debug_var($arParams, "Параметры компонента " . $this->getName());

        return $arParams;
    }
}
