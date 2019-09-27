<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?><?$APPLICATION->IncludeComponent(
	"main:posts.detail",
	"habr",
	[
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
	]
);?><br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>