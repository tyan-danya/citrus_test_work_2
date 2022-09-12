<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

if (!isset($arParams["PRODUCTS_IBLOCK_ID"]))
    $arParams["PRODUCTS_IBLOCK_ID"] = 0;

if (!isset($arParams["NEWS_IBLOCK_ID"]))
    $arParams["NEWS_IBLOCK_ID"] = 0;


    $arNews = array();
    $arNewsID = array();

    $obNews = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
            "ACTIVE" => "Y"
        ),
        false,
        array(
            "nPageSize" => $arParams["ELEMENT_PER_PAGE"],
            "bShowAll" => true
        ),
        array(
            "NAME",
            "ACTIVE_FROM",
            "ID"
        )
    );

    while ($newsElements = $obNews->Fetch()) {
        $arNewsID[] = $newsElements["ID"];
        $arNews[$newsElements["ID"]] = $newsElements;
    }

    $arSections = array();
    $arSectionsID = array();
    // Получаем список активных разделов с привязкой к активным новостям
    $obSection = CIBlockSection::GetList(
        array(),
        array(
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "ACTIVE",
            $arParams["PRODUCTS_IBLOCK_ID_PROPERTY"] => $arNewsID
        ),
        true,
        array(
            "IBLOCK_ID",
            "ID",
            "NAME",
            $arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]
        ),
        false
    );

    while ($arSectionCatalog = $obSection->Fetch()) {
        $arSectionsID[] = $arSectionCatalog["ID"];
        $arSections[$arSectionCatalog["ID"]] = $arSectionCatalog;
    }

    $arFilterElements = array(
        "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
        "ACTIVE" => "Y",
        "SECTION_ID" => $arSectionsID
    );



    // Получаем список активных товаров из разделов
    $obProduct = CIBlockElement::GetList(
        array(
            "NAME" => "asc",
            "SORT" => "asc"
        ),
        $arFilterElements,
        false,
        false,
        array(
            "NAME",
            "ATT_PRICE",
            "ATT_MATERIAL",
            "ATT_CODE",
            "IBLOCK_SECTION_ID",
            "ID",
            "CODE",
            "IBLOCK_ID",

        )
    );
    $arResult["PRODUCT_CNT"] = 0;

    while ($arProduct = $obProduct->Fetch()) {

        $arResult["PRODUCT_CNT"] ++;
        foreach ($arSections[$arProduct["IBLOCK_SECTION_ID"]][$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newsId) {

            if (isset($arNews[$newsId]))
                $arNews[$newsId]["PRODUCTS"][] = $arProduct;
        }
    }

    foreach ($arSections as $arSection) {

        foreach ($arSection[$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newId) {

            if (isset($arNews[$newId]))
                $arNews[$newId]['SECTIONS'][] = $arSection["NAME"];
        }
    }
    $arResult["NEWS"] = $arNews;
    $this->SetResultCacheKeys(array("PRODUCT_CNT"));
    $this->includeComponentTemplate();

$APPLICATION->SetTitle(GetMessage("COUNT").$arResult["PRODUCT_CNT"]);
?>