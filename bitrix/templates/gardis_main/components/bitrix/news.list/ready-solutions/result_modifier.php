<?/*handmade*/
foreach($arResult['ITEMS'] as $keyItem => $arItem){
    $res = CIBlockSection::GetByID($arItem['PROPERTIES']['URL']['VALUE']);
    $ar_res = $res->GetNextElement();
    $ar_fields = $ar_res->GetFields();
    $arResult['ITEMS'][$keyItem]['PROPERTIES']['URL']['ITEM_CODE'] = $ar_fields['CODE'];
}
?>