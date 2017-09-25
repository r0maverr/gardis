<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["FLASH"]=="Y"):?>
	<div id="header_banner">
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="<?=$arResult["PICTURE"]["WIDTH"]?>" height="<?=$arResult["PICTURE"]["HEIGHT"]?>">
		<param name=movie value="<?=$arResult["PICTURE"]["SRC"]?>">
		<param name=quality value=high>
		<embed src="<?=$arResult["PICTURE"]["SRC"]?>" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="<?=$arResult["PICTURE"]["WIDTH"]?>" height="<?=$arResult["PICTURE"]["HEIGHT"]?>"></embed></object> 
	</div>
<?else:?>
	<div id="header_banner">
		<a href="<?=$arResult["HREF"]?>"><img src="<?=$arResult["PICTURE"]["SRC"]?>" width="<?=$arResult["PICTURE"]["WIDTH"]?>" height="<?=$arResult["PICTURE"]["HEIGHT"]?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" /></a>
	</div>
<?endif;?>