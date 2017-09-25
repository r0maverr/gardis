<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block_header cian">
	<span class="has_arrow"><?=GetMessage('TITLE');?></span>
</div>
<div class="production">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="product_item_in_sidebar">
			<div class="product_item_in_sidebar_img_container">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				</a>
			</div>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
		</div>
		<div class="clear"></div>
	<?endforeach;?>
	<a href="<?=$arParams["CATALOG_HREF"];?>"><?=GetMessage('HREF_TITLE');?></a>
</div>