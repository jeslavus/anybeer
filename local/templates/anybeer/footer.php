<?if(!$isMainPage):?></div><?endif;?>
</main>

<style>
	footer {
		background: #333333;
		padding: 32px 0;
	}
	footer nav>ul {
		display: flex;
		justify-content: space-between;
		padding-left: 0;
	}
	footer nav>ul li span {
		color: #fff;
	}
	.catalog_footer, .footer_nav {
		border-bottom: 1px solid rgba(255,255,255, 0.1);
	}
	.catalog_footer h3 {
		font-size: 24px;
		line-height: 120%;
		color: #8F8F8F;
		text-align: center;
		margin: 32px auto;
	}
	.footer_link a {
		color: #fff;
	}
	.footer_link a span {
		color: #8F0000;
	}
	.privacy_police {
		color: #8F8F8F !important;
	}
	.footer_links {
		display: flex;
		justify-content: space-between;
		padding-left: 0;
	}
	.catalog {
		padding-bottom: 32px;
	}
</style>

<footer class="footer_orig">
	<div class="container">
		<nav class="footer_nav">
			<div class="logo_wrap">
				<a href="https://<?=SITE_SERVER_NAME;?>" class="logo_href">
					<?php showSvg("logo"); ?>
				</a>
			</div>
			<div class="footer_nav_list">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
				"ROOT_MENU_TYPE" => "main",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "86400",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(),
				"CACHE_SELECTED_ITEMS" => "N",
				"MAX_LEVEL" => 1,
				"CHILD_MENU_TYPE" => "",
				"USE_EXT" => "N",
				"MENU_THEME" => "yellow",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N",
				), false
			);?>
			</div>
		</nav>
		<div class="catalog_footer">
			<h3>Популярное пиво по категориям:</h3>
			<div class="catalog">

            <?php for($i; $i<4; $i++) { ?>

                <a href="#" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card">
                            <?php require "verstka/assets/svg/hop.php";?>
                        </div>
                        <img src="verstka/assets/img/card_img.jpg" alt="Марка пива">
                    </div>
                    <div class="footer_card">
                        <h3>Миру-Beer, American Amber Ale</h4>
                        <hr>
                        <div class="brewery_mini">
                            <img src="verstka/assets/img/brewery_mini.png" alt="Логотип пивоварни">
                            <div class="brewery_mini_descr">
                                <h5 class="name_brewery_mini">CHIBIS Brewery</h5>
                                <p class="descr_brewery_mini">г. Санкт-Петербург</p>
                            </div>
                        </div>
                        <div class="info_card_wrap">
                            <div class="info_card_descr">14,7% </div>
                            <div class="info_card_descr">60 IBU</div>
                        </div>
                    </div>
                </a>

                <?php }; ?>

            </div>
		</div>
		<ul class="footer_links">
			<li class="footer_link"><a href="#">© Anybeer, 2023</a></li>
			<li class="footer_link"><a class="privacy_police" href="#">Политика конфиденциальности</a></li>
			<li class="footer_link"><a href="https://niceneasy.ru/">Дизайн и продвижение Nice’<span>N</span>’Easy</a></li>
		</ul>
	</div>
</footer>
<?
$APPLICATION->ShowHeadScripts();
?>
<script>
wow = new WOW(
	{
		animateClass: 'animated',
		offset: 100
	}
);
wow.init();
</script>
</div>
</body>
</html>