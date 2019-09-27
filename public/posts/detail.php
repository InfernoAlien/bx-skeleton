<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?$APPLICATION->IncludeComponent(
	"main:posts.detail",
	"habr",
	[
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
        "IBLOCK_CODE" => "posts",
        "IBLOCK_TYPE" => "lists"
	]
);?><br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>