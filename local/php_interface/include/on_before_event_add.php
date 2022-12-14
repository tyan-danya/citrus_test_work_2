<?php
AddEventHandler('main', 'OnBeforeEventAdd', "OnBeforeEventAddHandler");

function OnBeforeEventAddHandler(&$event, &$lid, &$arFields, &$messageId, &$files, &$languageId)
{
    global $USER;

    if ($USER->IsAuthorized()) {
        $arFields["AUTHOR"] = 'Пользователь авторизован: ' . $USER->GetID() . ' (' . $USER->GetLogin() . ') ' . $USER->GetFullName() . ', данные из формы: ' . $arFields["AUTHOR"];
    } else {
        $arFields["AUTHOR"] = 'Пользователь не авторизован, данные из формы: ' . $arFields["AUTHOR"];
    }

    CEventLog::Add(array(
        "SEVERITY" => 'SECURITY',
        "AUDIT_TYPE_ID" => 'FEEDBACK_FORM',
        "MODULE_ID" => 'main',
        "ITEM_ID" => $messageId,
        "DESCRIPTION" => 'Замена данных в отсылаемом письме – ' . $arFields["AUTHOR"],
    ));
}