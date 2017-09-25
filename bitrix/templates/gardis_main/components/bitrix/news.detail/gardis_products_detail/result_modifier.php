<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*echo '<pre>';
print_r($arResult);
echo '</pre>';*/

//Достаём путь до галлереи
if($arResult['PROPERTIES']['GALLERY']['VALUE']>0)
{
	$res = CIBlockSection::GetByID($arResult['PROPERTIES']['GALLERY']['VALUE']);
	if($ar_res = $res->GetNext())
	$arResult['GALLERY']=$ar_res['SECTION_PAGE_URL'];
}
//Достаём путь до файла
/*
if($arResult['PROPERTIES']['FILE']['VALUE']>0)
{
	$arResult['PDF_FILE']=CFile::GetPath($arResult['PROPERTIES']['FILE']['VALUE']);
}
*/

// получаем пути для файлов
$arResult['PDF_FILES'] = array();
foreach ($arResult['PROPERTIES']['FILE']['VALUE'] as $key => $fid) {
  $path = CFile::GetPath($fid);
	$arResult['PDF_FILES'][] = array(
  'PATH' => $path,
  'NAME' => (!empty($arResult['PROPERTIES']['FILE']['DESCRIPTION'][$key])) ? $arResult['PROPERTIES']['FILE']['DESCRIPTION'][$key] : substr($path, strrpos($path, '/') + 1),
  );
}

//Достаём инфу по связанным товарам
foreach($arResult['PROPERTIES']['BIND']['VALUE'] as $val)
{
	$res = CIBlockElement::GetByID($val);
	if($ar_res = $res->GetNext())
	{
		$temp_arr=Array();
		$temp_arr['NAME']=$ar_res['NAME'];
		$temp_arr['DETAIL_PAGE_URL']=$ar_res['DETAIL_PAGE_URL'];
		$file = CFile::ResizeImageGet($ar_res['PREVIEW_PICTURE'], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
		$temp_arr['PICTURE']=Array(
			"SRC"=>$file['src'],
			"WIDTH"=>$file['width'],
			"HEIGHT"=>$file['height'],
		);
		$arResult['PROPERTIES']['BIND']['CATALOG_LIST'][]=$temp_arr;
	}
}
$GLOBALS['gardis_product_name']=$arResult["NAME"];
?>