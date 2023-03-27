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

<div class="<?= ($arResult["ITEMS"]<4) ? 'brew_list_gap' : 'brew_list' ?>">


<?foreach($arResult["ITEMS"] as $arItem):?>

<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

$user_id = $arItem['PROPERTIES']['USER_ID']['VALUE'];
$pivo = CIBlockElement::getList([], ["IBLOCK_ID" =>6, "PROPERTY_USER_ID"=> $user_id], false, false, []);
$cnt = $pivo->SelectedRowsCount();
$rating = $arItem['PROPERTIES']['RATING']['VALUE'];
if($rating==''){
    $rating = '0';
};
?>

    <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card_brew">
							<?php showSvg("hop-".round($rating).""); ?>
							<p><span class="grey_span">В продаже:</span> <?= $cnt; ?></p>
                        </div>
                        <div class="img_brew_wrap">
							<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="Марка пива">
						</div>
                    </div>
                    <div class="footer_card">
						<h3><?= $arItem['NAME']; ?></h3>
						<p class="descr_brewery_mini">г. <?= $arItem['PROPERTIES']['CITY']['VALUE']; ?></p>
                    </div>
                </a>
<?endforeach;?>
</div>