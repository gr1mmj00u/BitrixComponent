<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 300;

$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
if(strlen($arParams["DETAIL_URL"])<=0)
	$arParams["DETAIL_URL"] = "vendor/?CODE_VENDOR=#CODE_VENDOR#";

if($this->StartResultCache(false, $USER->GetGroups()))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"ACTIVE_FROM",
		"DETAIL_PAGE_URL",
		"NAME",
		"CODE",
	);

	$arFilter = array (
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"=> $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);

	$arOrder = array();

	$arResult=array(
		"ITEMS"=>array(),
	);

	$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

	while($arItem = $rsItems->GetNext())
	{
		$arItem["DETAIL_PAGE_URL"] = htmlspecialchars(str_replace(array("#SERVER_NAME#", "#SITE_DIR#", "#CODE_VENDOR#", "#ELEMENT_ID#"),
																array(SITE_SERVER_NAME, SITE_DIR, $arItem["CODE"], $arItem["ID"]),
																$arParams["DETAIL_URL"]
		));
		$arResult["ITEMS"][]=$arItem;
	}

	$this->IncludeComponentTemplate();
}
?>
