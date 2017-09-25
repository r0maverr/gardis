<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
	.brandsSlider__imgContainer:before {display:none !Important;}
</style>
<ul id="brandsSlider" class="brandsSlider">
<?$ii=0;$open=0;?>
<?foreach($arResult["ITEMS"] as $ai => $arItem){//echo ($ii%3);?>
	<?if ( ($ii%3) == 0){?>
	<li class="brandsSlider__item">
	<?$open=1;}?>
		<div class="brandsSlider__imgContainer" title="<?=$arItem["NAME"]?>" style="position:relative;display:table;width:240px;height:100px;padding:15px;background:white;" >
			<div style="background-repeat: no-repeat!important;background-position: center;background-size: contain;width: 100%;height: 100px;background-image:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>');" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>">
</div>
</div>
<?if (($ii%3 == 2)&&($open == 1)){?>
	</li>
	<?$open=0;}?>
<?$ii++;}?>
</ul>