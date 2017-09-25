<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дилерам");
?><style>
.got-others.col-xs-12 {
    display: none;
}
</style>
	 	<div class="row block block_bigSlider">
	 		<div class="col-xs-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"krupnim-slider", 
	array(
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "61",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "krupnim-slider"
	),
	false
);?>
</div>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"dealers-slider", 
	array(
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "dealers-slider"
	),
	false
);*/?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc-dealers",
		"EDIT_TEMPLATE" => ""
	)
);*/?>
<div class="col-xs-12"><h2>Наши дилеры</h2></div>
 <?
//Город по умолчанию
if(!$_REQUEST['arrDealersFilter_pf']['TOWN'] //Человек ничего не выбирал
	&& !$_SESSION['arrDealersFilterarrPFV']['TOWN'] //И нет сохраненного выбора в сессии
	)
{
	//$_REQUEST['arrDealersFilter_pf']['TOWN']='Новосибирск';
	$_REQUEST['set_filter'] = "Y";
}

?> 
<?/*$APPLICATION->IncludeComponent(
	"gardis:catalog.filter",
	"gardis_dealers_filter",
	Array(
		"CACHE_GROUPS" => "Y",
		//"AJAX_MODE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "gardis_dealers_filter",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrDealersFilter",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "information",
		"LIST_HEIGHT" => "5",
		"NUMBER_WIDtd" => "5",
		"PRICE_CODE" => array(),
		"PROPERTY_CODE" => array(0=>"TOWN",1=>"STORE",2=>"",),
		"SAVE_IN_SESSION" => "Y",
		"TEXT_WIDtd" => "20"
	)
);*/?> 
<div class="col-xs-12">
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
</div>
<div id="ajax-map-block" class="col-xs-12">
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
<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"gardis-dealers",
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
		"CACHE_TYPE" => "A",
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
);*/?>
<div class="col-xs-12">
<h2>Что мы предлагаем?</h2>
</div>
<div class="col-xs-12">
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"dealer-advantages",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantage",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"DETAIL_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "62",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
</div>
<div class="col-xs-12"><h2>Схема работы</h2></div>
<div class="scheme-container col-xs-12">
	<table class="table-responsive scheme-table">
	<tbody>
	<tr>
		<td rowspan="2">
			<div class="digit">
				1
			</div>
			<h5>Заполнение анкеты дилера</h5>
 <a href="/upload/Anketa-Gardis-dealer.doc" download="Анкета дилера Gardis.doc" title="Анкета дилера Gardis" target="_blank" class="download-link"><span class="dashed">Скачать анкету</span></a>
			<p>
				После заполнения, анкету нужно отправить на почтовый адрес <br>
				<a href="mailto:info@gardies.ru">info@gardies.ru</a>.
			</p>
			<p>
				После этого мы свяжемся с Вами в течение суток.
			</p>
		</td>
		<td class="hidden-xs">
			<img src="/img/next-scheme.png" alt="">
		</td>
		<td>
		<div class="title-action">
			<div class="digit">
				2
			</div>
			<h5><span class="dashed">Утверждение условий сотрудничества</span></h5>
			<p class="title">Простой текст для проверки поведения блоков таблицы.</p>
		</div>
		</td>
		<td class="hidden-xs">
			<img src="/img/next-scheme.png" alt="">
		</td>
		<td>
		<div class="title-action">
			<div class="digit">
				3
			</div>
			<h5><span class="dashed">Подписание договора</span></h5>
			<p class="title">Простой текст для проверки поведения блоков таблицы.</p>
		</div>
		</td>
	</tr>
	<tr>
		<td class="hidden-xs">
			<img src="/img/next-scheme.png" alt="">
		</td>
		<td>
		<div class="title-action">
			<div class="digit">
				4
			</div>
			<h5><span class="dashed">Предоставление доступа<br>
			 к личному кабинету</span></h5>
			 <p class="title">Простой текст для проверки поведения блоков таблицы.</p>
		</div>
		</td>
		<td class="hidden-xs">
			<img src="/img/next-scheme.png" alt="">
		</td>
		<td>
		<div class="title-action">
			<div class="digit">
				5
			</div>
			<h5><span class="dashed">Работа</span></h5>
			<p class="title">Простой текст для проверки поведения блоков таблицы.</p>
		</div>
		</td>
	</tr>
	</tbody>
	</table>
</div>
<!--<a href="#dealers-form-container" class="fancybox2 yellow-button2" title="Начните сотрудничать с нами">Начать сотрудничество</a>-->
<div class="col-xs-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc-scheme",
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>
<div id="dealers-form-container" class="got-form col-xs-12" style="display:none;background:transparent;">
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
</div>
<div class="clear20">
	&nbsp;
</div>
<div class="clear20">
	&nbsp;
</div>
<div class="clear20">
	&nbsp;
</div>
<script type="text/javascript">
	$(function() {
	    $('.scheme-table .title-action').click(function(event) {
	    	$('.scheme-table td').removeClass('active');
	    	$(this).parent('td').addClass('active');
	    });
	});
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>