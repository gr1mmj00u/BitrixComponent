<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MY_ITEM_LINE_NAME"),
	"DESCRIPTION" => GetMessage("MY_ITEM_LINE_DESC"),
	"ICON" => "/images/news_line.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "my_components",
		"SORT" => 2000,
		"NAME" => GetMessage("MY_COMPONENTS"),
	),
);

?>