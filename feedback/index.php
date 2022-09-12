<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.feedback",
    "bootstrap_v4",
    array(
        "COMPONENT_TEMPLATE" => "bootstrap_v4",
        "USE_CAPTCHA" => "Y",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "EMAIL_TO" => "daniil.tyan.2001@mail.ru",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
            1 => "EMAIL",
        ),
        "EVENT_MESSAGE_ID" => array(
            0 => "7",
        )
    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>