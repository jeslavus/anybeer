<?php
use Bitrix\Main\Loader;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!Loader::includeModule("sale")) {
    die();
}

$itemId = $_POST['item_id'];

// Находим корзину текущего пользователя
$basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), SITE_ID);

// Находим товар в корзине по ID
$item = $basket->getExistsItem('catalog', $itemId);

if ($item) {
    // Удаляем товар из корзины
    $item->delete();

    // Сохраняем изменения в корзине
    $basket->save();

    // Возвращаем обновленные данные корзины в формате JSON
    $response = array(
        'success' => true,
        'basket' => $basket->getListOfFormatText(),
        'price' => $basket->getPrice(),
    );

    echo json_encode($response);
} else {
    // Если товар не найден в корзине, возвращаем ошибку
    $response = array(
        'success' => false,
        'message' => 'Товар не найден в корзине',
    );

    echo json_encode($response);
}
?>
