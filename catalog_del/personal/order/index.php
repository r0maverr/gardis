<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
//Блокировка каталога для неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
?><?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", array(
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/catalog/personal/order/",
	"ORDERS_PER_PAGE" => "10",
	"PATH_TO_PAYMENT" => "/catalog/personal/order/payment/",
	"PATH_TO_BASKET" => "/catalog/personal/cart/",
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "N",
	"NAV_TEMPLATE" => "arrows",
	"SEF_URL_TEMPLATES" => array(
		"list" => "index.php",
		"detail" => "detail/#ID#/",
		"cancel" => "cancel/#ID#/",
	),
	"SHOW_ACCOUNT_NUMBER" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>