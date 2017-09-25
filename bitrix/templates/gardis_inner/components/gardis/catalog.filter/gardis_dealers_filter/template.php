<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="col-xs-12 select_block" style="padding:0;">
	<form id='dealers_form' name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
		<?foreach($arResult["ITEMS"] as $arItem):
			if(array_key_exists("HIDDEN", $arItem)):
				echo $arItem["INPUT"];
			endif;
		endforeach;?>
		<?foreach($arResult["arrProp"] as $arItem):?>
			<?if($arItem['CODE']=='TOWN'):?>
		<select class="city-ar" id='dealers_select' style="margin-bottom:0px;" name='<?=$arResult['FILTER_NAME'];?>_pf[<?=$arItem['CODE']?>]'>
<option value=''><?=GetMessage('ALL');?></option>
<?/*<option value=''><?=GetMessage('ALL');?></option>*/?>
					<?foreach($arItem['LIST'] as $val):?>
						<option <?if($val==$arItem['INPUT_VALUE']):?>selected<?endif;?> value='<?=$val?>'><?=$val?></option>
					<?endforeach;?>
				</select>
			<?endif;?>
			<?if($arItem['CODE']=='STORE'):?>
				<input type="checkbox" <?if($arItem['INPUT_VALUE']==1):?>checked<?endif;?> id="dealers_checkbox" name='<?=$arResult['FILTER_NAME'];?>_pf[<?=$arItem['CODE']?>]' value='1' />
				<label for="dealers_checkbox" class="for_checkbox"><?=GetMessage('ONLY_STORE');?></label>
			<?endif;?>
		<?endforeach;?>
		<input  type='hidden' name='set_filter' value='Y' />
	</form>
</div>