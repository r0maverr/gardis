<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

/*$dbSection = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
if($arSect = $dbSection->GetNext())
{
    //p($arSect, 'arSect');
    $arResult['SECTION_BACK'] = $arSect['SECTION_PAGE_URL'];
}*/

foreach ($arResult['ITEMS'] as $key => &$arItem){
    if($arItem['DETAIL_PICTURE']){
        $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array("width" => 400, "height" => 230));
        $arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];
    } 
}
?>