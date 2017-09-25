<?
// use Bitrix\Main\Type\Collection;
// use Bitrix\Currency\CurrencyTable;
// use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
//p($arResult);

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);

	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{

		$arFileTmp = CFile::ResizeImageGet(
			$arFile,
			array("width" => 75, "height" => 75),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);

		$arFile['PREVIEW_WIDTH'] = $arFileTmp["width"];
		$arFile['PREVIEW_HEIGHT'] = $arFileTmp["height"];

		$arFile['SRC_PREVIEW'] = $arFileTmp['src'];
		$arResult['MORE_PHOTO'][$key] = $arFile;
	}
}
?>