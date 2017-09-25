<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CAjax::Init();?>
<div id="dealers_list" pid="<?=CAjax::GetComponentID("bitrix:news.list","gardis_dealers",false)?>">
<?
$cnt=0;
#echo "<pre>"; print_r($arResult["ITEMS"]);
foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$cnt++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="dealer_block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<p><strong><?=$arItem['PROPERTIES']['TOWN']['VALUE'];?></strong></p>
		<p><?echo $arItem["NAME"]?></br>
		<?if(strlen($arItem['PROPERTIES']['ADRESS']['VALUE'])>0):?><?=$arItem['PROPERTIES']['ADRESS']['VALUE'];?><br/><?endif;?>
		<?if(strlen($arItem['PROPERTIES']['PHONES']['VALUE'])>0):?><?=$arItem['PROPERTIES']['PHONES']['VALUE'];?><br/><?endif;?>
		<?if(strlen($arItem['PROPERTIES']['SITE']['VALUE'])>0):?><a href="http://<?=$arItem['PROPERTIES']['SITE']['VALUE'];?>" target="_blank"><?=$arItem['PROPERTIES']['SITE']['VALUE'];?></a><br/><?endif;?>
		<?if(strlen($arItem['PROPERTIES']['SITE2']['VALUE'])>0):?><a href="http://<?=$arItem['PROPERTIES']['SITE2']['VALUE'];?>" target="_blank"><?=$arItem['PROPERTIES']['SITE2']['VALUE'];?></a><br/><?endif;?>
		<?if(strlen($arItem['PROPERTIES']['EMAIL']['VALUE'])>0):?><a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>" class="mailto"><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a><?endif;?></p>
		<?if($arItem['PROPERTIES']['STORE']['VALUE']==1):?><span class="safe_dealer"><?=GetMessage('HAS_STORE');?></span><?else:/*?><span class="safe_dealer_none"></span><?*/endif;?>
		<?if($arItem['PROPERTIES']['MOUNTING']['VALUE']==1):?><span class="dealer_mouting"><?=GetMessage('HAS_MOUNTING');?></span><?else:/*?><span class="safe_dealer_none"></span><?*/endif;?>
	</div>
	<?if($cnt%2==0):?><div class="clear"></div><?endif;?>
<?endforeach;?>
</div>
<?//echo "<pre>"; print_R($arResult["ITEMS"]); echo "</pre>";?>