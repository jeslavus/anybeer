<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");

?>

<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// Подключаем модуль sale
Bitrix\Main\Loader::includeModule("sale");

// Получаем текущего пользователя
global $USER;
if(!$USER->IsAuthorized()) {
    $userId = CSaleBasket::GetBasketUserID();
} else {
    $userId = $USER->GetID();
}

// Получаем корзину пользователя
$arBasketItems = array();
$dbBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => $userId,
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array()
);
while($arItem = $dbBasketItems->Fetch()) {
    $arBasketItems[] = $arItem;
}
?>

<section class="cart_items">
<?php 
// Выводим данные корзины на страницу
foreach($arBasketItems as $arItem) { ?>
  <div class="cart_item">
  <h3>Название: <?= $arItem["NAME"]; ?></h3>
  <p>Цена: <?= $arItem["PRICE"]; ?></p>
  <p>Количество: <?= $arItem["QUANTITY"]; ?></p>
  <button class="delete-item" data-product-id="<?= $arItem["PRODUCT_ID"]; ?>">Удалить pivas</button>
  <hr>
  </div>
  <?php }; ?>
  <button id="clearBasketBtn">Очистить корзину</button>


</section>

<script>
$(document).ready(function() {
  $('.delete-item').on('click', function() {
    var productId = $(this).data('product-id'),
        div = $(this).closest('.cart_item');

    $.ajax({
      url: '/ajax/deleteItem.php',
      method: 'POST',
      data: {productId: productId},
      success: function(response) {
        div.remove();
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});

</script>

<script>
    // Определяем обработчик клика на кнопке "Очистить корзину"
$(document).ready(function() {
  $('#clearBasketBtn').on('click', function() {
    var bool = true;

    $.ajax({
      url: '/ajax/clearCart.php',
      method: 'POST',
      data: {bool: bool},
      success: function(response) {
        $('.cart_item').remove();
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});

</script>


<?php 

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>
