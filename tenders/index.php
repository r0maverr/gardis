<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "���������� � ������");
$APPLICATION->SetPageProperty("keywords", "���������� � ������");
$APPLICATION->SetPageProperty("title", "���������� � ������");
$APPLICATION->SetTitle("���������� � ������");
?>
<style>
.got-others.col-xs-12 {
    display: none;
}
</style>
	 	<div class="row block block_bigSlider">
	 		<div class="col-xs-12">
<?$APPLICATION->IncludeComponent("bitrix:news.list", "tenders-slider", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
		"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
		"AJAX_MODE" => "N",	// �������� ����� AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "N",	// �������� ��������� ������
		"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
		"CACHE_GROUPS" => "Y",	// ��������� ����� �������
		"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
		"CACHE_TYPE" => "A",	// ��� �����������
		"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
		"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
		"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
		"DISPLAY_DATE" => "Y",	// �������� ���� ��������
		"DISPLAY_NAME" => "N",	// �������� �������� ��������
		"DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
		"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
		"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
		"FIELD_CODE" => array(	// ����
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",	// ������
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
		"IBLOCK_ID" => "68",	// ��� ��������������� �����
		"IBLOCK_TYPE" => "data",	// ��� ��������������� ����� (������������ ������ ��� ��������)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
		"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
		"MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
		"NEWS_COUNT" => "20",	// ���������� �������� �� ��������
		"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
		"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
		"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
		"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
		"PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
		"PAGER_TITLE" => "�������",	// �������� ���������
		"PARENT_SECTION" => "",	// ID �������
		"PARENT_SECTION_CODE" => "",	// ��� �������
		"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
		"PROPERTY_CODE" => array(	// ��������
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
		"SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
		"SET_META_DESCRIPTION" => "N",	// ������������� �������� ��������
		"SET_META_KEYWORDS" => "N",	// ������������� �������� ����� ��������
		"SET_STATUS_404" => "N",	// ������������� ������ 404
		"SET_TITLE" => "N",	// ������������� ��������� ��������
		"SHOW_404" => "N",	// ����� ����������� ��������
		"SORT_BY1" => "SORT",	// ���� ��� ������ ���������� ��������
		"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
		"SORT_ORDER1" => "ASC",	// ����������� ��� ������ ���������� ��������
		"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
		"COMPONENT_TEMPLATE" => "krupnim-slider"
	),
	false
);?>
	 		</div>
	 	</div>
 		<div class="row block block_text">
	 		<div class="col-xs-12">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	 		</div>
	 	</div> 
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"gotovye-icons",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "gotovye-icons",
		"COUNT_ELEMENTS" => "N",
		"HIDE_SECTION_NAME" => "N",
		"IBLOCK_ID" => "59",
		"IBLOCK_TYPE" => "information",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"UF_ICON",1=>"UF_ICON_A",2=>"",),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	)
);?>
<div class="clear">&nbsp;</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"gotovye-items",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "59",
		"IBLOCK_TYPE" => "information",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "� �������",
		"MESS_BTN_BUY" => "������",
		"MESS_BTN_DETAIL" => "���������",
		"MESS_BTN_SUBSCRIBE" => "�����������",
		"MESS_NOT_AVAILABLE" => "��� � �������",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "������",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(0=>"HEIGHT",1=>"OTHER",2=>"LINK",3=>"TYPE",4=>"COLOR",5=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
	 	<div class="row block block_brandsSlider">
	 		<div class="col-xs-12">
				<div class="block__title">
					� ���� ��������
				</div>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "gardis-customers-slider", Array(
	"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",	// �������� �������� ��������
		"DISPLAY_PICTURE" => "Y",	// �������� ��������� �����������
		"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
		"AJAX_MODE" => "N",	// �������� ����� AJAX
		"IBLOCK_TYPE" => "information",	// ��� ��������������� ����� (������������ ������ ��� ��������)
		"IBLOCK_ID" => "16",	// ��� ��������������� �����
		"NEWS_COUNT" => "2000",	// ���������� �������� �� ��������
		"SORT_BY1" => "SORT",	// ���� ��� ������ ���������� ��������
		"SORT_ORDER1" => "ASC",	// ����������� ��� ������ ���������� ��������
		"SORT_BY2" => "NAME",	// ���� ��� ������ ���������� ��������
		"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
		"FILTER_NAME" => "",	// ������
		"FIELD_CODE" => array(	// ����
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// ��������
			0 => "HREF",
			1 => "",
		),
		"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
		"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
		"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
		"SET_TITLE" => "N",	// ������������� ��������� ��������
		"SET_STATUS_404" => "N",	// ������������� ������ 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
		"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
		"PARENT_SECTION" => "",	// ID �������
		"PARENT_SECTION_CODE" => "",	// ��� �������
		"CACHE_TYPE" => "A",	// ��� �����������
		"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
		"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
		"CACHE_GROUPS" => "Y",	// ��������� ����� �������
		"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
		"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
		"PAGER_TITLE" => "�������",	// �������� ���������
		"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
		"PAGER_TEMPLATE" => "arrows-2017",	// ������ ������������ ���������
		"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
		"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"COMPONENT_TEMPLATE" => "gardis_customers",
		"AJAX_OPTION_ADDITIONAL" => "undefined",	// �������������� �������������
		"SET_BROWSER_TITLE" => "Y",	// ������������� ��������� ���� ��������
		"SET_META_KEYWORDS" => "Y",	// ������������� �������� ����� ��������
		"SET_META_DESCRIPTION" => "Y",	// ������������� �������� ��������
		"SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
		"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
		"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
		"SHOW_404" => "N",	// ����� ����������� ��������
		"MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
	),
	false
);?>
	 			<div class="brandsSlider__bottom">
	 				<a href="/about/reviews/" class="button">�������� ������</a>
	 				<a href="#tenders-form-container" class="button fancybox2">���������� � ������</a>
	 			</div>
	 		</div>
	 	</div>

<div id="tenders-form-container" class="got-form2" style="display:none;background:transparent;">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"request-form-tenders",
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
		"WEB_FORM_ID" => "14"
	)
);?>
</div>
<div class="clear20">
	&nbsp;
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>