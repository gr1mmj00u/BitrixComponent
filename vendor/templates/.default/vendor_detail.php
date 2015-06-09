<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("my:vendor.company","",Array(
		"IBLOCK_TYPE" => $arResult["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arResult["IBLOCK_ID"],
		"IBLOCK_ITEM_TYPE"	=>	$arResult["IBLOCK_ITEM_TYPE"],
		"IBLOCK_ITEM_ID"	=> $arResult["IBLOCK_ITEM_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["item_detail"],
		"CODE_VENDOR" => $arResult["VARIABLES"]["CODE_VENDOR"],
	),
	$component
);?>

