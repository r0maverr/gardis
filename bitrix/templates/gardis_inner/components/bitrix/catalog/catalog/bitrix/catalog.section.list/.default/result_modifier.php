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
//p($arResult, 'arResult');
/*if (0 < $arResult['SECTIONS_COUNT'])
{

    foreach ($arResult['SECTIONS'] as $key => $arSection)
    {
        $arMap[$arSection['ID']] = $key;
    }
    $rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
    while ($arSection = $rsSections->GetNext())
    {
        if (!isset($arMap[$arSection['ID']]))
            continue;
        $key = $arMap[$arSection['ID']];
        if ($boolPicture)
        {
            $arSection['PICTURE'] = intval($arSection['PICTURE']);
            $arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
            $arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
            $arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
        }
        if ($boolDescr)
        {
            $arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
            $arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
            $arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
            $arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
        }
    }
}*/
?>