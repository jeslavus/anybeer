<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!Loader::includeModule('iblock')) {
    echo Json::encode(array(
        'success' => false,
        'error_message' => 'Модуль инфоблоков не установлен'
    ));
    die();
}

$request = Application::getInstance()->getContext()->getRequest();
$elementId = $request->getPost('ELEMENT_ID');


if (!$elementId) {
    echo Json::encode(array(
        'success' => false,
        'error_message' => 'Не указан ID элемента'
    ));
    die();
}

$el = new CIBlockElement();
$props = array();




if ($request->getPost('NAME')) {
    $props['NAME'] = $request->getPost('NAME');
}
if ($request->getPost('YEAR')) {
    $props['PROPERTY_VALUES']['YEAR'] = $request->getPost('YEAR');
}
if ($request->getPost('DESCRIPTION')) {
    $props['PREVIEW_TEXT'] = $request->getPost('DESCRIPTION');
}
if ($request->getPost('ACTIVE')) {
    $props['ACTIVE'] = $request->getPost('ACTIVE');
}
if ($request->getPost('CITY')) {
    $props['PROPERTY_VALUES']['CITY']= $request->getPost('CITY');
}
if ($request->getPost('USER_ID')) {
    $props['PROPERTY_VALUES']['USER_ID'] = $request->getPost('USER_ID');
}
if ($request->getPost('USER_ID')) {
    $props['PROPERTY_VALUES']['RATING'] = $request->getPost('RATING');
}
if($_FILES['PREVIEW_PICTURE']['size'] > 0){
    $props['PREVIEW_PICTURE'] = $_FILES['PREVIEW_PICTURE'];
}

if (!$el->Update($elementId, $props)) {
    echo Json::encode(array(
        'success' => false,
        'error_message' => $el->LAST_ERROR
    ));
    die();
}

echo Json::encode(array(
    'success' => true
));
?>