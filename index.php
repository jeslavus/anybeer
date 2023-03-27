<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");

?>

<section id="main-slider">
	<article class="main-slider-item slider-opacity wow fadeIn">

		<div class="timer-slide"></div>

		<div class="main-slider slide-opacity bcg-cover" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/main/bear.jpg);">
			<div class="info-block">
				<div class="tags">
					<p class="tag tg-br-yllw">#Стаут</p>
					<p class="tag tg-br-yllw">#Тёмные сорта</p>
				</div>
				<h2 class="fake-h1">Его величество, королевский стаут</h2>
				<p class="slider-txt">тёмный элевый (верхового брожения) сорт пива, приготовленный с использованием жжёного солода, получаемого путём прожарки ячменного зерна.</p>
				<button class="btn-standart">заказать</button>
			</div>
			<div class="slider-carts">
				<div class="slider-cart wow fadeIn">
					<div class="slider-cart-title">
						<p class="tag">#имперский_стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Insomnia</h3>
					<p class="slider-cart-txt">Rewort Brewery</p>
				</div>
				<div class="slider-cart wow fadeIn">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Cherry On Top (Frut Beer)</h3>
					<p class="slider-cart-txt">Zavod</p>
				</div>
				<div class="slider-cart wow fadeIn">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Unfinished Sympathy</h3>
					<p class="slider-cart-txt">Coma Brewery</p>
				</div>
			</div>
		</div>
		<div class="main-slider slide-opacity bcg-cover" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/main/bear.jpg);">
			<div class="info-block">
				<div class="tags">
					<p class="tag tg-br-yllw">#Стаут</p>
					<p class="tag tg-br-yllw">#Тёмные сорта</p>
				</div>
				<h2 class="fake-h1">Его величество, королевский стаут</h2>
				<p class="slider-txt">тёмный элевый (верхового брожения) сорт пива, приготовленный с использованием жжёного солода, получаемого путём прожарки ячменного зерна.</p>
				<button class="btn-standart">заказать</button>
			</div>
			<div class="slider-carts">
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#имперский_стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Insomnia</h3>
					<p class="slider-cart-txt">Rewort Brewery</p>
				</div>
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Cherry On Top (Frut Beer)</h3>
					<p class="slider-cart-txt">Zavod</p>
				</div>
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Unfinished Sympathy</h3>
					<p class="slider-cart-txt">Coma Brewery</p>
				</div>
			</div>
		</div>
		<div class="main-slider slide-opacity bcg-cover" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/main/bear.jpg);">
			<div class="info-block">
				<div class="tags">
					<p class="tag tg-br-yllw">#Стаут</p>
					<p class="tag tg-br-yllw">#Тёмные сорта</p>
				</div>
				<h2 class="fake-h1">Его величество, королевский стаут</h2>
				<p class="slider-txt">тёмный элевый (верхового брожения) сорт пива, приготовленный с использованием жжёного солода, получаемого путём прожарки ячменного зерна.</p>
				<button class="btn-standart">заказать</button>
			</div>
			<div class="slider-carts">
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#имперский_стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Insomnia</h3>
					<p class="slider-cart-txt">Rewort Brewery</p>
				</div>
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Cherry On Top (Frut Beer)</h3>
					<p class="slider-cart-txt">Zavod</p>
				</div>
				<div class="slider-cart">
					<div class="slider-cart-title">
						<p class="tag">#стаут</p>
						<?php showSvg("star-5"); ?>
					</div>
					<h3 class="slider-title">Unfinished Sympathy</h3>
					<p class="slider-cart-txt">Coma Brewery</p>
				</div>
			</div>
		</div>
	</article>
	<article class="main-slider-nav slider-nav"></article>
</section>

<? $APPLICATION->IncludeFile(
	"/include/homepage/popular.php",
	array(),
	array("MODE" => "html")
); ?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"sales_homepage",
	Array(
		"ACTIVE_DATE_FORMAT" => "j M Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("ID", "CODE", "NAME", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "-",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("DATE_END", "BTN_LINK", "BTN_TEXT", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>

<section id="who-are-we" class="p-64">
	<article class="who-flex container">
		<div class="who-text">
			<h2 class="who-title wow fadeIn">Кто мы такие?</h2>
			<p class="who-txt wow fadeIn">Мы предлагаем различные варианты сотрудничества: индивидуальная партнерская программа, программа сотрудничества для индивидуальных предпринимателей и частных лиц, посредническая программа.</p>
		</div>
		<div class="who-logo wow fadeIn"><?php showSvg("logo"); ?></div>
	</article>
</section>

<section id="partner">
	<article class="container partner-block">
		<div class="white-cart-rotate">
			<div class="partner-logo wow fadeIn"><?php showSvg("tap"); ?></div>
			<h2 class="partner-title wow fadeIn">Стань нашим партнёром</h2>
			<p class="partner-txt wow fadeIn">Мы предлагаем различные варианты сотрудничества: индивидуальная партнерская программа, программа сотрудничества для индивидуальных предпринимателей и частных лиц, посредническая программа.</p>
			<button class="btn-standart partner-btn wow fadeIn">Стать партнёром</button>
		</div>
	</article>
	<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/abs-fon.jpg" alt="" class="partner-img wow fadeIn">
</section>

<section id="leave-feedback" class="bcg-cover wow fadeIn">
	<article class="container leave-feedback-block">
		<div class="white-cart-rotate">
			<div class="partner-logo wow fadeIn"><?php showSvg("message"); ?></div>
			<h2 class="partner-title wow fadeIn">Оставляй отзывы</h2>
			<p class="partner-txt wow fadeIn">Любишь пиво, всегда в курсе новинок пивоварения, готов рассказать о своих впечатлениях? Регистрируйся у нас на сайте, оставляй свои отзывы и помогай другим в выборе, за активное участие в жизни портала мы дарим подарки!</p>
			<button class="btn-standart feedback-btn wow fadeIn">Вступить в клуб</button>
		</div>
	</article>
</section>

<section id="breweries" class="container p-64">
	<article class="breweries-preview">
		<div class="preview-block">
			<h2 class="preview-title wow fadeIn">Пивовары-партнёры<br><span class="preview-subtitle">(более 1200 производителей)</span></h2>
			<p class="preview-txt wow fadeIn">Мы очень ценим всех поставщиков, зарегистрированных на нашем сайте, эти люди просто молодцы!</p>
		</div>
		<button class="btn-standart breweries-btn wow fadeIn">Все пивоварни</button>
	</article>
	<article class="breweries-items">
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-1.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">Khoffner Brewery</h3>
			<p class="breweries-subtitle">г. Санкт-Петербург</p>
		</div>
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-2.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">Selfmade Brewery</h3>
			<p class="breweries-subtitle">г. Москва</p>
		</div>
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-3.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">CHIBIS Brewery</h3>
			<p class="breweries-subtitle">г. Москва</p>
		</div>
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-4.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">Hausmann Brewery</h3>
			<p class="breweries-subtitle">г. Екатеринбург</p>
		</div>
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-5.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">Pivot Point Brewery</h3>
			<p class="breweries-subtitle">г. Москва</p>
		</div>
		<div class="breweries-item wow fadeIn">
			<div class="breweries-ava">
				<img src="<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/breweries/breweries-6.png" alt="" class="breweries-img">
			</div>
			<h3 class="breweries-title">Hophead Brewery</h3>
			<p class="breweries-subtitle">г. Санкт-Петербург</p>
		</div>
	</article>
</section>

<? $APPLICATION->IncludeFile(
	"/include/homepage/pubs_map.php",
	array(),
	array("MODE" => "html")
); ?>

<section id="collections" class="container p-64">
	<article class="breweries-preview">
		<div class="preview-block">
			<h2 class="preview-title wow fadeIn">Подборки пива по сортам</h2>
			<p class="preview-txt wow fadeIn">Для ценителей, гурманов или классиков — в этих подборках вы сможете найти что-то для себя и своих клиентов.</p>
		</div>
		<button class="btn-standart breweries-btn wow fadeIn">Все подборки</button>
	</article>
	<article class="collections-items">
		<a href="" class="collections-item bcg-cover wow fadeIn" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-1.png), url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-1.jpg);">
			<h2 class="collections-name wow fadeIn">Крафтовое пиво<br>в банках и бутылках</h2>
		</a>
		<a href="" class="collections-item bcg-cover wow fadeIn" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-2.png), url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-2.jpg);">
			<h2 class="collections-name wow fadeIn">Крафтовое<br>разливное пиво</h2>
		</a>
		<a href="" class="collections-item bcg-cover wow fadeIn" style="background-image: url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-3.png), url(<?=SITE_TEMPLATE_PATH;?>/assets/img/slider/collections/collections-3.jpg);">
			<h2 class="collections-name wow fadeIn">Классические сорта пива</h2>
		</a>
	</article>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>