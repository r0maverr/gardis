<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($APPLICATION->GetCurPage()=="/products/"){
	foreach($arResult as $key=>$Item){
		$arResult[$key]['ON_CLICK']="return ReplaceContent('".$Item["LINK"]."','".$Item["TEXT"]."');";
	}
}

?>