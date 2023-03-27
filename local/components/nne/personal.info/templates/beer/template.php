<?php 

$user_id = $arResult['USER']['ID'];
$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_USER_ID"=> $user_id);
$arSelect = Array("ID", "IBLOCK_ID", "ACTIVE", "NAME", 'PREVIEW_TEXT', 'PROPERTY_CITY', 'PROPERTY_YEAR', 'PROPERTY_RATING', 'PREVIEW_PICTURE');
$brew = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if ($ob = $brew->GetNextElement()){; // переходим к след элементу, если такой есть
    $arFields = $ob->GetFields(); // поля элемента
   }

?>

<style>
    .banner {
        padding: 8px;
        border-radius: 16px;
        background-color: #F6F6F6;
        margin: 16px 0;
        text-align: center;
    }
    .banner p {
        margin: 0;
    }
</style>
<script>
  
  //Показ картинки, которую загурзили в input file
    function uploadImg(img){
          img.onchange = function(event) {
          var target = event.target;
  
          if (!FileReader) {
              alert('FileReader не поддерживается');
              return;
          }
  
          if (!target.files.length) {
              alert('Ничего не загружено');
              return;
          }
  
          var fileReader = new FileReader();
          fileReader.onload = () => {
              img1.src = fileReader.result;
          }
  
          fileReader.readAsDataURL(target.files[0]);
          }
    };

    function stepsSend(next, prev){
        next.click(function(){
            
            var allFieldsFilled = true;

            $(".first_step input, .first_step select, .first_step textarea").each(function() {
              if($(this).val() === "") {
                $(this).after('<p class="alert_p">Заполните поле</p>');
                $(this).addClass('alert_input');
                setTimeout(()=>{
                    $(".first_step input, .first_step select, .first_step textarea").removeClass('alert_input');
                }, 3500)
                allFieldsFilled = false;
              }else{
                $(this).siblings('.alert_p').remove();
              }
            });

            if(allFieldsFilled) {
                $('.first_step').css({'display' : 'none'});
                $('.second_step').css({'display' : 'block'});
            };
        });

        prev.click(function(){
            $('.first_step').css({'display' : 'block'});
            $('.second_step').css({'display' : 'none'});
        });
    }
  
    function sendForm(elem, method){
        elem.submit(function(e) {
            var allFieldsFilled = true;
            e.preventDefault();

            var data = new FormData(this);
        
            if(method == 'edit'){

                $.ajax({
                  type: 'POST',
                  url: '/ajax/editItem.php',
                  data: data,
                  dataType: 'json',
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    if (response.success) {
                        document.location.reload();
                        //console.log(data);
                    } else {
                      console.log('Ошибка: ' + response.error_message);
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ошибка AJAX запроса: ' + textStatus + ' ' + errorThrown);
                  }
                });

            }else{
                $(".second_step input, .second_step select, .second_step textarea").each(function() {
                    if($(this).val() === "") {
                        $(this).addClass('alert_input');
                        setTimeout(()=>{
                            $(".second_step input, .second_step select, .second_step textarea").removeClass('alert_input');
                        }, 3500)
                        allFieldsFilled = false;
                    };
                });
                console.log(allFieldsFilled);
                if(allFieldsFilled){
                    $.ajax({
                      type: 'POST',
                      url: '/ajax/addProduct.php',
                      data: data,
                      dataType: 'json',
                      contentType: false,
                      processData: false,
                      success: function(response) {
                        if (response.success) {
                            document.location.reload();
                        } else {
                          console.log('Ошибка: ' + response.error_message);
                        }
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Ошибка AJAX запроса: ' + textStatus + ' ' + errorThrown);
                      }
                    });
                }
            }
        });
    };
</script>
<section class="pub_page" id="dynamic-component-demo">
    <div class="container blocks_wrap">
		<div class="left_block left_bg">
			<div class="left_block_wrap">
				<div class="profile">
                <?php if($arFields['ACTIVE'] == 'N'){ ?>
                            <div class="banner">
                                <h4>Ваша пивоварня и товары скрыты от глаз пользователей</h4>
                                <p>Всё можно изменить в разделе <br>"моя пивоварня"</p>
                            </div>
                        <?php }; ?>
					<div class="profile_name_wrap">
                        <?php if(CFile::GetPath($arFields["PREVIEW_PICTURE"])){ ?>
                        <img src="<?= CFile::GetPath($arFields["PREVIEW_PICTURE"]); ?>" alt="" class="profile_img">
                        <?php }else{ 
                            showSvg("profile_pic_1"); 
                        }; ?>
						<h4 class="profile_h">
                            <?= $arFields['NAME']; ?>
						</h4>
					</div>
					<a href="?logout=yes&<?=bitrix_sessid_get();?>" class="exit_profile">
						<?php showSvg("exit_1"); ?>
						<span>Выйти из профиля</span>
					</a>
				</div>

				<div class="treaty">
					<p class="treaty_descr">Для дальнейшей покупки пива<br> заключите с нами договор</p>
					<button class="subscribe_btn btn-standart wow fadeIn">Подписаться</button>
				</div>
				<div class="pub_page_items_wrap">
					<div class="pub_beer_items_wrap">
						<h4 class="beer_items_title">Пиво</h4>
                        <button
                            v-for="value in beer"
                            v-bind:key="value"
                            v-bind:class="['pub_item_descr', { active_pub_item_descr: currentTab == value.url }]"
                            v-on:click="currentTab = value.url"
                            >
							<span v-html="value.svg"></span>
                            {{ value.text }}
                        </button>
					</div>
					<div class="information_pub_items_wrap pub_beer_items_wrap">
						<h4 class="beer_items_title">Заказы</h4>
                        <button
                            v-for="value in orders"
                            v-bind:key="value"
                            v-bind:class="['pub_item_descr', { active_pub_item_descr: currentTab == value.url }]"
                            v-on:click="currentTab = value.url"
                            >
                            <span v-html="value.svg"></span>
                            {{ value.text }}
                        </button>
					</div>
					<div class="information_pub_items_wrap">
						<h4 class="beer_items_title">Информация</h4>
                        <button
                            v-for="value in information"
                            v-bind:key="value"
                            v-bind:class="['pub_item_descr', { active_pub_item_descr: currentTab == value.url }]"
                            v-on:click="currentTab = value.url"
                            >
                            <span v-html="value.svg"></span>
                            {{ value.text }}
                        </button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container blocks_wrap blocks_wrap_pub">
        
        <div class="right_block">
            <component v-bind:is="currentTabComponent" class="tab"></component>
        </div>
    </div>
        <!--<div class="right_block_brewery">
            <div class="brewery_blog_card card">
                <h3>Марки пива в моём пабе <span>(0)</span></h3>
                <p>Сейчас у ваш нет выбранных марок пива, перейдите в каталог и добавьте то пиво, которое у вас есть в наличии. Если вас заинтересовал какой-то продукт, но его пока нет вналичии в вашем пабе, но вы хотите его заказать — добавьте его в каталог своего паба и пивовар свяжется с вами для уточнения деталей заказа.</p>
                <button class="brewery_blog_btn btn-standart wow fadeIn">Выбрать</butt>
            </div>
            <div class="brewery_blog_card card">
                <h3>Партнёры-пивовары <span>(0)</span></h3>
                <p>Сейчас у ваш нет партнёров-пивоваров, но вы можете связаться с ними, переудя в каталог пивоварен.</p>
                <button type="button" class="brewery_blog_btn btn-standart">добавить бар</button>
            </div>
        </div>-->
    </div>
</section>
<script type="text/javascript">

const app = BX.Vue3.BitrixVue.createApp({
  data() {
    return {
        currentTab: 'test-1',
        beer: [
            { text: 'Мои товары', url: 'test-1', svg: `<?php showSvg("add-beer"); ?>` }, 
            { text: 'Добавить товар', url: 'test-2', svg: `<?php showSvg("add-beer-plus"); ?>` },
        ],
        orders: [
            { text: 'Список заказов', url: 'test-3', svg: `<?php showSvg("bill"); ?>` }, 
            { text: 'Возвраты', url: 'test-4', svg: `<?php showSvg("vozvrat"); ?>` },
        ],
        information: [
            { text: 'Моя пивоварня', url: 'test-5', svg: `<?php showSvg("user_manufactory"); ?>` }, 
            { text: 'Условия работы', url: 'test-6', svg: `<?php showSvg("profile"); ?>` },
            { text: 'Бухгалтерские документы', url: 'test-7', svg: `<?php showSvg("doc"); ?>` },
        ]
    }
  },
  computed: {
    currentTabComponent() {
      return this.currentTab
    }
  }
})

app.component('test-1', {
  template: `<div class="demo-tab">
  <?php
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
?>

  <h2>Мои товары</h2>
            <?php if($count_beer > 0) { ?>
            <div class="my_items_table_descr">
                <p>Показывается: <?= $count_beer; ?> из <?= $count_beer; ?> товаров</p>
                <button class="service_flex_item filter_table_btn">
                    <span>все товары</span>
                    <?php //require "assets/svg/arrow_menu.php"; ?>
                </button>
            </div>
            <table class="my_items_table">
                <tr>
                    <td></td>
                    <td>Фото</td>
                    <td>Наименование товара</td>
                    <td>Тара</td>
                    <td>Объём</td>
                    <td>Цена за 1 шт. <br>в рублях</td>
                    <td>Наличие</td>
                </tr>
				<?php 
				// Проходим по каждому элементу и выводим его свойства
				while ($element = $elements->GetNextElement()) :
					$properties = $element->GetProperties();
					$arFields_item = $element->GetFields();
					//echo "<pre>";
					//print_r($properties['USER_ID']);
					//echo "</pre>";
					$ar_res = CPrice::GetBasePrice($arFields_item['ID']);
				?>
                <tr>
                    <td>
                        <?php //require "assets/svg/edit.php"; ?>
						<?php showSvg("edit"); ?>
                    </td>
                    <td>
                        <img class='my_items_img' src="<?= CFile::GetPath($arFields_item["PREVIEW_PICTURE"]); ?>" alt="">
                    </td>
                    <td>Пиво «<?= $arFields_item['NAME'];?>»</td>
                    <td>
                        <?php //require "assets/svg/bottle.php"; ?>
						<?php showSvg("bottle"); ?>
                    </td>
                    <td><?= $properties['TARA']['VALUE'];?>л.</td>
                    <td class="price_parent">
                        <input type="number" class="price price_gray" value="<?= round($ar_res["PRICE"]);?>">
                    </td>
                    <td>
                        <button class="service_flex_item table_btn">
                            <span>не выбрано</span>
                            <?php //require "assets/svg/arrow_menu.php"; ?>
                        </button>
                        <div class="dropdown_menu_header">
                            <span>в наличии</span>
                            <span>черновик</span>
                            <span>в архиве</span>
                            <span>нет в наличии</span>
                        </div>
                    </td>
                </tr>
				<?php endwhile; ?>
            </table>
            <div class="save_and_reset">
                <button class="btn-standart">Сохранить изменения</button>
                <button class="btn-standart">Сбросить</button>
            </div>
            <?php }else{ ?>
            <h2>У вас пока нет товаров</h2>
            <?php };?>
  </div>`
})
app.component('test-2', {
  mounted: function(){
    uploadImg(myImg);
    stepsSend($('#next_step'), $('#prev_step'));
    sendForm($('#addProductForm'), 'add');
  },
  template: `<div class="demo-tab">
  <h2>Добавить товар</h2>
            <form method="POST" enctype="multipart/form-data" id="addProductForm">
                <div class="first_step">
                    <ul class="inputs_registration_wrap">
                    <li class="inputs_item" style="display:none;">
                        <input class="input_registration" type="text" name="id" value="<?= $USER->GetID();?>">
                    </li>
                    <li class="inputs_item">
                        <span>Название пива:</span>
                        <input class="input_registration" type="text" placeholder="Пивасик" name="name" maxlength="255" value="">
                    </li>
                    <li class="inputs_item">
                        <span>Тип пива:</span>
                        <select class="input_registration" name='beer_type'>
                            <option  disabled>Выберите из списка</option>
	                        <option  value="16">Лагер</option>
	                        <option  value="17">Ипа</option>
		                    <option  value="18">Апа</option>
                        </select>
                    </li>
                    <li class="inputs_item">
                        <span>Прозрачность:</span>
                        <select class="input_registration" name='opacity'>
                            <option disabled value="">Выберите один из вариантов</option>
	                        <option value="19">Фильтрованное</option>
	                        <option value="20">Нефильтрованное</option>
                        </select>
                    </li>
                    <li class="inputs_item">
                        <span>Алкоголь</span>
                        <input class="input_registration" type="text" placeholder="5.44%" name="alco" maxlength="255" value="">
                    </li>
                    <li class="inputs_item">
                        <span>IBU:</span>
                        <input class="input_registration" type="text" placeholder="60" name="ibu" maxlength="255" value="">
                    </li>
                    <li class="inputs_item">
                        <span>Начальная плотность (OG):</span>
                        <input class="input_registration" type="text" placeholder="60" name="og" maxlength="255" value="">
                    </li>
                    <li class="inputs_item photo_item">
                        <span>Добавить фото:</span>
                        <label>
                            <div class="add_file">
                            <?php showSvg("photo_add_beer"); ?>
                            </div>
                            <input type="file" name="image" value='' style="display:none;" id='myImg'>
                            <img src="" alt="" id='img1'>
                        </label>
                    </li>
                    </ul>
                    <button class="btn-standart" id="next_step" type="button">Продолжить</button>
                </div>
                <div class="second_step" style="display:none;">
                    <h2>Установите цену и наличие товара</h2>
                    <ul class="add_item_second_step">
                        <li class="inputs_item">
                            <span>Тара:</span>
                            <select class="input_registration" name="tara">
                                <option disabled>Выберите из списка</option>
	                            <option value="23">0.3</option>
	                            <option value="24">0.5</option>
                            </select>
                        </li>
                        <li class="inputs_item">
                            <span>Стоимость:</span>
                            <div class="service_flex_item">
                                <input type="text" class="input_registration" name="price" maxlength="255" value="">
                            </div>
                        </li>
                        <li class="inputs_item">
                            <span>Наличие:</span>
                            <select class="input_registration" name="avai">
                                <option disabled>Выберите из списка</option>
	                            <option value="25">В наличии</option>
	                            <option value="26">Нет в наличии</option>
                            </select>
                        </li>
                    </ul>
                    <div class="second_step_btn_wrap">
                        <button type="submit" class="btn-standart">опубликовать пиво</button>
                        <button type="button" class="btn-standart second_btn-standart" id="prev_step">
                            <?php //require "assets/svg/back-arr.php"; ?>
                            <span>Вернуться к прошлому шагу</span>
                        </button>
                    </div>
                </div>
            </form>

  </div>`,
})
app.component('test-3', {
  template: `<div class="demo-tab"><h2>Список заказов</h2></div>`
})
app.component('test-4', {
  template: `<div class="demo-tab"><h2>Возвраты</h2></div>`
}) 
app.component('test-5', {
    mounted: function(){
        uploadImg(myImg);
        sendForm($('#formEditElement'), 'edit');
    },
    template: `<div class="demo-tab">
    <h2>Моя пивоварня</h2>
<form method="POST" enctype="multipart/form-data" id="formEditElement">
                    <ul class="inputs_registration_wrap">
                    <input type="hidden" name="ELEMENT_ID" value="<?= $arFields['ID']; ?>">
                    <input type="hidden" name="USER_ID" value="<?= $user_id; ?>">
                    <input type="hidden" name="RATING" value="<?= $arFields['PROPERTY_RATING_VALUE']; ?>">
                    <li class="inputs_item">
                        <span>Название пивоварни:</span>
                        <input class="input_registration" type="text" value="<?= $arFields['NAME']; ?>" name="NAME" maxlength="255" value="">
                    </li>
                    <li class="inputs_item">
                        <span>Город:</span>
                        <input class="input_registration" type="text" name="CITY" maxlength="255" value="<?= $arFields['PROPERTY_CITY_VALUE']; ?>">
                    </li>
                    <li class="inputs_item">
                        <span>Год основания:</span>
                        <input class="input_registration" type="text" name="YEAR" maxlength="255" value="<?= $arFields['PROPERTY_YEAR_VALUE']; ?>">
                    </li>
                    <li class="inputs_item">
                        <span>Описание:</span>
                        <textarea class="input_registration" type="text" name="DESCRIPTION" maxlength="255" value="<?= $arFields['PREVIEW_TEXT']; ?>"/>
                    </li>
                    <li class="inputs_item">
                        <span>Видимость пивоварни:</span>
                        <select class="input_registration" name='ACTIVE'>
                            <option disabled value="">Выберите один из вариантов</option>
	                        <option value="Y" >Активна</option>
	                        <option value="N" <?= ($arFields['ACTIVE'] == 'N') ? 'selected' : '';?>>Не активна</option>
                        </select>
                    </li>
                    <li class="inputs_item photo_item">
                        <span>Изменить фото:</span>
                        <label>
                            <div class="add_file">
                            <?php showSvg("photo_add_beer"); ?>
                            </div>
                            <input type="file" name="PREVIEW_PICTURE" value='' style="display:none;" id='myImg'>
                            <img src="<?= CFile::GetPath($arFields["PREVIEW_PICTURE"]); ?>" alt="" id='img1'>
                        </label>
                    </li>
                    <li class="inputs_item">
                        <button type="submit" class="btn-standart">Сохранить изменения</button>
                    </li>    
                </div>
            </form>
  </div>`
})
app.component('test-6', {
  template: `<div class="demo-tab"><h2>Условия работы</h2></div>`
})
app.component('test-7', {
  template: `<div class="demo-tab"><h2>Бухгалтерские документы</h2></div>`
})
app.mount('#dynamic-component-demo')
</script>

