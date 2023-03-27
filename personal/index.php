<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");

?><?$APPLICATION->IncludeComponent(
	"nne:personal",
	"",
Array(),
$component
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>