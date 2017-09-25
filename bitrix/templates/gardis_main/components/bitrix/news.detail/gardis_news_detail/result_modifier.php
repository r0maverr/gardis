<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//p($arResult, 'arResult');
    $file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>210, 'height'=>210), BX_RESIZE_IMAGE_EXACT);
    $arResult['PREVIEW_PICTURE']['SRC'] = $file['src'];
    $arResult['PREVIEW_PICTURE']['WIDTH'] = 210;
    $arResult['PREVIEW_PICTURE']['HEIGHT'] = 210;

?>