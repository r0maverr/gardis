<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("���������� � ���������");
?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?>
<div><?$APPLICATION->IncludeComponent("gardis:become_dealer", "template2", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "���� ��������� ����������. ��� �������� �������� � ����.",
	"EMAIL_TO" => "top@solos.ru",
	"FORM_TITLE" => "������ ������ ���������:",
	"BUTTON_TITLE" => "���������",
	"REQUIRED_FIELDS" => array(
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "30",
	)
	),
	false
);?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>