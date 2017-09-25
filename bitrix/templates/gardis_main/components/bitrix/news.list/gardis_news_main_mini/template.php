<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>  
<div class="block_header cian">
	<span >
		<?=GetMessage("NEWS_TITLE");?>
	</span>
	<div class="deep_cian_block_header">
		<a href="<?=$arParams["HREF"];?>"><?=GetMessage("ALL_NEWS");?></a>
	</div>
</div>
<div class="production">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news_item_in_sidebar" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="margin-bottom: 45px;">
			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<?endif?>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="color: #555555; display: block; font: 12px Arial;"><?echo $arItem["NAME"]?></a>
				<?else:?>
					<a href="#"><?echo $arItem["NAME"]?></a>
				<?endif;?>
			<?endif;?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<p style="color: #555555; font: 12px Arial; height: 45px; overflow: hidden; margin-top: 10px;"><?echo $arItem["PREVIEW_TEXT"];?></p>
			<?endif;?>

		</div>
	<?endforeach;?>
</div> 

<?/*
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block_header cian">
	<span><?=GetMessage("NEWS_TITLE");?></span>
</div>
<div class="production">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news_item_in_sidebar" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
		</div>
	<?endforeach;?>
	<div class="clear"></div>
	<a href="<?=$arParams["HREF"];?>"><?=GetMessage("ALL_NEWS");?></a>
</div> */?>

 


 
