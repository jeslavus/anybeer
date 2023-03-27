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


if ($productId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID', 'console' => $productId]);
    exit;
}

$basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId);
$item = $basket->getExistsItem('catalog', $productId);

if (!$item) {
    echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
    exit;
}

$item->delete();

$basket->save();

echo json_encode(['success' => true]);
?>