<?php

/**
 * В данном файле регистрируются все обработчики Битриксовых событий.
 *
 * Исключение:
 * Если событие касается жизненного цикла запроса (OnPageStart, OnBeforeProlog, OnProlog, OnEpilog, OnAfterEpilog), то
 * его обработчики должны быть зарегистрированы не здесь, а в request_hooks.php
 *
 * Каждый обработчик должен обязательно быть методом класса лежащего в app/autoload/EventHandlers/
 * Там уже создан класс UserHandlers. Дальше лучше всего создавать для каждый сущности отдельный класс:
 * ProductHandlers, FeedbackHandlers и т.д
 *
 * В названии метода-обработчика должно четко отражаться событие:
 * 1. Действие которое в нём выполняется
 * 2. Событие(я) для которых он вызывается
 *
 * Примеры
 * NewsHandlers::generateUniqueCodeBeforeAdd - хорошее название
 * NewsHandlers::onBeforeIBlockElementAddHandler - плохое
 */

use App\EventHandlers\AdminMenuHandlers;
use App\EventHandlers\UserHandlers;
use App\EventHandlers\MainHandlers;


$em = Bitrix\Main\EventManager::getInstance();

// если вам нужно создавать свои пункты в левом меню битриксовой админки, то используйте эту строчку как начало
//$em->addEventHandler('main', 'OnBuildGlobalMenu', [AdminMenuHandlers::class, "addApplicationMenu"]);
