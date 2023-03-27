<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (is_string($_REQUEST["backurl"]) && strpos($_REQUEST["backurl"], "/") === 0)
{
	LocalRedirect($_REQUEST["backurl"]);
}

if($USER->IsAuthorized()) { 
LocalRedirect('/');
};

$APPLICATION->SetTitle("Авторизация");
?>
<p>Вы зарегистрированы и успешно авторизовались.</p>
 
<p>Используйте административную панель в верхней части экрана для быстрого доступа к функциям управления структурой и информационным наполнением сайта. Набор кнопок верхней панели отличается для различных разделов сайта. Так отдельные наборы действий предусмотрены для управления статическим содержимым страниц, динамическими публикациями (новостями, каталогом, фотогалереей) и т.п.</p>
 
<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>


<?php
// ссылка для выхода из личного кабинета
$logout = $APPLICATION->GetCurPageParam(
    "logout=yes",
    array(
        "login",
        "logout",
        "register",
        "forgot_password",
        "change_password"
    )
);
?>
<p><a href="<?= $logout; ?>">Выйти</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>