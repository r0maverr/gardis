<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CAjax::Init();?>
<h1><?if(strlen($arResult['SECTION']['PATH'][0]['NAME'])>0):echo $arResult['SECTION']['PATH'][0]['NAME']; else:?>Продукция<?endif;?></h1>
<center style="margin-top: -60px; margin-bottom: 10px; margin-left: 438px;height: 32px;">
<a href="#ask_price" onclick="yaCounter24428276.reachGoal('ORDER'); return true;" class="fancybox nice_button violet_nice_button">Узнать стоимость</a>
<?$APPLICATION->IncludeComponent("gardis:ask_price", ".default", array(
	"USE_CAPTCHA" => "N",
	"OK_TEXT" => "Ваше сообщение отправлено. Наш менеджер свяжется с вами.",
	"EMAIL_TO" => "",
	// "PRODUCT_NAME" => $GLOBALS["gardis_product_name"],
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "28",
	)
	),
	false
);?>
<?php /*<a href="/contacts/ask-a-question/"><img src="/bitrix/images/button_new.jpg"></a>*/ ?>
</center>
<?if (getenv('REQUEST_URI')=='/products/'): ?>
<p>
Универсальные ограждения. Широко применяются на различных объектах: от спортивных площадок до территорий производственных предприятий, для участков городской инфраструктуры, строительных площадок.
</p>
<br />

<br />
<?endif;?>
<div id="product_list" pid="<?=CAjax::GetComponentID("bitrix:news.list","gardis_products_list",false)?>">
<?$i = 0; $j = 0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
        <?if($arItem["DISPLAY_PROPERTIES"]["OPTIONAL_EQUIPMENT"]["VALUE"] && $j == 0):?>
		  <div class="clear"></div>
<h2>Входные группы</h2>
		  <div class="line" style="border-top: 1px dotted black; margin-bottom: 30px;"></div>
	          <?$j++; $i = 1;?>
	<?endif;?>
	<div class="product_card <?echo $i;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<div class="product_card_img_container">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				</div>
			<?else:?>
				<div class="product_card_img_container">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				</div>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]; ?></a>
			<?else:?>
				<a href="#"><?echo $arItem["NAME"]?></a>
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
		<?endif;?>
	</div>
	<?if(fmod($i,2)==0):?>
		<div class = "clear"></div>                                     
	<?endif;?>                                                              
<?endforeach;?>
</div>