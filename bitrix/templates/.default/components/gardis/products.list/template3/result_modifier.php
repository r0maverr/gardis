<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(strlen($arResult['SECTION']['PATH'][0]['ID'])){

//$rsSect = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array('IBLOCK_ID'=>19, 'GLOBAL_ACTIVE'=>'Y', 'PROPERTY'=>Array('UF_CATALOG'=>$arResult['SECTION']['PATH'][0]['ID'])));
$rsSect = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array('IBLOCK_ID'=>19, 'GLOBAL_ACTIVE'=>'Y', 'UF_CATALOG'=>$arResult['SECTION']['PATH'][0]['ID']));

    while($arSect = $rsSect->Fetch())
    {
      $arResult['GALLERY_SECTION_ID'] = $arSect['ID'];
    } 

}
