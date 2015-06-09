<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("my:vendor.items", "", Array(
	"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
	"IBLOCK_ID"	=> $arResult["IBLOCK_ID"],
	"IBLOCK_ITEM_TYPE"	=>	$arParams["IBLOCK_ITEM_TYPE"],
	"IBLOCK_ITEM_ID"	=> $arResult["IBLOCK_ITEM_ID"],
	"CODE_ITEM" => $arResult['VARIABLES']['CODE_ITEM'],
	"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["item_detail"],
	"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
	"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
	),
	$component
);?>