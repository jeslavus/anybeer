<?php

// подключаем необходимые файлы
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/captcha.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/virtual_io.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/file.php');
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

// проверяем полученные данные
// if (empty($_POST['name']) || empty($_POST['price']) || empty($_FILES['photo']['name'])) {
//     die(json_encode(['success' => false, 'message' => 'Не все поля заполнены']));
// }

    CModule::IncludeModule('iblock');
// получаем параметры текущего пользователя
global $USER;

// задаем ID инфоблока
$iblockId = 6; 

// создаем экземпляр CIBlockElement
$element = new CIBlockElement;

// задаем свойства элемента
$properties = [
    'USER_ID' => $_POST['id'],
    'BEER_TYPE' => $_POST['beer_type'],
    'OPACITY' => $_POST['opacity'],
    'IBU' => $_POST['ibu'],
    'TARA' => $_POST['tara'],
    'AVAILABILITY' => $_POST['avai'],
    'ALCO' => $_POST['alco'],
    'OG' => $_POST['og'],
];

// задаем параметры для добавления элемента
$elementFields = [
    'IBLOCK_ID' => $iblockId,
    'NAME' => $_POST['name'],
    'ACTIVE' => "Y",
    'CODE' => CUtil::translit($name, 'ru', array("replace_space"=>"_","replace_other"=>"_")),
    'PROPERTY_VALUES' => $properties,
    "PREVIEW_PICTURE" => $_FILES['image']
];

// создаем элемент
if ($productId = $element->Add($elementFields)) {

    // добавляем цену к элементу
    $priceFields = [
        'PRODUCT_ID' => $productId,
        'CATALOG_GROUP_ID' => 1, // замените на нужный вам ID ценовой группы
        'PRICE' => $_POST['price'],
        'CURRENCY' => 'RUB',
    ];
    CPrice::Add($priceFields);

    // отправляем ответ клиенту
    die(json_encode(['success' => true, 'message' => 'Товар успешно добавлен']));

} else {
    // отправляем ошибку клиенту
    die(json_encode(['success' => false, 'message' => 'Ошибка при добавлении товара']));
}
?>