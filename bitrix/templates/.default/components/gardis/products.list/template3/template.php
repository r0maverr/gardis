<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CAjax::Init();?>
<h1><?if(strlen($arResult['SECTION']['PATH'][0]['NAME'])>0):echo $arResult['SECTION']['PATH'][0]['NAME']; else:?>���������<?endif;?></h1>
<?//By Spawn, adding Gallery
if( strlen($arResult["GALLERY_SECTION_ID"])>0
//&& $USER->isAdmin() //fixme 4 testing
){
?>
<?$APPLICATION->IncludeComponent(
	"gardis:gallery.list", 
	"gardis4products", 
	array(
		"IBLOCK_TYPE" => "information",
		"IBLOCK_ID" => "19",
		"NEWS_COUNT" => "18",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "panels",
			1 => "pillars",
			2 => "fixings",
			3 => "coat",
			4 => "entrances",
			5 => "accessories",
			6 => "entrance",
			7 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => $arResult["GALLERY_SECTION_ID"],
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "�������",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"BACK_HREF" => "/gallery/",
		"BACK_TITLE" => "����� � ������ ��������",
		"USE_SHARE" => "N",
		"SHARE_HIDE" => "N",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array(
			0 => "facebook",
			1 => "delicious",
			2 => "lj",
			3 => "twitter",
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "gardis4products",
		"MAIN_PHOTO_WIDTH" => "415",
		"SMALL_PHOTO_WIDTH" => "95"
	),
	false
);?>
<h2 class="gallery_header">��������������� ������</h2>
<?}else{?>
<center style="margin-top: -60px; margin-bottom: 10px; margin-left: 438px;height: 32px;">
<a href="#ask_price" onclick="_gaq.push(['_trackEvent', 'all_pages', 'request_price_submit',,, true]); yaCounter24428276.reachGoal('ORDER'); return true;" class="fancybox grey_nice_button request_price_submit">������ ���������</a>
<?$APPLICATION->IncludeComponent("gardis:ask_price", "template1", Array(
	"USE_CAPTCHA" => "N",	// ������������ ������ �� �������������� ��������� (CAPTCHA) ��� ���������������� �������������
	"OK_TEXT" => "���� ��������� ����������. ��� �������� �������� � ����.",	// ���������, ��������� ������������ ����� ��������
	"EMAIL_TO" => "info@gardies.ru",	// E-mail, �� ������� ����� ���������� ������
	"PRODUCT_NAME" => "",	// ������������ ������
	"REQUIRED_FIELDS" => array(	// ������������ ���� ��� ����������
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(	// �������� ������� ��� �������� ������
		0 => "28",
	)
	),
	false
);?>
<?php /*<a href="/contacts/ask-a-question/"><img src="/bitrix/images/button_new.jpg"></a>*/ ?>
</center>
<?}?>
<?if (getenv('REQUEST_URI')=='/products/'): ?>
<p>
������������� ����������. ������ ����������� �� ��������� ��������: �� ���������� �������� �� ���������� ���������������� �����������, ��� �������� ��������� ��������������, ������������ ��������.
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
<div style="display: none;" id="hide-text">
<h2>������ ����� � ���������� ������������ ��������</h2>
<p>�������� ������� ���������� ������������� ������ � 2002 ����. �� ��� ����� �� �������� �����
������������ �������. �� ������� ����� ����. ������ ���������� ����� ��� ���� ��������:</p>
<ul>
<li>������������ �����������;</li>
<li>������;</li>
<li>���������� � ������� �������;</li>
<li>������ � �������� ����������;</li>
<li>���������� ������������ ��������.</li>
</ul>
<p>
����� ���������� ������. ����� ����� ������� ��� ����������� ����� ������ ������ ������ ����� � ������������, ����������� � ��� ��������� ������� ����� �������� � ���, ��� ��� �������� ��������� �����������. ���������� ������� ����� �������������� ������� �� ���� �������������. 
</p>
<br>
</div>
<h2>������� ������</h2>
		  <div class="line" style="border-top: 1px dotted black; margin-bottom: 20px;"></div>
<p><span id="toggle-hide-text">���������� ����������</span> ������������ ������� ��������� ������, ������� �������, ���������, ������� �������������� ������ � ������� �����. ������� ���������� ��� ��� ���� ���������.</p>
<br>
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
<div class="clear"></div>
<p>��� �������� ����������� ������� �� ������������ �����. �� ��������� ��� �������� ������� �����������. ����� �������, ������, ���� �� ������� ���������� �� ��������� � ��������, �������������� � ������ ����������� � �������� ����� �� ������ ��������� ������ � ������������� ����������. </p>

<script>
	$(function(){
		$('#toggle-hide-text').click(function(){$('#hide-text').toggle();});
	});
</script>