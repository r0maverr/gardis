<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row reviews rev">
<?foreach($arResult["ITEMS"] as $ai => $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="review-logo col-xs-12 col-md-2">
			<img class="img-responsive" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		</div>

		<div class="review-header col-xs-12 col-md-10">
			<h2><?echo $arItem["NAME"]?></h2>
			<?if( strlen($arItem["PROPERTIES"]["POSITION"]["VALUE"]) > 0 ){?>
				<span class="date"><?echo $arItem["PROPERTIES"]["POSITION"]["VALUE"]?></span>
			<?}?>
		</div>
		<div class="review-text col-xs-12 col-md-12">
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<p><?echo $arItem["PREVIEW_TEXT"];?></p>
			<?endif;?>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
<?}?>
<div class="clear">&nbsp;</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>