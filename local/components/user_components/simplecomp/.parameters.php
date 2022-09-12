<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_CAT_IBLOCK_ID"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		),
        "NEWS_IBLOCK_ID" => array(
            "NAME" => GetMessage("SIMPLECOMP_NEWS_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ),
        "PRODUCTS_IBLOCK_ID_PROPERTY" => array(
            "NAME" => GetMessage("SIMPLECOMP_CAT_PROPERTY_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ),
        "ELEMENT_PER_PAGE" => array(
            "NAME" => GetMessage("ELEMENT_PER_PAGE"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => 2
        ),
        "CACHE_TIME"  =>  array(
            "DEFAULT" => 36000000
        ),
	),
);