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
$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_USER_ID"=> $user_id);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", 'PREVIEW_PICTURE');
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if ($ob = $res->GetNextElement()){; 
  $arFields = $ob->GetFields();
  //print_r($arFields);
  $arProps = $ob->GetProperties(); 
  //print_r($arProps);
 }

?>

<section class="item_section">
    <div class="container">
        <figure class="item_card">
            <div class="img_item_slider">
                <picture class="img_item_slider_wrap">
                    <img src="<?= $arResult['PREVIEW_PICTURE']['SRC']; ?>" alt="">
                </picture>
                <ul class="dots_item_wrap">
                    <li class="yell_dot"></li>
                </ul>
            </div>
            <figcaption class="item_descr">
               <div class="header_item_descr_wrap">
                    <h2 class="item_card_name"><?= $arResult['NAME']; ?></h2>
                    <div class="like_card_wrap">
                        <div class="yellow_ring">1</div>
                        <div class="yellow_ring">2</div>
                        <div class="yellow_ring">3</div>
                    </div>
               </div>
               <div class="bottom_item_descr">
                    <div class="bottom_item_descr_left">
                        <div class="mini_brew">
                            <img src="<?= CFile::GetPath($arFields["PREVIEW_PICTURE"]); ?>" alt="logo-brew">
                            <!-- <button class="add-to-cart-btn" data-product-id="<?= $arResult['ID']; ?>">Добавить в корзину</button> -->
                            <div class="mini_brew_descr_wrap">
                                <h4><?= $arFields['NAME']; ?></h4>
                                <p>г. <?= $arProps['CITY']['VALUE']; ?></p>
                            </div>
                        </div>
                        <table>
                            <tr>
                                <th>Алкоголь (ABV)</th>
                                <th><?= $arResult['PROPERTIES']['ALCO']['VALUE']; ?></th>
                            </tr>
                            <tr>
                                <th>Сорт</th>
                                <th><?= $arResult['PROPERTIES']['BEER_TYPE']['VALUE']; ?></th>
                            </tr>
                            <tr>
                                <th>Прозрачность</th>
                                <th><?= $arResult['PROPERTIES']['OPACITY']['VALUE']; ?></th>
                            </tr>
                            <tr>
                                <th>Горечь (IBU)</th>
                                <th><?= $arResult['PROPERTIES']['IBU']['VALUE']; ?></th>
                            </tr>
                            <tr>
                                <th>Начальная плотность (OG)</th>
                                <th>15,65%</th>
                            </tr>
                        </table>
                        <a href="#">Найти пиво на карте</a>
                    </div>
                    <div class="bottom_item_descr_right">
                        <div class="rating_item">
                            <p>Рейтинг (AnyBeer):</p>
                            <?php //require "assets/svg/hop-star.php";?>
                            <p>Рейтинг (Untappd):</p>
                            <span>4.5</span>
                        </div>
                        <a href="#">Оставить фотоотзыв</a>
                    </div>
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
      tabs: ['Фотоотзывы', 'Где попробовать?', 'Описание']
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
Тест
  </div>`
})
app.component('tab-1', {
  template: `<div class="demo-tab">Текст о пивоварне</div>`
})
app.component('tab-2', {
  template: `<div class="demo-tab">Пабы, в которых можно попробовать данное пиво</div>`
})
app.component('tab-3', {
  template: `<div class="demo-tab">Фотоотзывы пока отсуствуют</div>`
})

app.mount('#dynamic-component-demo')
</script>
<section class="add_photo_review">
    <div class="container">
        <h2>Добавьте вашу фотографию</h2>
        <form action="">
            <label>
                <p>Ваша оценка</p>
                <?php //require "assets/svg/hop-star.php";?>
            </label>
            <label>
                <p>Паб</p>
                <input type="text" class="input_registration">
            </label>
            <label>
                <p>Комментарий:</p>
                <input type="text" class="input_registration">
            </label>
            <label>
                <span>Добавить фотографии (не более 6 шт):</span>
                <div class="add_file">
                    <div class="cross">
                        <span></span>
                        <span></span>
                    </div>
                    <?php //require "assets/svg/photo.php"; ?>
                </div>
                <input type="file">
            </label>
        </form>
    </div>
</section>

<script>
$(document).ready(function() {
  $('.add-to-cart-btn').on('click', function() {
    var productId = $(this).data('product-id');
    $.ajax({
      url: '/ajax/addToCart.php',
      method: 'POST',
      data: {productId: productId},
      success: function(response) {
        console.log(response);
        alert('Товар добавлен в корзину!');
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert('Ошибка при добавлении товара в корзину');
      }
    });
  });
});


</script>