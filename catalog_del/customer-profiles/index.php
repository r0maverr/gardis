<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//���������� �������� ��� ���������������� � �� �������������� �����������
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
$APPLICATION->SetTitle("������� ����������");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.profile",
	"",
	Array(
		"SEF_MODE" => "N", 
		"PER_PAGE" => "20", 
		"SET_TITLE" => "Y" 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>