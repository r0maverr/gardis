<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="slider">
	<div class="sliderContent">
		<?/*<img src="<?=SITE_TEMPLATE_PATH;?>/img/9may2015.jpg" width="630" height="288" />*/?>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arItem["PROPERTIES"]["HREF"]["VALUE"]):?><a href="<?=$arItem["PROPERTIES"]["HREF"]["VALUE"]?>"><?endif?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				<? /*<div class="sl_promozona">
					<a href="<?=$arItem["PROPERTIES"]["HREF"]["VALUE"]?>"><?=$arItem["NAME"]?></a>
				</div>*/?>
				<?if($arItem["PROPERTIES"]["HREF"]["VALUE"]):?></a><?endif?>
			</div>

		<?endforeach;?>
	</div>
</div>