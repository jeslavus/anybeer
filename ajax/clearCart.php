<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Context;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Main\Loader;

if (!Loader::includeModule('sale')) {
  die();
}

$request = Context::getCurrent()->getRequest();
$bool = $request->getPost('bool') === 'true'? true: false;


$siteId = Context::getCurrent()->getSite();


$basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId);

if($bool == true){
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
    
    $basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId);
    
    while($arItem = $dbBasketItems->Fetch()) {
        $arBasketItems[] = $arItem;
    }
    foreach($arBasketItems as $arItem) { 
        //print_r($arItem);
        $item = $basket->getExistsItem('catalog', $arItem['PRODUCT_ID']);
        $item->delete();
    }
}

//$basket->clear($bool);

$basket->save();

//echo json_encode(['success' => true]);
?>

