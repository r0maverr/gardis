<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


$arCompare = "";
$arCherteg = "";

foreach ($arResult['ITEMS'] as $key => &$arItem){
	
    if($arItem['DETAIL_PICTURE']){
        $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array("width" => 400, "height" => 230));
        $arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];
    } 
	
	
	if(is_array($arItem["PROPERTIES"]["SCOPE_APPLICATION"]["VALUE"])){

		$arFilter = array('IBLOCK_ID' => $arItem['LINK_IBLOCK_ID'],"ID"=>$arItem["PROPERTIES"]["SCOPE_APPLICATION"]["VALUE"]); // выберет потомков без учета активности
		$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);

		while ($arSect = $rsSect->GetNext())
		{
			
		
			  $arResult['ITEMS'][$key]["PROPERTIES"]["SCOPE_APPLICATION"]["MODIFY"][] = array(
				  "NAME"=>$arSect["NAME"],
				  "LIST_PAGE_URL"=>$arSect["LIST_PAGE_URL"],
				  "PICTURE"=>CFile::GetFileArray($arSect["PICTURE"])
				  
				  );
		}
		
	}else{
		
		$arResult['ITEMS'][$key]["PROPERTIES"]["SCOPE_APPLICATION"]["MODIFY"] = false;
	}
	
/* TOLSHINA_PRUTKA */	
if(!empty($arItem["PROPERTIES"]["TOLSHINA_PRUTKA"]["VALUE"])){
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["TOLSHINA_PRUTKA"]["MODIFY"] = $arItem["PROPERTIES"]["TOLSHINA_PRUTKA"]["VALUE"];
	
}else{
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["TOLSHINA_PRUTKA"]["MODIFY"] = "Отсутствует";
}
	
/* RAZMER_YACHEIKI */	
if(!empty($arItem["PROPERTIES"]["RAZMER_YACHEIKI"]["VALUE"])){
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["RAZMER_YACHEIKI"]["MODIFY"] = $arItem["PROPERTIES"]["RAZMER_YACHEIKI"]["VALUE"];
	
}else{
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["RAZMER_YACHEIKI"]["MODIFY"] = "Отсутствует";
}
	
/* RAZMERI */	
if(is_array($arItem["PROPERTIES"]["RAZMERI"]["VALUE"])){
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["RAZMERI"]["MODIFY"] = $arItem["PROPERTIES"]["RAZMERI"]["~VALUE"]["TEXT"];
	
}else{
	
	$arResult['ITEMS'][$key]["PROPERTIES"]["RAZMERI"]["MODIFY"] = "Отсутствует";
}


$arCompare .= ','.implode(',',$arItem["PROPERTIES"]["COMPARE_ELEMENTS"]["VALUE"]);
$arCherteg .= ','.$arItem["PROPERTIES"]["IMG_CHERTEG"]["VALUE"];
//echo"compare-: " . $arItem["PROPERTIES"]["COMPARE_ELEMENTS"]["VALUE"]."<br>";
//echo"cherteg-: " . $arItem["PROPERTIES"]["IMG_CHERTEG"]["VALUE"]."<br>";
//echo"<pre>";

//print_r($arItem["PROPERTIES"]["COMPARE_ELEMENTS"]["VALUE"]);

//echo"</pre>";
}

$arCompare = trim($arCompare,',');
$arCompare = explode(',',$arCompare);
$arResult["COMPARE"] = $arCompare;


$arCherteg = trim($arCherteg,',');

$arCherteg = explode(',',$arCherteg);
$arResult["CHERTEG"] = $arCherteg;


//echo $arCompare."<br>";

//echo"<pre>";
//print_r($arCompare);
//print_r($arResult['ITEMS']);
//print_r($arResult['COMPARE']);
//print_r($arResult['CHERTEG']);
//echo"</pre>";

?>