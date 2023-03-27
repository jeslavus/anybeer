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
<section id="stock" class="p-64 wow fadeIn">
	<article class="stock-slider slider-opacity">
		<div class="timer-slide"></div>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div data-id="<?=$arItem['ID'];?>" class="stock-slide slide-opacity bcg-cover" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC'];?>');" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="stock-cart white-cart">
				<?if($arItem['PROPERTIES']['DATE_END']['VALUE']):?><p class="stock-subtitle">акция до <?=FormatDate("d F", MakeTimeStamp($arItem['PROPERTIES']['DATE_END']['VALUE']));?></p><?endif;?>
				<h2 class="stock-title fake-h1"><?=$arItem['NAME'];?></h2>
				<p class="stock-txt"><?=$arItem['PREVIEW_TEXT'];?></p>
				<?if($arItem['PROPERTIES']['BTN_LINK']['VALUE']):?><a href="<?=$arItem['PROPERTIES']['BTN_LINK']['VALUE'];?>" class="btn-standart stock-btn"><?=($arItem['PROPERTIES']['BTN_TEXT']['VALUE'] ?: Loc::getMessage('BTN_TEXT'));?></a><?endif;?>
			</div>
		</div>
		<?endforeach;?>
	</article>
	<article class="stock-nav slider-nav wow fadeIn"></article>
</section>