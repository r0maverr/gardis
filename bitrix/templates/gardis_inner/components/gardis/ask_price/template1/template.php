<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<script>var success = false;</script>
<div class="form_grid" id="ask_price">
	<span class="grey_span"><?=GetMessage('MFT_FORM_TITLE');?></span>
<?if(!$arResult["OK_MESSAGE"] && !$arResult["ERROR_MESSAGE"]){?>
	<div class="mf-desc-text"><?=GetMessage('MFT_FORM_DESCRIPTION');?></div>
<?}?>
	<div class="clear"></div>
	<?if (!empty($arResult["ERROR_MESSAGE"])):?>
		<div class="errors">
			<?
			foreach($arResult["ERROR_MESSAGE"] as $v)
				ShowError($v);
			?>
		</div>
	<?endif;?>
	<?if (strlen($arResult["OK_MESSAGE"]) > 0):?>
		<div class="errors">
<?//$APPLICATION->AddHeadString("<script>var _gaq = _gaq || []; _gaq.push(['_trackEvent', 'форма', 'отправлена', 'узнать стоимость']);</script>")?>
<script>var _gaq = _gaq || []; _gaq.push(['_trackEvent', 'форма', 'отправлена', 'узнать стоимость']);
yaCounter24428276.reachGoal('ORDER_SUBMITED');
</script>
			<div class="mf-ok-text"><?=GetMessage('MFT_FORM_SENDED');?></div>
			<a href="javascript:;" onclick="window.location.href='<?= $APPLICATION->GetCurPageParam('ask_price=y', array('success', 'AJAX_CALL', 'bxajaxid', 'SECTION_CODE', 'ELEMENT_CODE', 'order_call', 'ask_price', 'ask_question'))?>'">отправить ещё сообщение</a>
		</div>
	<?else:?>
		<div class="clear"></div>
		<form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
			<fieldset>
				<?=bitrix_sessid_post()?>
				<input class="required" type="hidden" name="PRODUCT_NAME" value="<?=$arParams["PRODUCT_NAME"]?>" />
				<label><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input class="required" type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
				<label><?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input class="required" type="text" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>">
				<label><?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input class="required" type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
				<?/*<label><?=GetMessage("MFT_COMPANY")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("COMPANY", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input class="required" type="text" name="user_company" value="<?=$arResult["AUTHOR_COMPANY"]?>">*/?>
				<label><?=GetMessage("MFT_TOWN")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TOWN", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input class="required" type="text" name="user_town" value="<?=$arResult["AUTHOR_TOWN"]?>">
				<label><?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<textarea class="required" name="MESSAGE"><?=$arResult["MESSAGE"]?></textarea>

				<?if($arParams["USE_CAPTCHA"] == "Y"):?>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
					<label><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"></label>
					<div class="clear"></div>
					<label><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></label>
					<input class="required" type="text" name="captcha_word" maxlength="50" value="">
				<?endif;?>
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<input type="submit" class="grey_nice_button on_right" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" onclick="_gaq.push(['_trackEvent', 'форма', 'отправка', 'узнать стоимость']); yaCounter24428276.reachGoal('ASK_A_QUESTION_SUBMIT<?=(isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone']))?'_DIRECT':''?>'); return true;">
			</fieldset>
		</form>
	<?endif;?>
</div>
