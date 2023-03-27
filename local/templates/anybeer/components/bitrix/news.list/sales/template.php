<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

if(!$arResult["ITEMS"])return;
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div data-id="<?=$arItem['ID'];?>" class="stock-slide slide-opacity bcg-cover" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC'];?>');" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<div class="stock-cart white-cart">
		<h2 class="stock-title fake-h1"><a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a></h2>
		<p class="stock-txt"><?=$arItem['PREVIEW_TEXT'];?></p>
		<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="btn-standart stock-btn">Подробнее</a>
	</div>
</div>
<?endforeach;?>