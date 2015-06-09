<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("my:vendor.section", "", Array(
	"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
	"IBLOCK_ID"	=> $arResult["IBLOCK_ID"],
	"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["vendor_detail"],
	"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
	"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
	),
	$component
);?>
