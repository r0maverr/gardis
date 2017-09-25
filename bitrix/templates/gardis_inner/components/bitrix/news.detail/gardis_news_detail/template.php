<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news_header_cont">
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
			<h1>
			<? echo empty($arResult["PROPERTIES"]['h1']['VALUE'])?$arResult["NAME"]:$arResult["PROPERTIES"]['h1']['VALUE'];?>
			</h1>
	<?endif;?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="date on_right"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
</div>
<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
	<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" rel="group" title="<?=$arResult["NAME"]?>" class="fancybox">
		<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" class="grey_border" style="float: left; margin: 10px 50px 10px 0px;"/>
	</a>
<?endif?>
<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
	<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
<?endif;?>
<?if($arResult["NAV_RESULT"]):?>
	<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
	<?echo $arResult["NAV_TEXT"];?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
	<?echo $arResult["DETAIL_TEXT"];?>
<?else:?>
	<?echo $arResult["PREVIEW_TEXT"];?>
<?endif?>
<div class="content_footer_links">
<?
if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
{
	?>
	<!--<div class="socials_links">
		<noindex>
		<?/*
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
		*/?>
		<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
		<div class="yashare-auto-init" data-yashareL10n="ru"
		  data-yashareType="none" data-yashareQuickServices="facebook,twitter,gplus">
		</div>
		<a id="header_rss" href="/bitrix/rss.php?ID=15" ></a>
		</noindex>
	</div> !-->
	<?
}
?>
	<span class="prevall">« <a href="<?=$arParams["BACK_HREF"]?>" ><?=$arParams["BACK_TITLE"]?></a></span>
</div>
