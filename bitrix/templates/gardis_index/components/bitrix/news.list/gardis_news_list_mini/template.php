<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block_header cian">
	<span class="has_arrow"><?=GetMessage("NEWS_TITLE");?></span>
	<div class="deep_cian_block_header">
		<a href="<?=$arParams["HREF"];?>"><?=GetMessage("NEWS_HREF");?></a>
	</div>
</div>			
<div class="inside_right_main_container news_main <?if($arParams["NO_VOTE"]=="Y"):?>no_vote<?endif;?>">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
    <div class="main_news_block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<?endif?>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
				<?else:?>
					<a href="#"><?echo $arItem["NAME"]?></a>
				<?endif;?>
			<?endif;?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<p><?=$arItem["PREVIEW_TEXT"];?></p>
			<?endif;?>
		</div>
	<?endforeach;?>
</div>

