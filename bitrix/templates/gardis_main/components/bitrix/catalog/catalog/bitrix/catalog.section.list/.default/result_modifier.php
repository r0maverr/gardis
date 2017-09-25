<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if (0 < $arResult['SECTIONS_COUNT'])
{

    $boolClear = false;
    $arNewSections = array();
    foreach ($arResult['SECTIONS'] as &$arOneSection)
    {
        if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
        {
            $boolClear = true;
            continue;
        }
        if ($arSection['PICTURE']){
            $img = CFile::ResizeImageGet($arOneSection['PICTURE'], Array("width" => 400, "height" => 230));
            $arOneSection['PICTURE']['SRC'] = $img['src'];
        }
        $arNewSections[] = $arOneSection;
    }
    unset($arOneSection);
    if ($boolClear)
    {
        $arResult['SECTIONS'] = $arNewSections;
        $arResult['SECTIONS_COUNT'] = count($arNewSections);
    }
    unset($arNewSections);

	
}

?>