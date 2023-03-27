<?

global $USER;

$user_id = $USER->GetID();
$isAuth = $USER->IsAuthorized();
$user_name;

//Получаем данные нужного элемента инфоблока "Пивовары"
CModule::IncludeModule("iblock");

$arFilter = array(
    "IBLOCK_ID" => 4,
    "PROPERTY_USER_ID" => $user_id,
);
$rsItems = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "NAME"));

while($arItem = $rsItems->GetNext()) {
	$user_name =  $arItem["NAME"];
}

?>
<?if($isAuth):

?>
<div class="verification_wrap">
	<?php if($_SERVER['REQUEST_URI'] == `/personal/`){ ?>
	<p class="reg_btn wow fadeIn verif_btn" id="profile_link" href="/personal/">
		<?php showSvg("profile"); ?>
		<?= $user_name; ?>
	</p>
	
	<?php }else{ ?>
	<a class="reg_btn wow fadeIn verif_btn" id="profile_link" href="/personal/">
		<?php showSvg("profile"); ?>
		<?= $user_name; ?>
	</a>
	<?php }; ?>
	<!-- <a href="?logout=yes&<?=bitrix_sessid_get();?>" class="enter_btn service_flex_item verif_btn">Выход</a> -->
</div>
<?else:?>
<div class="verification_wrap">
	<a href="/registration/" class="reg_btn wow fadeIn verif_btn">Регистрация</a>
	<button class="enter_btn service_flex_item wow fadeIn verif_btn" href="/auth/" data-fancybox="" data-type="ajax" data-src="/local/ajax/auth.php"><span>вход</span></button>
</div>
<?endif;?>