<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?=ShowError($arResult["ERROR_MESSAGE"]);?>
<?=ShowNote($arResult["OK_MESSAGE"]);?>

<?if (!empty($arResult["QUESTIONS"])):?>
	<div class="block_header light_cian">
		<span class="has_arrow"><?=GetMessage('VOTE_TITLE');?></span>
	</div>
	<div class="inside_right_main_container vote_main">
		<div class="main_vote_block">
			<span><?=$arResult["QUESTIONS"][0]["QUESTION"]?></span>
			<form action="<?=POST_FORM_ACTION_URI?>" method="post">
				<fieldset>
					<input type="hidden" name="vote" value="Y">
					<input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
					<input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
					<?=bitrix_sessid_post()?>

					<?
					$arQuestion=$arResult["QUESTIONS"][0];
					//foreach ($arResult["QUESTIONS"] as $arQuestion):
					?>

						<?if ($arQuestion["IMAGE"] !== false):?>
							<img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" />
						<?endif?>
						<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
							<?
							switch ($arAnswer["FIELD_TYPE"]):
								case 0://radio
									$value=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) && 
										$_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]) ? 'checked="checked"' : '';
								break;
								case 1://checkbox
									$value=(isset($_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]]) && 
										array_search($arAnswer["ID"],$_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]])!==false) ? 'checked="checked"' : '';
								break;
								case 2://select
									$value=(isset($_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]] : false;
								break;
								case 3://multiselect
									$value=(isset($_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]] : array();
								break;
								case 4://text field
									$value = isset($_REQUEST['vote_field_'.$arAnswer["ID"]]) ? htmlspecialchars($_REQUEST['vote_field_'.$arAnswer["ID"]]) : '';
								break;
								case 5://memo
									$value = isset($_REQUEST['vote_memo_'.$arAnswer["ID"]]) ?  htmlspecialchars($_REQUEST['vote_memo_'.$arAnswer["ID"]]) : '';
								break;
							endswitch;
							?>
							<?switch ($arAnswer["FIELD_TYPE"]):
								case 0://radio?>
									<input <?=$value?> type="radio" name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>" value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> /><label><?=$arAnswer["MESSAGE"]?></label>
									<div class="clear"></div>
								<?break?>

								<?case 1://checkbox?>
									<input <?=$value?> type="checkbox" name="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>[]" value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> /><label><?=$arAnswer["MESSAGE"]?></label>
									<div class="clear"></div>
								<?break?>

								<?case 2://dropdown?>
									<select name="vote_dropdown_<?=$arAnswer["QUESTION_ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?>>
									<?foreach ($arAnswer["DROPDOWN"] as $arDropDown):?>
										<option value="<?=$arDropDown["ID"]?>" <?=($arDropDown["ID"] === $value)?'selected="selected"':''?>><?=$arDropDown["MESSAGE"]?></option>
									<?endforeach?>
									</select>
									<div class="clear"></div>
								<?break?>

								<?case 3://multiselect?>
									<select name="vote_multiselect_<?=$arAnswer["QUESTION_ID"]?>[]" <?=$arAnswer["~FIELD_PARAM"]?> multiple="multiple">
									<?foreach ($arAnswer["MULTISELECT"] as $arMultiSelect):?>
										<option value="<?=$arMultiSelect["ID"]?>" <?=(array_search($arMultiSelect["ID"], $value)!==false)?'selected="selected"':''?>><?=$arMultiSelect["MESSAGE"]?></option>
									<?endforeach?>
									</select>
									<div class="clear"></div>
								<?break?>

								<?case 4://text field?>
									<label>
										<?if (strlen(trim($arAnswer["MESSAGE"]))>0):?>
											<?=$arAnswer["MESSAGE"]?>
											<div class="clear"></div>
										<?endif?>
										<input type="text" name="vote_field_<?=$arAnswer["ID"]?>" value="<?=$value?>" size="<?=$arAnswer["FIELD_WIDTH"]?>" <?=$arAnswer["~FIELD_PARAM"]?> />
									</label>
									<div class="clear"></div>
								<?break?>

								<?case 5://memo?>
									<label>
										<?if (strlen(trim($arAnswer["MESSAGE"]))>0):?>
											<?=$arAnswer["MESSAGE"]?>
											<div class="clear"></div>
										<?endif?>
										<textarea name="vote_memo_<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> cols="<?=$arAnswer["FIELD_WIDTH"]?>" rows="<?=$arAnswer["FIELD_HEIGHT"]?>"><?=$value?></textarea>
									</label>
									<div class="clear"></div>
								<?break?>
							<?endswitch?>
						<?endforeach?>
						<div class="clear"></div>
					<?//endforeach?>

					<? if (isset($arResult["CAPTCHA_CODE"])):  ?>
					<div class="vote-item-header">
						<div class="vote-item-title vote-item-question"><?=GetMessage("F_CAPTCHA_TITLE")?></div>
						<div class="vote-clear-float"></div>
					</div>
					<div class="vote-form-captcha">
						<input type="hidden" name="captcha_code" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
						<div class="vote-reply-field-captcha-image">
							<img src="/bitrix/tools/captcha.php?captcha_code=<?=$arResult["CAPTCHA_CODE"]?>" alt="<?=GetMessage("F_CAPTCHA_TITLE")?>" />
						</div>
						<div class="vote-reply-field-captcha-label">
							<label for="captcha_word"><?=GetMessage("F_CAPTCHA_PROMT")?><span class='starrequired'>*</span></label><br />
							<input type="text" size="20" name="captcha_word" />
						</div>
					</div>
					<? endif // CAPTCHA_CODE ?>

					<input type="submit" name="vote" value="<?=GetMessage("VOTE_SUBMIT_BUTTON")?>">
				</fieldset>
			</form>
		</div>
	</div>
<?endif?>
