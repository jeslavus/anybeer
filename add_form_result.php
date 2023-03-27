<?
	 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
	 define("NO_KEEP_STATISTIC", true);
	 define("NOT_CHECK_PERMISSIONS", true);
	 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	 LocalRedirect("/personal/index.php");
	 ?>
 
	 <?
	 if (!empty($_REQUEST['name'])) {
 
	   CModule::IncludeModule('iblock');
 
	//    echo 'Вот такие данные мы передали';
	//    echo '<pre>';
	//    print_r($_POST);
	//    echo '<pre>';
 
	global $USER;
	   $el = new CIBlockElement;
	   $iblock_id = 6;
	   $section_id = false;
	   $section_id[$i] = $_POST['section_id']; //Разделы для добавления
 
	   //Свойства
	   $PROP = array();
 
	   $PROP['USER_ID'] = $_POST['id']; //Свойство Строка
	   $PROP['IBU'] = $_POST['ibu']; //Свойство Строка
	   $PROP['OG'] = $_POST['og']; //Свойство Строка
	   $PROP['ALCO'] = $_POST['alco']; //Свойство Строка
	   $PROP['PRICE'] = $_POST['price']; //Свойство Строка
	   $PROP['BEER_TYPE'] = $_POST['beer_type'];
	   $PROP['AVAILABILITY'] = $_POST['avai']; //Свойство список
	   $PROP['OPACITY'] = $_POST['opacity']; //Свойство список
	   $PROP['COLOR'] = $_POST['color']; //Свойство список
	   $PROP['TARA'] = $_POST['tara']; //Свойство список
 
	   //Основные поля элемента
	   $fields = array(
	     "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
	     "CREATED_BY" => $GLOBALS['USER']->GetID(),  //Передаем ID пользователя кто добавляет
	     //"IBLOCK_SECTION" => $section_id[$i], //ID разделов
	     "IBLOCK_ID" => $iblock_id, //ID информационного блока он 24-ый
	     "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств
	     "NAME" => strip_tags($_REQUEST['name']),
		 'CODE' => CUtil::translit($name, 'ru', array("replace_space"=>"_","replace_other"=>"_")),
	     "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
	     "PREVIEW_TEXT" => strip_tags($_REQUEST['description']), //Анонс
	     "PREVIEW_PICTURE" => $_FILES['image'], //изображение для анонса
	     "DETAIL_TEXT"  => strip_tags($_REQUEST['description_detail']),
	     "DETAIL_PICTURE" => $_FILES['image_detail'] //изображение для детальной страницы
	   );

	   
	  
	   //Результат в конце отработки
	   if ($ID = $el->Add($fields)) {
	     //echo "Сохранено";
		 // добавляем цену к элементу
		 $priceFields = [
			'PRODUCT_ID' => $ID,
			'CATALOG_GROUP_ID' => 1, // замените на нужный вам ID ценовой группы
			'PRICE' => $_POST['price'],
			'CURRENCY' => 'RUB',
			];
			CPrice::Add($priceFields);
		 echo 'успех';
	   } else {
	     echo 'Не сохранено';
	   }
	 }
	 ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>