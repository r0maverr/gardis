<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<div class="news_header_cont">
	<h1 class="news_item"><?$APPLICATION->ShowTitle();?></h1>
	<a href="#ask_take" class="fancybox nice_button on_right" style="top:-2px;"><?=GetMessage('ORDER_HREF');?></a>
</div>
<div class="form_grid" id="ask_take">
	<span class="grey_span"><?=GetMessage('ORDER_TITLE');?></span>
	<div class="clear"></div>
	<?/*<div class="errors">
		<?if(!empty($arResult["ERROR_MESSAGE"]))
		{
			foreach($arResult["ERROR_MESSAGE"] as $v)
				ShowError($v);
		}
		if(strlen($arResult["OK_MESSAGE"]) > 0)
		{
			?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
		}
		?>
	</div>*/?>
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
			<div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
			<a href="javascript:;" onclick="window.location.href='<?= $APPLICATION->GetCurPageParam('ask_question=y', array('success', 'AJAX_CALL', 'bxajaxid', 'SECTION_CODE', 'ELEMENT_CODE', 'order_call', 'ask_price', 'ask_question'))?>';">отправить ещё сообщение</a>
		</div>
	<?else:?>
		<div class="clear"></div>
		<form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
			<fieldset>
				<?=bitrix_sessid_post()?>
				<label><?=GetMessage("MFT_NAME")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
				<label><?=GetMessage("MFT_EMAIL")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
				<label><?=GetMessage("MFT_MESSAGE")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<textarea name="MESSAGE"><?=$arResult["MESSAGE"]?></textarea>

				<?if($arParams["USE_CAPTCHA"] == "Y"):?>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
					<label><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"></label>
					<div class="clear"></div>
					<label><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></label>
					<input type="text" name="captcha_word" maxlength="50" value="">
				<?endif;?>
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<input type="submit" class="grey_nice_button on_right" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
			</fieldset>
		</form>
	<?endif;?>
</div>