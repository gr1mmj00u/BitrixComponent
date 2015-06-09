<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//PR($arParams);
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 300;

$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
if(strlen($arParams["DETAIL_URL"])<=0)
	$arParams["DETAIL_URL"] = "vendor/?CODE_VENDOR=#CODE_VENDOR#&CODE_ITEM=#CODE_ITEM#";


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
		"IBLOCK_TYPE" => $arParams["IBLOCK_ITEM_TYPE"],
		"IBLOCK_ID"=> $arParams["IBLOCK_ITEM_ID"],
		"CODE" => $arParams["CODE_ITEM"],
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);

	$arOrder = array();
	$arResult=array(
		"ITEMS"=>array(),
	);

	$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

	if($obElement = $rsItems->GetNextElement()) 
	{
		$arResult = $obElement->GetFields();
		$arProps = $obElement->GetProperties();

		$i = 0;
		foreach ($arProps as $key => $value) {
			$arResult["PROPERTY"][$i]["NAME"] = $value["NAME"]; 
			$arResult["PROPERTY"][$i]["VALUE"] = $value["VALUE"]; 
			$i++;
		}

		$this->IncludeComponentTemplate();

	} else {
		$this->AbortResultCache();
		ShowError("Товар не найден");
		@define("ERROR_404", "Y");
	}

}
?>

