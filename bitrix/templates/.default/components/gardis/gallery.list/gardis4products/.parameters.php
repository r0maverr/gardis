<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"BACK_HREF" => Array(
		"NAME" => GetMessage("BACK_HREF"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
	),
	"BACK_TITLE" => Array(
		"NAME" => GetMessage("BACK_TITLE"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
	),
	"MAIN_PHOTO_WIDTH" => Array(
		"NAME" => GetMessage("MAIN_PHOTO_WIDTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "400",
	),
	"SMALL_PHOTO_WIDTH" => Array(
		"NAME" => GetMessage("SMALL_PHOTO_WIDTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "105",
	),
);

?>
