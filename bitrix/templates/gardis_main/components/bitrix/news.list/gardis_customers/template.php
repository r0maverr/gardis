<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row customers">
<?foreach($arResult["ITEMS"] as $ai => $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="company-logo col-xs-12 col-md-3">
			<div class="company-shadow">
			<div class="company-img" style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)">
			<!--img class="img-responsive" src="<?//=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?//=$arItem["NAME"]?>" title="<?//=$arItem["NAME"]?>" / -->
			</div>
			</div>
		</div>

		<div class="news-item-content col-xs-12 col-md-9">
			<h2><?echo $arItem["NAME"]?></h2>
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