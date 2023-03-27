<?php 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
use Bitrix\Catalog\Model\Price;
use Bitrix\Main\Localization\Loc;

//Ф-ия для опеределения к какой группе пользователей принадлежит юзер
function checkUserGroup($userId, $groupId) {
    global $USER;
    if ($USER->IsAuthorized()) {
        $userGroups = $USER->GetUserGroup($userId);
        return in_array($groupId, $userGroups);
    }
    return false;
}

$cnt = 0;
$max_price = 0;
$min_price = 0;
foreach($arResult["ITEMS"] as $arItem){
    $user_id = $arItem['PROPERTIES']['USER_ID']['VALUE'];
    $arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_USER_ID"=> $user_id);
    $arSelect = Array("ID", "IBLOCK_ID", "ACTIVE", "NAME", 'PROPERTY_CITY', 'PREVIEW_PICTURE');
    $brew = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

    if ($ob = $brew->GetNextElement()){; // переходим к след элементу, если такой есть
        $arFields = $ob->GetFields(); // поля элемента
    }

    if($arFields['ACTIVE'] == 'Y'){
        $cnt++;
    }

    $ar_price = CPrice::GetBasePrice($arItem['ID']);

    if($cnt == 1){
        $min_price = round($ar_price['PRICE']);
    }
    
    if(round($ar_price['PRICE'])<$min_price) {
        $min_price = round($ar_price['PRICE']);
    }

    if(round($ar_price['PRICE'])>$max_price){
        $max_price = round($ar_price['PRICE']);
    }

};

//эта фигня выводит каталог для паба и для остальных юзеров
if(checkUserGroup($USER->GetID(), 9) || checkUserGroup($USER->GetID(), 1)){

?>

<section class="item_section">
    <div class="container blocks_wrap">
	<aside class="left_block left_bg">
    <div class="left_block_wrap">
        <div class="serch_form_left">
        <div class="search_left_wrap">
            <input type="text" class="search_header" placeholder="Искать пиво...">
            <button class="search">
                <?php //require "assets/svg/magnifier.php"; ?>
            </button>
        </div>
        <div class="price_range">
            <p class="price_stat">Цена: <b><?= $min_price; ?> ₽ — <?= $max_price; ?> ₽</b></p>
            <div class="range_line">
                <div class="yellow_range_line"></div>
                <input type="range" class="min_range" min="<?= $min_price; ?>" max="<?= $max_price; ?>" value="<?= $min_price; ?>" step="1">
                <input type="range" class="max_range" min="<?= $min_price; ?>" max="<?= $max_price; ?>" value="<?= $max_price; ?>" step="1">
            </div>
            <div class="price_inputs_range_wrap">
                <input type="number" class="price_input_min" placeholder="цена от" value="<?= $min_price; ?>">
                <input type="number" class="price_input_max" placeholder="цена до" value="<?= $max_price; ?>">
            </div>
        </div>
        <ul class="catalog_left_list">
            <li class="service_flex_item">
                <span>Рейтинг</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Пивовар</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Сорт</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Прозрачность</span>
                <?php ////require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Алкоголь (ABV)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Горечь (IBU)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Начальная плотность (OG)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
        </ul>
        <button class="second_btn-standart btn-standart">Применить фильтр</button>
        </div>

       

    </div>
</aside>
        <div class="right_block">
            <h1>Каталог пива</h1>
            <div class="my_items_table_descr">
                <p>Показывается: 1-<?= $cnt; ?> из <?= $cnt; ?> результатов</p>
                <button class="service_flex_item popul">
                    <span>по популярности</span>
                    <?php //require "assets/svg/arrow_menu.php"; ?>
                </button>
            </div>
            <div class="catalog">

            <?php if(!$arResult["ITEMS"])return;
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$rating = $arItem['PROPERTIES']['RATING']['VALUE'];
if($rating==''){
    $rating = '0';
};

$price = CPrice::GetBasePrice($arItem['ID']); // получение цены по ID товара

$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

$user_id = $arItem['PROPERTIES']['USER_ID']['VALUE'];
$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_USER_ID"=> $user_id);
$arSelect = Array("ID", "IBLOCK_ID", "ACTIVE", "NAME", 'PROPERTY_CITY', 'PREVIEW_PICTURE');
$brew = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if ($ob = $brew->GetNextElement()){; // переходим к след элементу, если такой есть
    $arFields = $ob->GetFields(); // поля элемента
   }

if($arFields['ACTIVE'] == 'Y') :

?>

                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card">
                            <?php showSvg("hop-".round($rating).""); ?>
                        </div>
                        <div class="img_brew_wrap">
							<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="Марка пива">
                            <div class="brew_info_card">
                            <?php $arItem['PROPERTIES']['TARA']['VALUE'] == '0.5' ? showSvg('bottle_yellow') : showSvg('bottle'); ?>
                            <?php $arItem['PROPERTIES']['TARA']['VALUE'] == '0.3' ? showSvg('can_yellow') : showSvg('can'); ?>
                            <?php showSvg('keg'); ?>
                            <p>от <?= round($price['PRICE']); ?> ₽/<small>литр</small></p>
                        </div>
						</div>
                    </div>
                    <div class="footer_card">
                        <h3><?= $arItem['NAME']; ?></h4>
                        <div class="brewery_mini">
                            <img src="<?= CFile::GetPath($arFields["PREVIEW_PICTURE"]); ?>" alt="Логотип пивоварни" class="brew_cat_logo">
                            <div class="brewery_mini_descr">
                                <h5 class="name_brewery_mini"><?= $arFields['NAME']; ?></h5>
                                <p class="descr_brewery_mini">г. <?= $arFields['PROPERTY_CITY_VALUE']; ?></p>
                            </div>
                        </div>
                        <div class="info_card_wrap">
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['ALCO']['VALUE']; ?>%</div>
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['IBU']['VALUE']; ?>IBU</div>
                        </div>
                        
                    </div>
                </a>
                

                <?
                endif;
            endforeach;
            ?>

            </div>
        </div>
    </div>
</section>



<?php }else{ ?>
    
    <section class="item_section">
    <div class="container blocks_wrap">
	<aside class="left_block left_bg">
    <div class="left_block_wrap">
        <form action="" class="serch_form_left">
        <div class="search_left_wrap">
            <input type="text" class="search_header" placeholder="Искать пиво...">
            <button class="search">
                <?php //require "assets/svg/magnifier.php"; ?>
            </button>
        </div>
        <div class="price_range">
            <p class="price_stat">Цена: <b>500 ₽ — 123 000 ₽</b></p>
            <div class="range_line">
                <div class="yellow_range_line"></div>
                <input type="range" class="min_range" min="0" max="123000" value="0" step="10">
                <input type="range" class="max_range" min="0" max="123000" value="123000" step="10">
            </div>
            <div class="price_inputs_range_wrap">
                <input type="number" class="price_input_min" placeholder="цена от">
                <input type="number" class="price_input_max" placeholder="цена до">
            </div>
        </div>
        <ul class="catalog_left_list">
            <li class="service_flex_item">
                <span>Рейтинг</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Пивовар</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Сорт</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Прозрачность</span>
                <?php ////require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Алкоголь (ABV)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Горечь (IBU)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
            <li class="service_flex_item">
                <span>Начальная плотность (OG)</span>
                <?php //require "assets/svg/arrow_menu.php"; ?>
            </li>
        </ul>
        <button class="second_btn-standart btn-standart">Применить фильтр</button>
        </form>

       

    </div>
</aside>
        <div class="right_block">
            <h1>Каталог пива</h1>
            <div class="my_items_table_descr">
                <p>Показывается: 1-9 из 519 результатов</p>
                <button class="service_flex_item popul">
                    <span>по популярности</span>
                    <?php //require "assets/svg/arrow_menu.php"; ?>
                </button>
            </div>
            <div class="catalog">

            <?php if(!$arResult["ITEMS"])return;
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$rating = $arItem['PROPERTIES']['RATING']['VALUE'];
if($rating==''){
    $rating = '0';
};

$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

$user_id = $arItem['PROPERTIES']['USER_ID']['VALUE'];
$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_USER_ID"=> $user_id);
$arSelect = Array("ID", "IBLOCK_ID", "ACTIVE", "NAME", 'PROPERTY_CITY', 'PREVIEW_PICTURE');
$brew = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if ($ob = $brew->GetNextElement()){; // переходим к след элементу, если такой есть
    $arFields = $ob->GetFields(); // поля элемента
   }
   
if($arFields['ACTIVE'] == 'Y') :
?>

                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card">
                            <?php showSvg("hop-".round($rating).""); ?>
                        </div>
                        <div class="img_brew_wrap">
							<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="Марка пива">
						</div>
                    </div>
                    <div class="footer_card">
                        <h3><?= $arItem['NAME']; ?></h4>
                        <div class="brewery_mini">
                            <img src="<?= CFile::GetPath($arFields["PREVIEW_PICTURE"]); ?>" alt="Логотип пивоварни" class="brew_cat_logo">
                            <div class="brewery_mini_descr">
                                <h5 class="name_brewery_mini"><?= $arFields['NAME']; ?></h5>
                                <p class="descr_brewery_mini">г. <?= $arFields['PROPERTY_CITY_VALUE']; ?></p>
                            </div>
                        </div>
                        <div class="info_card_wrap">
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['ALCO']['VALUE']; ?>%</div>
                            <div class="info_card_descr"><?= $arItem['PROPERTIES']['IBU']['VALUE']; ?>IBU</div>
                        </div>
                        
                    </div>
                </a>
                

                <? endif;
            endforeach;?>

            </div>
        </div>
    </div>
</section>


<?php };?>