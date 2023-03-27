<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
\Bitrix\Main\UI\Extension::load("ui.vue3");
CAjax::Init();
CJSCore::Init([
    'core',
    'ajax',
    'fx',
    'popup',
    'main.pageobject',
]);

global $USER;

$curPage = $APPLICATION->GetCurPage(false);
$isMainPage = ($curPage === '/');

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/verstka/assets/css/style.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/normalize.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/font/nunito.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/lib/wow/animate.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/style.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/jquery.fancybox.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/noty.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/custom.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/lib/jquery/jquery.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/slider/main/slider.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/slider/carts-v1/slider.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.fancybox.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.validate.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.serialize-object.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/lib/wow/wow.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/velocity.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/noty.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/script.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/custom.js");

Loc::loadMessages(__FILE__);

$HIDE_H1 = $APPLICATION->GetDirProperty('HIDE_H1') === "Y";

$arSiteOptions = include("site_options.php")


?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<?global $APPLICATION;?>
	<?IncludeTemplateLangFile(__FILE__);?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><? $APPLICATION->ShowTitle(); ?></title>
	<? Asset::getInstance()->addString('<script>BX.message('.CUtil::PhpToJSObject($MESS, false).')</script>', true); ?>
	<script>
	var arSiteOptions = <?=CUtil::PhpToJSObject($arSiteOptions, false);?>;
	</script>
	<?
	$APPLICATION->ShowCSS();
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowMeta('description');
	// $APPLICATION->ShowHeadScripts();
	?>
    <link rel="icon" type="image/x-icon" href="https://<?=SITE_SERVER_NAME;?><?=SITE_TEMPLATE_PATH;?>/assets/svg/fav.svg"/>
    <meta name="format-detection" content="telephone=no">
</head>
<div class="general_wrapper">
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<header class="header wow fadeIn">
	<div class="container">
		<div class="header_top">
			<a href="https://<?=SITE_SERVER_NAME;?>" class="logo_href">
				<?php showSvg("logo"); ?>
			</a>
			<? $APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include/header/search.php"),
				array(),
				array("MODE" => "html")
			); ?>
			<div class="drop_btn_wrap verification_block">
			<? $APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include/header/auth.php"),
				array(),
				array("MODE" => "html")
			); ?>
			</div>
			<button class="burger_menu">
				<span class="burger_item"></span>
				<span class="burger_item"></span>
				<span class="burger_item"></span>
			</button>
		</div>
	</div>
	<div class="header_bottom">
		<div class="container">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "main", array(
				"ROOT_MENU_TYPE" => "main",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "86400",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(),
				"CACHE_SELECTED_ITEMS" => "N",
				"MAX_LEVEL" => 3,
				"CHILD_MENU_TYPE" => "sub",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N",
				), false
			);?>               
		</div>
	</div>
</header>
<div class="dropdown_main_menu">
	<div class="dropdown_main_menu_wrap">
		<a href="https://<?=SITE_SERVER_NAME;?>" class="logo_href">
			<?php showSvg("logo"); ?>
		</a>
		<div class="drop_btn_wrap verification_block">
			<? $APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include/header/auth.php"),
				array(),
				array("MODE" => "html")
			); ?>
		</div>
		<div class="header_bottom">
			<div class="container">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "main", array(
					"ROOT_MENU_TYPE" => "main",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "86400",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(),
					"CACHE_SELECTED_ITEMS" => "N",
					"MAX_LEVEL" => 3,
					"CHILD_MENU_TYPE" => "sub",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					), false
				);?>
			</div>
		</div>
	   <? $APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include/header/search.php"),
			array(),
			array("MODE" => "html")
		); ?>
	</div>
</div>

<main>
<?if(!$isMainPage):?>
<div class="container">
	<h1><? $APPLICATION->ShowTitle(false); ?></h1>
</div>
<div class="container">
<?endif;?>