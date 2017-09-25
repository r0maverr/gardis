<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//Ѕлокировка каталога дл€ неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
$APPLICATION->SetTitle("–егул€рные платежи");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.subscribe",
	"",
	Array(
		"SEF_MODE" => "N", 
		"PER_PAGE" => "20", 
		"SET_TITLE" => "Y" 
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>