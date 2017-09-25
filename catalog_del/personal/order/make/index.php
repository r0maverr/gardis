<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
//Блокировка каталога для неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
?><?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"COUNT_DELIVERY_TAX" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"ALLOW_AUTO_REGISTER" => "Y",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"DELIVERY_NO_AJAX" => "N",
	"TEMPLATE_LOCATION" => "popup",
	"PROP_1" => array(
	),
	"PATH_TO_BASKET" => "/catalog/personal/cart/",
	"PATH_TO_PERSONAL" => "/catalog/personal/order/",
	"PATH_TO_PAYMENT" => "/catalog/personal/order/payment/",
	"PATH_TO_ORDER" => "/catalog/personal/order/make/",
	"SET_TITLE" => "Y" ,
	"DELIVERY2PAY_SYSTEM" => Array(),
	"SHOW_ACCOUNT_NUMBER" => "Y",
	"DELIVERY_NO_SESSION" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>