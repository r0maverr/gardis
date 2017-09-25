<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("not_show_title", "Y");
$APPLICATION->SetTitle("");
?> 

<?$APPLICATION->IncludeComponent("bitrix:news.detail", "gardis_news_detail", array(
	"IBLOCK_TYPE" => "information",
	"IBLOCK_ID" => "27",
	"ELEMENT_ID" => "",
	"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "PREVIEW_PICTURE",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "h1",
		2 => "title",
		3 => "KEYWORDS",
		4 => "DESCRIPTION",
		5 => "",
	),
	"IBLOCK_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "KEYWORDS",
	"META_DESCRIPTION" => "DESCRIPTION",
	"BROWSER_TITLE" => "title",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Страница",
	"PAGER_TEMPLATE" => "",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"BACK_HREF" => "/services/",
	"BACK_TITLE" => "Назад к списку Услуг",
	"USE_SHARE" => "Y",
	"SHARE_HIDE" => "N",
	"SHARE_TEMPLATE" => "",
	"SHARE_HANDLERS" => array(
		0 => "delicious",
		1 => "facebook",
		2 => "lj",
		3 => "twitter",
	),
	"SHARE_SHORTEN_URL_LOGIN" => "",
	"SHARE_SHORTEN_URL_KEY" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>