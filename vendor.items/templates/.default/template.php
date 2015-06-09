<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Описание товара</h2>

<?foreach ($arResult["PROPERTY"] as $key => $value):?>
	<?if(isset($value["NAME"])):?>
			<h4><?=$value["NAME"]?></h4>
			<p><?=$value["VALUE"]?></p>
	<?endif;?>
<?endforeach;?>