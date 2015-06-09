<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = array();
$rsIBlockType = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
while ($arr=$rsIBlockType->Fetch())
{
	if($ar=CIBlockType::GetByIDLang($arr["ID"], LANGUAGE_ID))
	{
		$arIBlockType[$arr["ID"]] = "[".$arr["ID"]."] ".$ar["NAME"];
	}
}

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"CODE_VENDOR" => Array ("NAME" =>"Код продавца"),
			"CODE_ITEM" => Array ("NAME" => "Код товара"),
		),
		"SEF_MODE" => Array(
			"vendor" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_VENDOR"),
				"DEFAULT" => "",
				"VARIABLES" => array(),
			),
			"vendor_detail" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_VENDOR_DETAIL"),
				"DEFAULT" => "#CODE_VENDOR#/",
				"VARIABLES" => array("CODE_VENDOR"),
			),
			"item_detail"=>array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_ITEM_DETAIL"),
				"DEFAULT" => "#CODE_VENDOR#/#CODE_ITEM#/",
				"VARIABLES" => array("CODE_VENDOR","CODE_ITEM"),
			),
		),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"IBLOCK_ITEM_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ITEM_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ITEM_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ITEM_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
	),
);

?>
