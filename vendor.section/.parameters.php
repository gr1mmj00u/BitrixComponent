<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = Array();
$db_iblock_type = CIBlockType::GetList(Array("SORT"=>"ASC"));
while($arRes = $db_iblock_type->Fetch())
{
	if($arIBType = CIBlockType::GetByIDLang($arRes["ID"], LANG))
	{
		$arTypesEx[$arRes["ID"]] = $arIBType["NAME"];
	}
}
$arIBlocks = Array();
	$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
	while($arRes = $db_iblock->Fetch()){
		$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
	}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS"  =>  array(
		"IBLOCK_TYPE"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => "",
			"MULTIPLE" => "Y",
		),
		"DETAIL_URL" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("IBLOCK_DETAIL_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "vendor/vendor_detail.php?CODE_VENDOR=#CODE_VENDOR#",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>300),
	),
);
?>
