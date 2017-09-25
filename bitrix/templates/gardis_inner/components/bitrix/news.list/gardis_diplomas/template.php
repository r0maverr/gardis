<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row diploms">
<?foreach($arResult["ITEMS"] as $arItem){?>
	<div class="col-xs-12 col-md-3 diplom">
		<a href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" rel="group" title="<?echo $arItem["NAME"]?>" class="fancybox">
		<img class="img-responsive" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		</a>
		<div class="ftable">
		<a class="diplom-name" href="#"><?echo $arItem["NAME"]?></a>
		</div>
	</div>
<?}?>
<div class="clear">&nbsp;</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
