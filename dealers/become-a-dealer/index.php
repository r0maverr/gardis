<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("����� �������");
?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent("gardis:become_dealer", "template_yacounter", array(
	"USE_CAPTCHA" => "N",
	"OK_TEXT" => "�������, ���� ��������� �������.",
	"EMAIL_TO" => "",
	"FORM_TITLE" => "�������� ������ ������:",
	"BUTTON_TITLE" => "���������",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "27",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>