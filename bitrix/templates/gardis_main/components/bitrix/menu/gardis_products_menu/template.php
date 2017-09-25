<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (!empty($arResult)):?>
	<ul id="product_menu_list">
		<?foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
				continue;?>
			<?if($arItem["SELECTED"]):?>
				<li class="act"><a <?if($APPLICATION->GetCurPage()=='/products/'):?>rel="ReplaceContentProduct"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a <?if($APPLICATION->GetCurPage()=='/products/'):?>rel="ReplaceContentProduct"<?endif;?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endforeach?>
	</ul>
<?endif?>