<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("FORM_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("FORM_COMPONENT_DESCR"),
	"ICON" => "/images/form.gif",
	"SORT" => 20,    
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "marketica",
		"CHILD" => array(
			"ID" => "mSlider",
			"NAME" => "Информационный слайдер",
            "SORT" => 50,
			"CHILD" => array(
				"ID" => "form_cmpx",
			),
		),
	),
);
?>