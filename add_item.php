<?
	 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

	 //Подключаем модуль инфоблоков
	 CModule::IncludeModule('iblock');
	 $IBLOCK_ID = 12; //ИД инфоблока с которым работаем
	 ?>

	 <form name="add_my_ankete" action="/add_form_result.php" method="POST" enctype="multipart/form-data">

	Название
	 <input type="text" name="name" maxlength="255" value="">

	Картинка анонса
	 <input type="file" size="30" name="image" value="">

	 Свойство Строка
	 <input type="text" name="line" maxlength="255" value="">

	                    
	   Привязка к подразделам конкретного раздела другого мнфоблока чекбоксы                 
	   <?
	   $rsParentSection = CIBlockSection::GetByID(5741);
	   if ($arParentSection = $rsParentSection->GetNext()) {
	   $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'], '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'], '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
	   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
	   while ($arSect = $rsSect->GetNext()) {
	   ?>
	    <label><input name='service_dop[]' type="checkbox" value="<?= $arSect['ID']; ?>"> <?= $arSect['NAME']; ?></label>
	   <?}}?>            
	   <input type="submit" value="Отправить">
	 </form>    
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>