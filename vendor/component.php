<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arDefaultUrlTemplates404 = array(
	"vendor" => "",
	"vendor_detail" => "#CODE_VENDOR#/",
	"item_detail"=> "#CODE_VENDOR#/#CODE_ITEM#/"
);

$arDefaultVariableAliases404 = Array(
	"vendor"=>array(),
	"vendor_detail"=>array(),
	"item_detail"=>array(),
);

$arComponentVariables = Array(
	"CODE_VENDOR",
	"CODE_ITEM",
);

$arDefaultVariableAliases = Array(
	"CODE_VENDOR"=>"CODE_VENDOR",
	"CODE_ITEM"=>"CODE_ITEM",
);

if($arParams["SEF_MODE"] == "Y")
{
	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);

	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$componentPage = CComponentEngine::ParseComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	if(!$componentPage)
		$componentPage = "vendor";
	
	CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
	$arResult = array(
			"FOLDER" => $arParams["SEF_FOLDER"],
			"URL_TEMPLATES" => $arUrlTemplates,
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases,
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ITEM_TYPE" => $arParams["IBLOCK_ITEM_TYPE"],
			"IBLOCK_ITEM_ID" => $arParams["IBLOCK_ITEM_ID"],
		);
}
else
{
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);
	$componentPage = "";

//УСЛОВИЯ!!!!!!!!

	if(isset($arVariables["CODE_VENDOR"]) && strlen($arVariables["CODE_VENDOR"]) > 0 && isset($arVariables["CODE_ITEM"]) && strlen($arVariables["CODE_ITEM"]) > 0)
		$componentPage = "item_detail";
	elseif(isset($arVariables["CODE_VENDOR"]) && strlen($arVariables["CODE_VENDOR"]) > 0)
		$componentPage = "vendor_detail";
	else
		$componentPage = "vendor";

	$arResult = array(
			"FOLDER" => "",
			"URL_TEMPLATES" => Array(
				"vendor" => htmlspecialchars($APPLICATION->GetCurPage()),
				"vendor_detail" => htmlspecialchars($APPLICATION->GetCurPage())."?".$arVariableAliases["CODE_VENDOR"]."=#CODE_VENDOR#",
				"item_detail" => htmlspecialchars($APPLICATION->GetCurPage())."?".$arVariableAliases["CODE_VENDOR"]."=#CODE_VENDOR#"."&".$arVariableAliases["CODE_ITEM"]."=#CODE_ITEM#",
			),
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases,
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ITEM_TYPE" => $arParams["IBLOCK_ITEM_TYPE"],
			"IBLOCK_ITEM_ID" => $arParams["IBLOCK_ITEM_ID"],
		);
}
$this->IncludeComponentTemplate($componentPage);
?>
