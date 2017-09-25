<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="main_gallery">
	<div class="main_photo" style="position: relative;">
		<div class="next button"></div>
		<div class="prev button"></div>						
		<img src="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['SRC']?>" width="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['WIDTH']?>" height="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['HEIGHT']?>" />
	</div>

	<div class="small_spacer"></div>
	<div class="small_photos_container">
	<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="small_photo <?if($key==0):?>act<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		</div>
	<?endforeach;?>
	</div>
</div>
<div class="content_footer_links">
<?
if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
{
	?>
	<div class="socials_links">
		<noindex>
		<?
		$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
				"HANDLERS" => $arParams["SHARE_HANDLERS"],
				"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
				"PAGE_TITLE" => $arResult["~NAME"],
				"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
				"HIDE" => $arParams["SHARE_HIDE"],
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
		?>
		</noindex>
	</div>
	<?
}
?>
	<span class="prevall">« <a href="<?=$arParams['BACK_HREF'];?>" ><?=$arParams['BACK_TITLE'];?></a></span>
</div>