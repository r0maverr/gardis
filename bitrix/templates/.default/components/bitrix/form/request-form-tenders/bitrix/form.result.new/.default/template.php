<?$this->addExternalJS("/js/fileinput.js");?>
<script>
$(document).ready(function(){
	

	$('input[name="form_text_79"]').mask('+7 (999) 999-99-99', {placeholder: '+7 (___) ___-__-__'});
	$('input[name="form_date_83"]').mask('99.99.9999');
	$('input[name="form_date_84"]').mask('99.99.9999');


	$('.onClickTender').on('click', function(){
		

		$('input[name="form_text_79"]').mask('+7 (999) 999-99-99', {placeholder: '+7 (___) ___-__-__'});

		$('input[name="form_date_83"]').mask('99.99.9999');
		$('input[name="form_date_84"]').mask('99.99.9999');		

        $(".tenderShadow").css({opacity:0,display:"block"}).animate({opacity:.5},300,function(){
            $(".formTender .calendar-icon").attr("src","/images/calendar_2.png");
            $("#formTender").css({opacity:0,display:"block",top:$(window).scrollTop()}).animate({opacity:1},300);

        });

	});
	
	$('.tenderSubmit').on('click', function(){
		
		var formValid = true;
		
		$('.tender-row').removeClass('input-error');
		$('.tender-form input, .tender-form textarea').each(function(){			
			
			if($(this).parent().hasClass("input-req")){
			
				if($(this).val()==""){
					formValid = false;
					$(this).parent().parent().addClass('input-error');	
				}
			}
			
			
		});
		

		return formValid;
	});
	
	
    $("body").on("click",".form-cancel", tenderClose);
    $("body").on("click",".tenderShadow", tenderClose);
	
	function tenderClose(){
		
		$("#formTender").animate({opacity:0},300,function(){
			
			$(this).css({display:"none"});
			
			$(".tenderShadow").animate({opacity:0},300,function(){
				
				$(this).css({display:"none"});
				
			});
			
		});        
		
	}

	fileInput();
		
	
	
});
</script>

 	<?if ($arResult["isFormErrors"] == "Y"){?>	
	<script>
	var arErrors = <?=json_encode($arResult["FORM_ERRORS"])?>;

	$(document).ready(function(){
		$('.form__html-row').removeClass('input-error');
		for(var i in arErrors){
			
			$('div[data-id="'+i+'"]').addClass('input-error');
			
		}

        $(".tenderShadow").css({opacity:0,display:"block"}).animate({opacity:.5},300,function(){
            $(".formTender .calendar-icon").attr("src","/images/calendar_2.png");
            $("#formTender").css({opacity:0,display:"block",top:$(window).scrollTop()}).animate({opacity:1},300);
			
        });		
	});
	</script>
	<?}?> 
 <?if(empty($arResult["FORM_NOTE"])){?>
	

 <div id="formTender" class="formTender">


<?=$arResult["FORM_HEADER"]?>
<div class="form-cancel"></div>
 <div class="formContain"> 
 
  <div class="tender-text"> 
   
    <p>Gardis имеет большой опыт участия в государственных и коммерческих тендерах.</p>
   
    <p>Чтобы мы приготовили для Вас коммерческое предложение на ограждение территории и документы для проведения тендера, заполните форму ниже и приложите техническое задание при необходимости.</p>
 
   </div>
 
	<div class="tender-form">
<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden'){
			
			if($FIELD_SID=="startDate" || $FIELD_SID=="endDate"){
				
				$style="tender-row-two";
			
			}else{
				
				$style="tender-row";
			
			}
	?>
		
			<div class="<?=$style?>" data-id="<?=$FIELD_SID?>">
				<div class="tender-label">
					<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
					<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
					<?endif;?>
					<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
					<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
				</div>
				<div  class="tender-input <?if ($arQuestion["REQUIRED"] == "Y"):?>input-req<?endif;?>" ><?=$arQuestion["HTML_CODE"]?>
				<div class="tender-error-box"><div class="tender-error-text">Заполните пожалуйста поле</div>
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
 
	<div class="form__nav" >
		<?if ($arResult["F_RIGHT"] >= 15):?>
		<input type="hidden" name="web_form_apply" value="Y" /><input class="formSubmit tenderSubmit" type="submit" name="web_form_apply" value="ОТПРАВИТЬ" />
		<?endif;?>		
	</div>
	</div>
 

 </div>
<?=$arResult["FORM_FOOTER"]?> 
 </div>
 <?}else{
    date_default_timezone_set("Asia/Novosibirsk");
    List($hour, $day) = split(":",date("G:w"));
?>
		<script>
	$(document).ready(function(){	
    <?if($day > 0 && $day<6 && $hour>=9 && $hour<18){?>
		$.fancybox.open([$(".tenderCallback2")],{wrapCSS:'styleWrap'});
    <?}else{?>
        $.fancybox.open([$(".tenderCallback1")],{wrapCSS:'styleWrap'});
    <?}?>
	});
	</script>
 <?}?>
	<div class="tenderCallback1" style="display:none;"><span>Спасибо за приглашение! Мы ответим в ближайшее время!</span></div>
    <div class="tenderCallback2" style="display:none;"><span>Спасибо за приглашение! Мы ответим в течение 15 минут!</span></div>
 <div class="tenderShadow"></div>