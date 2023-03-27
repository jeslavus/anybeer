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
$productId = $request->getPost('productId');

if (empty($productId)) {
    die();
}

$siteId = Context::getCurrent()->getSite();
$fUserId = Fuser::getId();
$basket = Basket::loadItemsForFUser($fUserId, $siteId);
$item = $basket->getExistsItem('catalog', $productId);
if (!$item) {
    $item = $basket->createItem('catalog', $productId);
    $item->setFields([
        'QUANTITY' => 1,
        'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
        'LID' => $siteId,
        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
    ]);
} else {
    $item->setField('QUANTITY', $item->getQuantity() + 1);
}
$basket->save();
echo 'success';
?>