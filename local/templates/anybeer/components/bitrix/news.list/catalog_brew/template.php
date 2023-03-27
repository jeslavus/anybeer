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
<div class="<?= (count($arResult["ITEMS"])<4) ? 'brew_list_gap' : 'brew_list' ?>">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
$rating = round($arItem['PROPERTIES']['RATING']['VALUE']);
if($rating==''){
    $rating = '0';
};
$brew_picture = \GarbageStorage::get("brew_picture");
$brew_name = \GarbageStorage::get("brew_name");
$brew_city = \GarbageStorage::get("brew_city");
?>

    <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card">
                            <?php showSvg("hop-".$rating.""); ?>
                        </div>
                        <div class="img_brew_wrap">
							<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="Марка пива">
						</div>
                    </div>
                    <div class="footer_card">
                        <h3><?= $arItem['NAME']; ?></h3>
                        <div class="brewery_mini">
                            <img src="<?= $brew_picture; ?>" alt="Логотип пивоварни" class="brew_mini_logo">
                            <div class="brewery_mini_descr">
                                <h5 class="name_brewery_mini"><?= $brew_name; ?></h5>
                                <p class="descr_brewery_mini">г. <?= $brew_city; ?></p>
                            </div>
                        </div>
                        <div class="info_card_wrap">
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['ALCO']['VALUE']; ?>%</div>
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['IBU']['VALUE']; ?> IBU</div>
                        </div>
                    </div>
                </a>

<?endforeach;?>
</div>