<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="dealers-contacts-list">
<?
//default Nsk
if ( !$_REQUEST['arrDealersFilter_pf']['TOWN']) $_REQUEST['arrDealersFilter_pf']['TOWN'] = "Новосибирск";

foreach($arResult["ITEMS"] as $arItem){
	if ($_REQUEST["arrDealersFilter_pf"]["TOWN"] != 'all'){
		if ($arItem['PROPERTIES']['TOWN']['VALUE'] != $_REQUEST["arrDealersFilter_pf"]["TOWN"]) continue;
	}else{
		break;
	}?>
	<div class="col-xs-12 col-md-4 item-diler-ar">
		<div class="row title-dil-ar"><?=$arItem["NAME"]?></div>
		<div class="row">
			<div class="col-md-7 row">
				<div><?if(strlen($arItem['PROPERTIES']['ADRESS']['VALUE'])>0):?><?=$arItem['PROPERTIES']['ADRESS']['VALUE'];?><?endif;?></div>
				<div><?if(strlen($arItem['PROPERTIES']['PHONES']['VALUE'])>0):?><?=$arItem['PROPERTIES']['PHONES']['VALUE'];?><?endif;?></div>
				<div><?if(strlen($arItem['PROPERTIES']['EMAIL']['VALUE'])>0):?><a href='mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>'><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a><?endif;?></div>
				<div><?if(strlen($arItem['PROPERTIES']['SITE']['VALUE'])>0):?><a href='http://<?=$arItem['PROPERTIES']['SITE']['VALUE'];?>' target='_blank'><?=$arItem['PROPERTIES']['SITE']['VALUE'];?></a><?endif;?></div>
			</div>
			<?if($arItem['PROPERTIES']['STORE']['VALUE']==1):?>
				<div class="zapas col-md-12">
					Складской запас
				</div><?endif;?>
<?if($arItem['PROPERTIES']['MOUNTING']['VALUE']==1):?>
				<div class="montazh col-md-12">
					Монтаж
				</div>
<?endif;?>

		</div>
	</div>
<?}?>
	<div class="clear">&nbsp;</div>
</div>