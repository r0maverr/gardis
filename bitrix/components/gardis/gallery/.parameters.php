<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arSections = array();
if ($arCurrentValues["IBLOCK_ID"]) {
  $arOrder = array('SORT' => 'ASC');
  $arFilter = array('DEPTH_LEVEL' => 1, 'IBLOCK_ID' => $arCurrentValues["IBLOCK_ID"]);
  $res = CIBlockSection::GetList($arOrder, $arFilter);
  while ($row = $res->Fetch()) {
    $arSections[$row['ID']] = $row['NAME'];
  }
}


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"AJAX_MODE" => array(),
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Тип инфоблока",
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "Инфоблок",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "Раздел",
			"TYPE" => "STRING",
			"TYPE" => "LIST",
			"VALUES" => $arSections,
			"DEFAULT" => '',
		),
  	"GALLERY_STYLE" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => "Вид галереи",
  		"TYPE" => "LIST",
			"VALUES" => array(
        '1' => 'В один ряд',
        '2' => 'В два ряда'
      ),
			"DEFAULT" => '1',
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => "Учитывать права доступа",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);

?>
