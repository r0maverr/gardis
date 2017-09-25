<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Счет пользователя");
//Блокировка каталога для неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.account",
	"",
	Array(
		"SET_TITLE" => "Y" 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>