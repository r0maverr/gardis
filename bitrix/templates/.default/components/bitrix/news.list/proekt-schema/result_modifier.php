<?

if(!empty($arResult["ITEMS"])){
	
	$arItems = $arResult["ITEMS"];
	
	foreach($arItems as $k=>$arElem){
		if(!empty($arElem["PROPERTIES"]["MEDIA_FILE"]["VALUE"])){
		$arResult["ITEMS"][$k]["PROPERTIES"]["MEDIA_FILE"]["MODIFY"] =  CFile::GetFileArray($arElem["PROPERTIES"]["MEDIA_FILE"]["VALUE"]);
		}else{
			$arResult["ITEMS"][$k]["PROPERTIES"]["MEDIA_FILE"]["MODIFY"] =  $arElem['PREVIEW_PICTURE']['SRC'];			
		}
	}
	
}
?>