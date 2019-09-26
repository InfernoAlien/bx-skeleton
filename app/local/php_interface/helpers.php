<?php

use App\Models\User;
use Arrilot\GoogleRecaptcha\Recaptcha;
use Bitrix\Main\Application;
use Illuminate\Container\Container;

/**
 * db()->query('SELECT * FROM b_user');
 *
 * @param string $name
 * @return \Bitrix\Main\DB\Connection
 */
function db($name = '')
{
    return Bitrix\Main\Application::getConnection($name);
}

/**
 * Получение ID инфоблока по коду (или по коду и типу).
 * Всегда выполняет лишь один запрос в БД на скрипт.
 *
 * @param string $code
 * @param string|null $type
 * @return int
 *
 * @throws RuntimeException
 */
function iblock_id($code, $type = null)
{
    return Arrilot\BitrixIblockHelper\IblockId::getByCode($code, $type);
}

/**
 * Получение данных хайлоадблока по названию его таблицы.
 * Всегда выполняет лишь один запрос в БД на скрипт и возвращает массив вида:
 *
 * array:3 [
 *   "ID" => "2"
 *   "NAME" => "Subscribers"
 *   "TABLE_NAME" => "app_subscribers"
 * ]
 *
 * @param string $table
 * @return array
 */
function highloadblock($table)
{
    return Arrilot\BitrixIblockHelper\HLblock::getByTableName($table);
}

/**
 * Компилирование и возвращение класса для хайлоадблока для таблицы $table.
 *
 * Пример для таблицы `app_subscribers`:
 * $subscribers = highloadblock_class('app_subscribers');
 * $subscribers::getList();
 *
 * @param string $table
 * @return string
 */
function highloadblock_class($table)
{
    return Arrilot\BitrixIblockHelper\HLblock::compileClass($table);
}

/**
 * Компилирование сущности для хайлоадблока для таблицы $table.
 * Выполняется один раз.
 *
 * Пример для таблицы `app_subscribers`:
 * $entity = \Arrilot\BitrixIblockHelper\HLblock::compileEntity('app_subscribers');
 * $query = new Entity\Query($entity);
 *
 * @param string $table
 * @return \Bitrix\Main\Entity\Base
 */
function highloadblock_entity($table)
{
    return Arrilot\BitrixIblockHelper\HLblock::compileEntity($table);
}

/**
 * Входная точка в класс работы со сборщиком.
 * frontend()->setPage()...
 *
 * @return \App\Frontend\Frontend
 */
function frontend()
{
    static $frontend = null;

    if ($frontend === null) {
        $frontend = new \App\Frontend\Frontend();
    }

    return $frontend;
}

/**
 * Завершение запроса показом 404-ой страницы.
 *
 * @return void
 */
function show404()
{
    global $APPLICATION;

    if ($APPLICATION->RestartWorkarea()) {
        require(Application::getDocumentRoot()."/404.php");
        die();
    }
}

/**
 * Хэлпер для получения Service Container-а
 *
 * @return Container
 */
function container()
{
    return Container::getInstance();
}

/**
 * Resolve a service from the container.
 *
 * @param  string $name
 * @param array $parameters
 * @return mixed
 */
function resolve(string $name, array $parameters = [])
{
    return Container::getInstance()->make($name, $parameters);
}

/**
 * logger()->error('Error message here');
 *
 * @param string $name
 * @return \Monolog\Logger
 */
function logger($name = 'common')
{
    return Monolog\Registry::getInstance($name);
}

/**
 * Является ли текущий запрос AJAX запросом?
 *
 * @return bool
 */
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Определяет зашёл ли пользователь с мобильного устройства.
 * Определение проводится лишь один раз за запрос и кэшируется в локальную переменную
 * В результате данный метод можно безбоязнено вызывать сколько угодно раз.
 *
 * @return bool
 */
function is_mobile()
{
    static $result = null;

    if ($result === null) {
        $result = (new Mobile_Detect())->isMobile();
    }

    return $result;
}

/**
 *  Выбор нужной формы слова.
 *
 *   $forms = [
 *     "банан",
 *     "банана",
 *     "бананов"
 *   ];
 *
 *   plural_form(1, $forms); //банан
 *   plural_form(2, $forms); //банана
 *   plural_form(5, $forms); //бананов
 *
 * @param $n
 * @param $forms
 * @return string
 */
function plural_form($n, $forms)
{
    return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
}

/**
 * Оставляет в строке/массиве id только числовые.
 *
 * @param string|array $ids
 *
 * @return string
 */
function ids_to_sql($ids)
{
    if (!$ids) {
        return '';
    }
    
    $result = [];
    
    if (!is_array($ids)) {
        $ids = explode(',', $ids);
    }
    
    foreach ($ids as $id) {
        $id = (int) $id;
        if ($id) {
            $result[] = $id;
        }
    }
    
    return implode(',', $result);
}

function popups()
{
    static $popupsManager = null;

    if ($popupsManager === null) {
        $popupsManager = new \System\PopupsManager(app_path('views/popups'));
    }

    return $popupsManager;
}

/**
 * Запущен ли скрипт через консоль?
 *
 * @return bool
 */
function in_console()
{
    return php_sapi_name() === 'cli';
}

/**
 * Находимся ли мы в боевой среде?
 *
 * @return bool
 */
function in_production()
{
    return config('app.env') === 'production';
}

/**
 * Хэлпер, автоматически добавляющий языковой префикс к относительному урлу внутри проекта.
 *
 * @param string $url
 * @param null|string $languageCode
 * @return string
 */
function local_url($url, $languageCode = null)
{
    return \System\LanguageManager::getInstance()->getUrlPrefix($languageCode) . $url;
}

/**
 * Хэлпер, автоматически добавляющий языковой префикс к абсолютному урлу внутри проекта.
 *
 * @param string $url
 * @param null|string $languageCode
 * @return string
 */
function absolute_url($url, $languageCode = null)
{
    return "https://" . SANDBOX . local_url($url, $languageCode);
}

/**
 * @return Recaptcha
 */
function recaptcha()
{
    return Recaptcha::getInstance();
}

/**
 * Добавить переменную к отладке
 * @param mixed $var переменная, информацию о которой необходимо вывести в отладчик
 * @param string $name название переменной. По умолчанию будет использовано реальное название переменной или No Name
 * @param int $backtrace_i порядковый номер элемента стека вызова, который будет использоваться для получения информации о файле и строке вызова
 */
function debug_var($var, $name = '', $backtrace_i = 0)
{
    \MsNatali\BitrixDebug\DebugVar::get()->debug($var, $name, $backtrace_i + 1);
}

/**
 * @param null|int $id
 * @return User
 */
function user($id = null)
{
    return is_null($id) ? User::current() : User::query()->getById($id);
}

/**
 * Форматирует дату и время
 */
function formDate($date, $format)
{
    if($format == "H:i") {
        $resultDate = CIBlockFormatProperties::DateFormat($format, MakeTimeStamp($date, CSite::GetDateFormat()));
    }
    else {
        $timeStamp = MakeTimeStamp($date, CSite::GetDateFormat());
        $formDate = CIBlockFormatProperties::DateFormat("j m Y", $timeStamp);
        $curdate = date("j m Y");
        $yestdate = new DateTime('-1 days');
        if ($formDate == $curdate) {
            $resultDate = 'сегодня';
        } elseif ($formDate == $yestdate->format('j m Y')) {
            $resultDate = 'вчера';
        } else {
            $formDate = CIBlockFormatProperties::DateFormat($format, $timeStamp);
            $resultDate = $formDate;
        }
    }
    return $resultDate;
}
