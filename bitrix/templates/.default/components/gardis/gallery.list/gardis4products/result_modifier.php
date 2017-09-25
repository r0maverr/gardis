<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//Уменьшим картинки до нужных в параметрах
$widthMain = $arParams['MAIN_PHOTO_WIDTH'] ? $arParams['MAIN_PHOTO_WIDTH'] : 415;
$widthSmall = $arParams['SMALL_PHOTO_WIDTH'] ? $arParams['SMALL_PHOTO_WIDTH'] : 95;

foreach($arResult['ITEMS'] as $key => $arElement){

$arResult["ITEMS"][$key]["DETAIL_PICTURE"] = CFile::ResizeImageGet(
   $arElement["DETAIL_PICTURE"]["ID"], 
   array(
      'width'=>$widthMain,
      'height'=>$widthMain
   ), 
   BX_RESIZE_IMAGE_PROPORTIONAL,
   Array(
      "name" => "sharpen", 
      "precision" => 0
   ));
$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
   $arElement["PREVIEW_PICTURE"]["ID"], 
   array(
      'width'=>$widthSmall,
      'height'=>$widthSmall
   ), 
   BX_RESIZE_IMAGE_PROPORTIONAL,
   Array(
      "name" => "sharpen", 
      "precision" => 0
   ));
 
}