<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Узнать стоимость");
?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent("gardis:become_dealer", "get_price", array(
	"USE_CAPTCHA" => "N",
	"OK_TEXT" => "Ваше сообщение отправлено. Наш менеджер свяжется с вами.",
	"EMAIL_TO" => "info@gardies.ru",
	"FORM_TITLE" => "Узнать стоимость:",
	"BUTTON_TITLE" => "Отправить",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "29",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>