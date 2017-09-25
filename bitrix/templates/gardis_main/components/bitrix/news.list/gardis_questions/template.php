<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="ask_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<p>
			<strong><?echo $arItem["NAME"];?></strong><?if(strlen($arItem['PROPERTIES']['QUESTION_DATE']['VALUE'])>0):?>, <?echo $arItem['PROPERTIES']['QUESTION_DATE']['VALUE'];?><?endif?><br/><br/>
			<?if(strlen($arItem['PROPERTIES']['QUESTION_TEXT']['VALUE']['TEXT'])>0):?>
				<?echo $arItem['PROPERTIES']['QUESTION_TEXT']['VALUE']['TEXT'];?>
			<?endif?>
		</p>
		<?if(strlen($arItem['PROPERTIES']['ANSWER_TEXT']['VALUE']['TEXT'])>0):?>
			<div class="answer_item_header">
				<span><strong><?=GetMessage("ADMIN_ANSWER");?></strong><?if(strlen($arItem['PROPERTIES']['ANSWER_DATE']['VALUE'])>0):?>, <?=$arItem['PROPERTIES']['ANSWER_DATE']['VALUE']?><?endif;?></span>
				<span class="show_answer_item"><?=GetMessage("OPEN");?></span>
			</div>
			
			<div class="answer_item">
				<div class="answer_item_header">
					<?if(strlen($arItem['PROPERTIES']['ANSWER_NAME']['VALUE'])>0):?>
						<span><strong><?=$arItem['PROPERTIES']['ANSWER_NAME']['VALUE'];?></strong></span>
					<?else:?>
						<span><strong><?=GetMessage("ADMIN_ANSWER");?></strong><?if(strlen($arItem['PROPERTIES']['ANSWER_DATE']['VALUE'])>0):?>, <?=$arItem['PROPERTIES']['ANSWER_DATE']['VALUE'];?><?endif;?></span>
					<?endif;?>
					<span class="show_answer_item act"><?=GetMessage("CLOSE");?></span>
				</div>
				<p>
				<?if($arItem['PROPERTIES']['ANSWER_TEXT']['VALUE']['TYPE']=='html'):?>
					<?=htmlspecialcharsBack($arItem['PROPERTIES']['ANSWER_TEXT']['VALUE']['TEXT']);?>
				<?else:?>
					<?=$arItem['PROPERTIES']['ANSWER_TEXT']['VALUE']['TEXT'];?>
				<?endif;?>
				</p>
			</div>
		<?endif;?>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
