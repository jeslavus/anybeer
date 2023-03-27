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

$user_id = $arResult['PROPERTIES']['USER_ID']['VALUE'];

    // Получаем объект CIBlockElement
    $iblockElement = new CIBlockElement();
    
    // Формируем параметры запроса
    $params = [
        'IBLOCK_ID' => 6,
        'ACTIVE' => 'Y',
		'PROPERTY_USER_ID' => $user_id,
    ];
    
    // Получаем все элементы инфоблока с указанными параметрами
    $elements = $iblockElement->GetList([], $params, false, false, []);
    $count_beer = $elements->SelectedRowsCount();


$rating = $arResult['PROPERTIES']['RATING']['VALUE'];
if($rating==''){
    $rating = '0';
};

Class GarbageStorage{
	private static $globalStorage = [];
	public static function set ($storageName,  $variableValue){ self::$globalStorage[$storageName] = $variableValue;}
	public static function get ($storageName){ return self::$globalStorage[$storageName];}
  }
  \GarbageStorage::set("brew_picture",  $arResult['PREVIEW_PICTURE']['SRC']);
  \GarbageStorage::set("brew_name",  $arResult['NAME']);
  \GarbageStorage::set("brew_city",  $arResult['PROPERTIES']['CITY']['VALUE']);
    
?>

<section class="about_brewer"></section>
    <div class="container">
        <figure class="brewer_info">
            <picture>
                <img src="<?= $arResult['PREVIEW_PICTURE']['SRC']; ?>" alt="Логотип пивовара">
            </picture>
            <figcaption>
                <div class="figcaption_top">
					<h2><?= $arResult['NAME']; ?></h2>
					<div class="svg_wrapper">
						<?php showSvg("heart"); ?>
						<?php showSvg("send"); ?>
					</div>
				</div>
                <div class="info_table">
                  <span class="grey_span">Город:</span>
                  <span class="classis_span"><?= $arResult['PROPERTIES']['CITY']['VALUE']; ?></span>
                  <span class="grey_span">Средний рейтинг пива:</span>
                  <span class="classis_span"><?php showSvg("hop-".round($rating).""); ?></span>
				  <span class="grey_span">Год основания:</span>
                  <span class="classis_span"><?= $arResult['PROPERTIES']['YEAR']['VALUE']; ?></span> 
                  <span class="grey_span">Пиво в продаже:</span>
                  <span class="classis_span"><?= $count_beer; ?></span>
                </div>
            </figcaption>
        </figure>
    </div>
</section>

<section class="brewer_bottom">
  <div class="container">
    <div id="dynamic-component-demo" class="demo">
      <div class="component_btn_wrap">
        <button
          v-for="(value, key) in tabs"
          v-bind:key="key"
          v-bind:class="['tab-button', { activer: currentTab == key }]"
          v-on:click="currentTab = key"
        >
          {{ value }}
        </button>
      </div>
      <component v-bind:is="currentTabComponent" class="tab"></component>
    </div>
  </div>
</section>

<script type="text/javascript">

const app = BX.Vue3.BitrixVue.createApp({
  data() {
    return {
      currentTab: '0',
      tabs: ['Товары пивоварни (<?= $count_beer; ?>)', 'О пивоварне', 'Где попробовать?', 'Фотоотзывы']
    }
  },
  computed: {
    currentTabComponent() {
      return 'tab-' + this.currentTab
    }
  }
})

app.component('tab-0', {
  template: `<div class="demo-tab">
  <div class="catalog_foot">
  <?php 
				// Проходим по каждому элементу и выводим его свойства
			$count_elem = 0;
				while ($element = $elements->GetNextElement()) {
					$properties = $element->GetProperties();
					$arFields_item = $element->GetFields();
					$beer_rate = $properties['RATING']['VALUE'];
					if($beer_rate == ''){
						$beer_rate = '0';
					}
					$count_elem++; // увеличиваем счетчик на 1
					
				?>
				
				<a href="/catalog/<?= $arFields_item["CODE"] ?>/" class="catalog_card">
                    <div class="top_card">
                        <div class="grade_card">
						<?php showSvg("hop-".round($beer_rate).""); ?>
                        </div>
                        <div class="img_brew_wrap">
							<img src="<?= CFile::GetPath($arFields_item["PREVIEW_PICTURE"]); ?>" alt="Марка пива">
						</div>
                    </div>
                    <div class="footer_card">
                        <h3><?= $arFields_item['NAME']; ?></h3>
                        <div class="brewery_mini">
                            <img src="<?= $arResult['PREVIEW_PICTURE']['SRC']; ?>" alt="Логотип пивоварни" class="brew_mini_logo">
                            <div class="brewery_mini_descr">
                                <h5 class="name_brewery_mini"><?= $arResult['NAME']; ?></h5>
                                <p class="descr_brewery_mini">г. <?= $arResult['PROPERTIES']['CITY']['VALUE']; ?></p>
                            </div>
                        </div>
                        <div class="info_card_wrap">
                            <div class="info_card_descr"><?= $properties['ALCO']['VALUE']; ?>%</div>
                            <div class="info_card_descr"><?= $properties['IBU']['VALUE']; ?> IBU</div>
                        </div>
                    </div>
                </a>
	<?php 
	if ($count_elem == 4) { // если счетчик достиг 4
		break;
	}
}; ?>			
</div>
  </div>`
})
app.component('tab-1', {
  template: `<div class="demo-tab">
  <p><?= $arResult['PREVIEW_TEXT']; ?></p>
  </div>`
})
app.component('tab-2', {
  template: `<div class="demo-tab">Пабы, в которых можно попробовать данное пиво</div>`
})
app.component('tab-3', {
  template: `<div class="demo-tab">Фотоотзывы пока отсуствуют</div>`
})

app.mount('#dynamic-component-demo')
</script>