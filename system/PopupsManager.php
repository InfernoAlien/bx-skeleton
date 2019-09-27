<?php

namespace System;

use LogicException;

class PopupsManager
{
    /**
     * @var array
     */
    protected $popups = [];
    
    /**
     * Path to directory with popups.
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $alreadyPrintedPopups = [];
    
    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Подключить попап в футере.
     *
     * @param string $name
     * @param array $params
     */
    public function add($name, $params = [])
    {
        $popup = compact('name', 'params');
        if ($this->popupIsPreparedToBePrinted($popup) || $this->popupIsPrinted($popup)) {
            return;
        }

        if (isset($this->popups[$name])) {
            $paramsEncodedOld = json_encode($this->popups[$name]['params']);
            $paramsEncodedNew = json_encode($params);
            throw new LogicException("Popup \"$name\" with params $paramsEncodedOld is already added. Cannot add another one with params $paramsEncodedNew");
        } elseif (isset($this->alreadyPrintedPopups[$name])) {
            $paramsEncodedOld = json_encode($this->alreadyPrintedPopups[$name]['params']);
            $paramsEncodedNew = json_encode($params);
            throw new LogicException("Popup \"$name\" with params $paramsEncodedOld is already printed. Cannot add another one with params $paramsEncodedNew");
        } else {
            $this->popups[$name] = $popup;
        }
    }

    /**
     * Подключить попап сразу сейчас, а не в футере.
     *
     * @param string $name
     * @param array $params
     */
    public function addNow($name, $params = [])
    {
        $popup = compact('name', 'params');
        if ($this->popupIsPrinted($popup)) {
            return;
        }

        if (isset($this->alreadyPrintedPopups[$name])) {
            $paramsEncodedOld = json_encode($this->alreadyPrintedPopups[$name]['params']);
            $paramsEncodedNew = json_encode($params);
            throw new LogicException("Popup \"$name\" with params $paramsEncodedOld is already printed. Cannot add another one with params $paramsEncodedNew");
        } else {
            $this->requirePopupFile($popup);
        }
    }

    /**
     * Print all popups as html.
     */
    public function printAll()
    {
        foreach ($this->popups as $name => $popup) {
            $this->requirePopupFile($popup);
        }
    }

    /**
     * Require popup file with HTML.
     * @param $popup
     */
    protected function requirePopupFile($popup)
    {
        global $USER, $APPLICATION, $DB;

        if (isset($this->alreadyPrintedPopups[$popup['name']])) {
            return;
        }

        if (is_array($popup['params'])) {
            extract($popup['params'], EXTR_SKIP);
        }
        require $this->path . '/' . $popup['name'] . '.php';
        $this->alreadyPrintedPopups[$popup['name']] = $popup;
    }

    /**
     * Добавлен ли уже попап с этими параметрами в массив для вывода?
     * @param array $popup
     * @return bool
     */
    protected function popupIsPreparedToBePrinted(array $popup)
    {
        return isset($this->popups[$popup['name']]) && $this->popups[$popup['name']]['params'] == $popup['params'];
    }

    /**
     * Напечатан ли уже попап?
     * @param array $popup
     * @return bool
     */
    protected function popupIsPrinted(array $popup)
    {
        return isset($this->alreadyPrintedPopups[$popup['name']]) && $this->alreadyPrintedPopups[$popup['name']]['params'] == $popup['params'];
    }
}