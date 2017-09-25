<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//p($arResult, 'arResult');
foreach($arResult["ITEMS"] as &$arItem)
{
    $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width'=>165, 'height'=>165), BX_RESIZE_IMAGE_EXACT);
    $arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];
}
?>