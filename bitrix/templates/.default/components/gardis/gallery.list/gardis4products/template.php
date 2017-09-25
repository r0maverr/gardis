<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="main_gallery">
	<div id="product_gallery">
	<div class="main_photo" style="position: relative;">
		<div class="next button"></div>
		<div class="prev button"></div>						
		<img src="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['src']?>" width="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['width']?>" height="<?=$arResult['ITEMS'][0]['DETAIL_PICTURE']['height']?>" />
	</div>
        <div id="product_gallery_info">
<? //Заполняем информацию по умолчанию
echo "<div class=\"gallery_property\"><h4>".$arResult['ITEMS'][0]["NAME"]."</h4></div>";
foreach($arResult['ITEMS'][0]["DISPLAY_PROPERTIES"] as $arProperty){
echo "<div class=\"gallery_property\"><span class=\"gallery_property_name\">".$arProperty["NAME"].": </span><span class=\"gallery_property_value\">".$arProperty["VALUE"]."</span></div>";
}?>

	</div>

	<div class="small_spacer">
<center class="ask_price">
<a href="#ask_price" onclick="_gaq.push(['_trackEvent', 'all_pages', 'request_price_submit',,, true]); yaCounter24428276.reachGoal('ORDER'); return true;" class="fancybox grey_nice_button request_price_submit">Узнать стоимость</a>
<?$APPLICATION->IncludeComponent("gardis:ask_price", "template1", Array(
	"USE_CAPTCHA" => "N",
	"OK_TEXT" => "Ваше сообщение отправлено. Наш менеджер свяжется с вами.",
	"EMAIL_TO" => "info@gardies.ru",
	"PRODUCT_NAME" => "",
	"REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
		0 => "28",
	)
	),
	false
);?>
<?php /*<a href="/contacts/ask-a-question/"><img src="/bitrix/images/button_new.jpg"></a>*/ ?>
</center>

</div>
	<div class="small_photos_container">
	<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="small_photo <?if($key==0):?>act<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<img src="<?=$arItem["DETAIL_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]['width']?>" height="<?=$arItem["PREVIEW_PICTURE"]['height']?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<div style="display:none" id="info_<?=$this->GetEditAreaId($arItem['ID']);?>">
<?
echo "<div class=\"gallery_property\"><h4>".$arItem["NAME"]."</h4></div>";
foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty){
echo "<div class=\"gallery_property\"><span class=\"gallery_property_name\">".$arProperty["NAME"].": </span><span class=\"gaalery_property_value\">".$arProperty["VALUE"]."</span></div>";
}?>
			</div>

		</div>
	<?endforeach;?>
	</div>
</div>
</div>