<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="row news-items">
<?foreach($arResult["ITEMS"] as $ai => $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="preview-picture2 col-xs-12 col-md-3">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<img class="img-responsive shadow" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			</a>
		</div>

		<div class="news-item-content col-xs-12 col-md-9">
			<h2><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<?endif?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<div><?echo $arItem["PREVIEW_TEXT"];?></div>
			<?endif;?>
		</div>
		<?if ($ai < count($arResult["ITEMS"])-1){?>
		<div class="clear border-news" style="margin:0 15px;">&nbsp;</div>
		<?}?>
	</div>
<?}?>
<div class="clear">&nbsp;</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>