<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>


<div class="make-order fancy-order make-pad">
<?if(!empty($arResult["FORM_NOTE"])){?>
	
	<script>
	$(document).ready(function(){
		$('.form__html').css({display:'none'});
		$('.make-order').removeClass('make-pad');
		<?date_default_timezone_set("Asia/Novosibirsk");
        List($hour, $day) = split(":",date("G:w")); 
        if($day > 0 && $day<6 && $hour>=9 && $hour<18){?>
		    $('.form_success1').css({display:'block','min-width':500});
        <?}else{?>
            $('.form_success2').css({display:'block','min-width':500});
        <?}?>
		$.fancybox.update();	
	});
	</script>
<?}?>
<?//if ($arResult["isFormNote"] != "Y")
//{
?>
<?=$arResult["FORM_HEADER"]?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
	<div class="form_success1">Спасибо за заявку, мы перезвоним Вам в течение 15 минут!</div>
    <div class="form_success2">Спасибо за заявку, мы перезвоним Вам в ближайшее время!</div>
	<div class="form__html">
	<?if ($arResult["isFormErrors"] == "Y"){?>	
	<script>
	var arErrors = <?=json_encode($arResult["FORM_ERRORS"])?>;
	$(document).ready(function(){
		$('.form__html-row').removeClass('input-error');
		for(var i in arErrors){
			
			$('div[data-id="'+i+'"]').addClass('input-error');
			
		}		
	});
	</script>
	
	<?};?>
	<?
	//global $FORM;

	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden'){
	?>
		<div class="form__html-row" data-id="<?=$FIELD_SID?>">
			<div class="form__html-label">
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</div>
			<div  class="form__html-input"><?=$arQuestion["HTML_CODE"]?>
			<div class="form__html-error-box"><div class="form__html-error-text">Заполните пожалуйста поле</div>
			</div>
			</div>
		</div>
	<?
		}else{
			if($FIELD_SID == 'YOUR_ORDER'){?>
				<?$field = $arQuestion["STRUCTURE"][0];?> 
				<input type="hidden" name="form_<?=$field["FIELD_TYPE"]?>_<?=$field["ID"]?>" value="" />
				
			<?}else{
				
				echo $arQuestion["HTML_CODE"];
			}
			
			
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<div>
			<div colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></div>
		</div>
		<div>
			<div>&nbsp;</div>
			<div><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></div>
		</div>
		<div>
			<div><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></div>
			<div><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></div>
		</div>
<?
} // isUseCaptcha
?>
	
	<div class="form__nav">			
		<?if ($arResult["F_RIGHT"] >= 15):?>
		<input type="hidden" name="web_form_apply" value="Y" /><input class="formSubmit" type="submit" name="web_form_apply" value="ЗАКАЗАТЬ" />
		<?endif;?>		
	</div>
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
//}//endif (isFormNote)
?>
<script>
var formbox;
$(document).ready(function(){
	
	$('body').find('.mask-phone').mask('+7(999) 999-99-99');
	
	$('.onClickOrder').on('click', function(){
		
		$('.form__html').css({display:'block'});
		$('.make-order').addClass('make-pad');
		$('.form_success2').css({display:'none'});
        $('.form_success1').css({display:'none'});
			
		
		
		formbox = $(".fancy-order");

		$.fancybox.open([formbox],{
			wrapCSS:'styleWrap'

		
		});
		
		$.fancybox.update();
		$('input[name="form_hidden_66"]').val('/gotovye-resheniya/'+$(this).attr('data-code')+'/');
	});
});
</script>
</div>