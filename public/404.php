<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>
<h1>Ошибка 404. Страница не найдена</h1>
<p>
    К сожалению, такой страницы нет на нашем сайте.<br>
    Возможно, вы ввели неправильный адрес или страница была удалена.<br>
    <br>
    Можете перейти на <a href="/">главную страницу</a>.
</p>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>