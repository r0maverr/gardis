<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetTitle("Контакты");

//Новое в разметке посетителей (класс подключается в init.php)
$arRef = CMyUTM::GetSource();
//if($arRef['clid'] == 'Директ' || ($arRef['first'] == 'Директ' && !$arRef['clid'])) //показываем если хоть раз с директа
if($arRef['clid'] == 'Директ'){ //показываем только если в этот раз с директа
   $phone = '239-00-27';
   $email = 'info-d@gardies.ru';
}elseif($arRef['clid'] == 'Гугл'){
   $phone = '319-00-19';
   $email = 'info-a@gardies.ru';
}else{
   $phone = '319-00-19';
   $email = 'info-s@gardies.ru';
}

?><div class="content"><!--div class="container"--> <style>
@media (min-width:768px){
	iframe:first-child {
		margin-top: -44px;
	}
}
@media(max-width:767px){
    iframe{
		height: 350px !important;
	}
}
p{margin-bottom:0px !important}
</style>
<div class="row">
	<div class="col-md-4">
		<div>
			<p>
				 Металлические ограждения «Gardis»
			</p>
			<p>
				 ООО «ПГС-К»
			</p>
			<p itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> <span itemprop="postalCode">630025</span>, г. <span itemprop="addressLocality">Новосибирск</span>, <br> ул. <span itemprop="streetAddress">Бердское шоссе, 61</span>, корпус 2 <br>
				 e-mail: <span itemprop="email"><a href="mailto:<?=$email?>"><?=$email?></a></span><br>
				 Тел.: <span itemprop="telephone" class="comagicphone">8-383-319-00-19<br>&emsp;&emsp;&ensp;8-800-200-21-47<br>
			</span> </span>
			</p>
			<p>
				 Склад: 633004, г. Бердск, ул. Барнаульская 8
			</p>
			<p itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><span itemprop="telephone" class="comagicphone"><br>
 </span></span>
			</p>
			<p itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><span itemprop="telephone" class="comagicphone"><b>РЕКВИЗИТЫ<br>
 <br>
 </b></span></span>
			</p>
		</div>
		<div>
			<p>
				 ООО «ПГС-К»
			</p>
			<p>
				 Юр. адрес: 630025, г. Новосибирск, <br> ул. Бердское шоссе, дом 61
			</p>
			<p>
				 Фактический адрес: 630025, г. Новосибирск, <br> ул. Бердское шоссе, дом 61
			</p>
			<p>
				 ИНН: 5406221521
			</p>
			<p>
				 КПП: 540901001
			</p>
			<p>
				 Р/счет: №40702810429120000351 в ОАО <br> МДМ БАНК г. Новосибирск
			</p>
			<p>
				 Кор.счет: 30101810100000000821
			</p>
			<p>
				 БИК: 045004821
			</p>
		</div>
	</div>

	<div class="col-md-8 contacts-map">
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"contacts__map", 
	array(
		"COMPONENT_TEMPLATE" => "contacts__map",
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc_ymap",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
	</div>

</div>

<h2 class="mapChangeText">Наши дилеры</h2>
<?$APPLICATION->IncludeComponent(
	"gardis:catalog.filter",
	"gardis_dealers_filter-map",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "gardis_dealers_filter-map",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrDealersFilter",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "information",
		"LIST_HEIGHT" => "5",
		"NUMBER_WIDTH" => "5",
		"NUMBER_WIDtd" => "5",
		"PRICE_CODE" => array(),
		"PROPERTY_CODE" => array(0=>"TOWN",1=>"",),
		"SAVE_IN_SESSION" => "N",
		"TEXT_WIDTH" => "20",
		"TEXT_WIDtd" => "20"
	)
);?>
<div id="ajax-map-block">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"gardis-dealers-contacts",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "gardis-dealers",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrDealersFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2000",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"TOWN",1=>"ADRESS",2=>"PHONES",3=>"EMAIL",4=>"POS_GOOGLE_MAPS",5=>"SITE",6=>"SITE2",7=>"STORE",8=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_TOWN",
		"SORT_BY2" => "PROPERTY_TOWN",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<div id="ajax-cities-block">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"gardis-dealers-contacts-list",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "gardis-dealers-contacts-list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrDealersFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2000",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"TOWN",1=>"ADRESS",2=>"PHONES",3=>"EMAIL",4=>"POS_GOOGLE_MAPS",5=>"SITE",6=>"SITE2",7=>"STORE",8=>"MOUNTING",9=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_TOWN",
		"SORT_BY2" => "PROPERTY_TOWN",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<div id="dealers-form-container" class="got-form" style="display:none;background:transparent;">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"request-form",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"NOT_SHOW_FILTER" => array(0=>"",1=>"",),
		"NOT_SHOW_TABLE" => array(0=>"",1=>"",),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "N",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => array("action"=>"action",),
		"WEB_FORM_ID" => "11"
	)
);?>
</div></div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>