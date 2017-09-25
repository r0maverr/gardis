<?
/*echo '<pre>';
print_r($arResult);
echo '<pre>';*/
foreach($arResult['SECTIONS'] as $key=>$arItem)
{
	if($arItem['UF_MAIN']==0) unset($arResult['SECTIONS'][$key]);
	else
	{
		$file = CFile::ResizeImageGet($arItem['UF_IMAGE'], array('width'=>29, 'height'=>28), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult['SECTIONS'][$key]['UF_IMAGE']=$file;
	}
}
?>