<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div>
	<?if($arParams["DISPLAY_NAME"]!="N" && strlen($arResult["NAME"]) > 0):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>

 	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?=$arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?=$arResult["PREVIEW_TEXT"];?>
	<?endif;?>

	<?foreach ($arResult["PROPERTY"] as $key => $value):?>
		<?if(isset($value["NAME"])):?>
			<h4><?=$value["NAME"]?></h4>
			<p><?=$value["VALUE"]?></p>
		<?endif;?>

	<?endforeach;?>

	<br />
	<h3>Список товаров поставщика</h3>
	<?if(isset($arResult["ITEMS"])):?>
		<ul>
		<?foreach ($arResult["ITEMS"] as $key => $value):?>
			<li><a href="<?=$value["DETAIL_ITEM_URL"]?>"><?=$value["NAME_ITEM"]?></a></li>
		<?endforeach;?>
		</ul>
	<?endif;?>
</div>
