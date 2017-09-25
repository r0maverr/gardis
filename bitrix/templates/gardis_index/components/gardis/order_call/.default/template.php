<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
	<table style="margin-top: -3px; float: right; height: 25px; vertical-align: middle;">
		<tr> <?php /* <td ><a id="bxid_745511" class="fancybox" style="border-bottom: 1px dotted white" href="#phone_take" ><img id="bxid_849199" src="/upload/phone.png" alt="Телефон" width="20" height="20"  /></a></td> */ ?>
			<td style="vertical-align: top;">&nbsp; <a href="#phone_take" class="fancybox grey_nice_button order_call_button"
			                                           onclick="_gaq.push(['_trackEvent', 'all_pages', 'request_call',,, true]); yaCounter24428276.reachGoal('ORDER_CALL_BUTTON<?= (isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone'])) ? '_DIRECT' : '' ?>'); return true;"><?= GetMessage('ORDER_HREF'); ?></a>
			</td>
		</tr>
	</table>

<div class="form_grid form_callback" id="phone_take">            <span
	class="grey_span"><?= GetMessage('ORDER_TITLE'); ?></span>
	<div class="clear"></div>
<? /*<div class="errors">
			<?if(!empty($arResult["ERROR_MESSAGE"]))
				{
					foreach($arResult["ERROR_MESSAGE"] as $v)
					ShowError($v);
				}
				if(strlen($arResult["OK_MESSAGE"]) > 0)
				{
					?>
  <div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
 <?
				}
			?> 		</div>
 */
?>        <? if (!empty($arResult["ERROR_MESSAGE"])): ?>
	<div class="errors">                <?
		foreach ($arResult["ERROR_MESSAGE"] as $v)
			ShowError($v);
		?>            </div>
<? endif; ?>        <? if (strlen($arResult["OK_MESSAGE"]) > 0): ?>
	<div class="errors">
		<?//$APPLICATION->AddHeadString("<script>var _gaq = _gaq || []; _gaq.push(['_trackEvent', 'форма', 'отправлена', 'заказать звонок']);</script>")?>
<script>
var _gaq = _gaq || []; _gaq.push(['_trackEvent', 'форма', 'отправлена', 'заказать звонок']);
yaCounter24428276.reachGoal('ORDER_CALL_SUBMITED');
</script>
		<div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div>
<a href="javascript:;" onclick="window.location.href='<?= $APPLICATION->GetCurPageParam('order_call=y', array('success', 'AJAX_CALL', 'bxajaxid', 'order_call',
			'ask_price', 'ask_question'))?>'">отправить ещё сообщение</a></div>
</div>
<? else: ?>
	<div class="clear"></div>

	<script>
		$(document).ready(function () {
			if (!$('#order_call_form_id input[name=controll]').length) {
				$('#order_call_form_id').append('<input type="hidden" name="controll" value="yes" />');
			}
			$('#order_call_form_id input[name="user_phone"]').mask('+7 ( 000 ) 000 - 00 - 00', {placeholder: '+7 ( ___ ) ___ - __ - __'});
		});
	</script>
	<form id="order_call_form_id" action="<?=$APPLICATION->GetCurPage()?>" method="POST">
		<fieldset>                    <?= bitrix_sessid_post() ?>                <?php /*	<label><?=GetMessage("MFT_NAME")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
					<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
					<label><?=GetMessage("MFT_EMAIL")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
					<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
				*/
			?>                        <label><?= GetMessage("MFT_PHONE") ?>
				:<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])): ?><span
					class="mf-req">*</span><? endif ?></label> <input type="text" name="user_phone"
		                                                              value="">                <?php /*
					<label><?=GetMessage("MFT_COMPANY")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("COMPANY", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
					<input type="text" name="user_company" value="<?=$arResult["AUTHOR_COMPANY"]?>">
					<label><?=GetMessage("MFT_ADRESS")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("ADRESS", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
					<input type="text" name="user_adress" value="<?=$arResult["AUTHOR_ADRES"]?>">
					<label><?=GetMessage("MFT_MESSAGE")?>:<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
					<textarea name="MESSAGE"><?=$arResult["MESSAGE"]?></textarea>

					<?if($arParams["USE_CAPTCHA"] == "Y"):?>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
						<label><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"></label>
						<div class="clear"></div>
						<label><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></label>
						<input type="text" name="captcha_word" maxlength="50" value="">
					<?endif;?>
					*/
			?>                    <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>"> <input type="submit"
		                                                                                   class="grey_nice_button on_right"
		                                                                                   name="submit"
		                                                                                   value="<?=GetMessage("MFT_SUBMIT")?>"
		                                                                                   onclick="_gaq.push(['_trackEvent', 'форма', 'отправка', 'заказать звонок']);yaCounter24428276.reachGoal('ORDER_CALL_SUBMIT<?= (isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone'])) ? '_DIRECT' : '' ?>'); return true;">
		</fieldset>
	</form>    
</div>
<?endif; ?>