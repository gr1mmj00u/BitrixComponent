<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;

if($this->StartResultCache(false, array($USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	$arSelect = Array(
		"ID",
		"NAME",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"DETAIL_TEXT",
		//"DETAIL_TEXT_TYPE",
		"PREVIEW_TEXT",
		//"PREVIEW_TEXT_TYPE",
		//"DETAIL_PICTURE",
		//"ACTIVE_FROM",
		//"LIST_PAGE_URL",
	);

	$arFilter = array(
		//"ID" => $arParams["ELEMENT_ID"],
		"CODE" => $arParams["CODE_VENDOR"],
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		//"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		//"SHOW_HISTORY" => "N",
	);

	$rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);


	if($obElement = $rsElement->GetNextElement())
	{
		$arResult = $obElement->GetFields();
		$arProps = $obElement->GetProperties();

	    $arItemFilter = array(
	    	"ACTIVE" => "Y",
	    	"CHECK_PERMISSIONS" => "Y",
	    	"IBLOCK_ID" => $arProps["ITEM_VENDOR"]["LINK_IBLOCK_ID"],
	    );

	    $arItemSelect = array(
	    	"ID",
			"NAME",
			"IBLOCK_ID",
			"CODE",
	    );

	    if($arProps["ITEM_VENDOR"]["VALUE"]!= NULL) {
		    foreach ($arProps["ITEM_VENDOR"]["VALUE"] as $key => $value) {
		    	$arItemFilter["ID"][] = $value;
		    }	

	    	$itemElement = CIBlockElement::GetList(array(),$arItemFilter, false,false,$arItemSelect);
	    	$i = 0;
	    	while($obItemElement = $itemElement->GetNextElement())
				{
					$arItemFields = $obItemElement->GetFields();
					$arResult["ITEMS"][$i]["NAME_ITEM"] = $arItemFields["NAME"];
					$arResult["ITEMS"][$i]["DETAIL_ITEM_URL"] = htmlspecialchars(str_replace(array("#SERVER_NAME#", "#SITE_DIR#", "#CODE_VENDOR#", "#CODE_ITEM#"),
																		array(SITE_SERVER_NAME, SITE_DIR, $arParams["CODE_VENDOR"], $arItemFields["CODE"]),
																		$arParams["DETAIL_URL"]));
					$i++;
				}

			$i = 0;
			foreach ($arProps as $key => $value) {
				$arResult["PROPERTY"][$i]["NAME"] = $value["NAME"]; 
				$arResult["PROPERTY"][$i]["VALUE"] = $value["VALUE"]; 
				$i++;
			}
			$this->IncludeComponentTemplate();
	    } else {
			$this->IncludeComponentTemplate();
	    	$this->AbortResultCache();
			ShowError("Товаров нету");
			@define("ERROR_404", "Y");
	    }
	}
}
else {
	$this->AbortResultCache();
	ShowError(GetMessage("T_NEWS_DETAIL_NF"));
	@define("ERROR_404", "Y");
}
?>
