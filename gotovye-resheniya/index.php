<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������� �������");
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"gotovye-icons", 
	array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "gotovye-icons",
		"COUNT_ELEMENTS" => "N",
		"HIDE_SECTION_NAME" => "N",
		"IBLOCK_ID" => "59",
		"IBLOCK_TYPE" => "information",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_ICON",
			1 => "UF_ICON_A",
			2 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	),
	false
);?>
<div class="clear">&nbsp;</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"gotovye-items", 
	array(
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
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "HEIGHT",
			1 => "OTHER",
			2 => "LINK",
			3 => "GOODS",
			4 => "TYPE",
			5 => "COLOR",
			6 => "",
		),
		"SECTION_CODE" => !empty($_REQUEST["SECTION_CODE"]) ? $_REQUEST["SECTION_CODE"] : 'shkoly',
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_CODE",
		"SECTION_URL" => "/gotovye-resheniya/#SECTION_CODE#",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
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
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "gotovye-items",
		"SEF_RULE" => "#SECTION_CODE#",
		"SECTION_CODE_PATH" => ""
	),
	false
);?>

<div class="got-form">
<h4 class="text-center">��������� ������������ �� �����������</h4>
<?$APPLICATION->IncludeComponent("bitrix:form", "request-form", Array(
	"AJAX_MODE" => "Y",	// �������� ����� AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
		"CACHE_TIME" => "3600",	// ����� ����������� (���.)
		"CACHE_TYPE" => "A",	// ��� �����������
		"CHAIN_ITEM_LINK" => "",	// ������ �� �������������� ������ � ������������� �������
		"CHAIN_ITEM_TEXT" => "",	// �������� ��������������� ������ � ������������� �������
		"EDIT_ADDITIONAL" => "N",	// �������� �� �������������� �������������� ����
		"EDIT_STATUS" => "N",	// �������� ����� ����� �������
		"IGNORE_CUSTOM_TEMPLATE" => "N",	// ������������ ���� ������
		"NOT_SHOW_FILTER" => array(	// ���� �����, ������� ������ ���������� � �������
			0 => "",
			1 => "",
		),
		"NOT_SHOW_TABLE" => array(	// ���� �����, ������� ������ ���������� � �������
			0 => "",
			1 => "",
		),
		"RESULT_ID" => $_REQUEST[RESULT_ID],	// ID ����������
		"SEF_MODE" => "N",	// �������� ��������� ���
		"SHOW_ADDITIONAL" => "N",	// �������� �������������� ���� ���-�����
		"SHOW_ANSWER_VALUE" => "N",	// �������� �������� ��������� ANSWER_VALUE
		"SHOW_EDIT_PAGE" => "N",	// ���������� �������� �������������� ����������
		"SHOW_LIST_PAGE" => "N",	// ���������� �������� �� ������� �����������
		"SHOW_STATUS" => "Y",	// �������� ������� ������ ����������
		"SHOW_VIEW_PAGE" => "N",	// ���������� �������� ��������� ����������
		"START_PAGE" => "new",	// ��������� ��������
		"SUCCESS_URL" => "",	// �������� � ���������� �� �������� ��������
		"USE_EXTENDED_ERRORS" => "N",	// ������������ ����������� ����� ��������� �� �������
		"VARIABLE_ALIASES" => array(
			"action" => "action",
		),
		"WEB_FORM_ID" => "8",	// ID ���-�����
	),
	false
);?>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>