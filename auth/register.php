<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:main.register",
    ".default",
    array(
        "AUTH" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "REQUIRED_FIELDS" => array(
            0=>"EMAIL",
            1=>"NAME",
            2=>"LAST_NAME",
            3=>"PERSONAL_PHONE",
        ),
        "SET_TITLE" => "Y",
        "SHOW_FIELDS" => array(
            0=>"EMAIL",
            1=>"NAME",
            2=>"LAST_NAME",
            3=>"PERSONAL_PHONE",
            4=>"WORK_COMPANY",
            5=>"WORK_PHONE",
        ),
        "SUCCESS_PAGE" => "/auth/",
        "USER_PROPERTY" => array(),
        "USER_PROPERTY_NAME" => "",
        "USE_BACKURL" => "N"
    )
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>