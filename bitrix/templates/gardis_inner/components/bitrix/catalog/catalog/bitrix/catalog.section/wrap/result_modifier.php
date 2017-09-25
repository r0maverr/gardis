<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$dbSection = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
if($arSect = $dbSection->GetNext())
{
    //p($arSect, 'arSect');
    $arResult['SECTION_BACK'] = $arSect['SECTION_PAGE_URL'];
}
?>