<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//����������� ������� �������� ������� �� ������� ITEMS
foreach($arResult['ITEMS'] as $item)
{
	if($item['INPUT_NAME']==$arResult['FILTER_NAME'].'_pf[TOWN]')
	{
		$town_val=$item['INPUT_VALUE'];
	}
	if($item['INPUT_NAME']==($arResult['FILTER_NAME']+'_pf[STORE]'))
	{
		$store_val=$item['INPUT_VALUE'];
	}
}

//��������� �������� ���� � ������ arrProp � ������ ������ ������� ��� ���� ���� select
foreach($arResult['arrProp'] as $key=>$item)
{
	if($item['CODE']=='TOWN')
	{
		$arResult['arrProp'][$key]['INPUT_VALUE']=$town_val;
		if (CModule::IncludeModule("iblock"))
		{
			$arSelect = Array("ID", "PROPERTY_TOWN");
			$arFilter = Array("IBLOCK_ID"=>22, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, Array('PROPERTY_TOWN'), false, $arSelect);
			$list=Array();
			while($ar_res = $res->GetNext())
				if(strlen($ar_res['PROPERTY_TOWN_VALUE'])>0)
					$list[]=$ar_res['PROPERTY_TOWN_VALUE'];
			$arResult['arrProp'][$key]['LIST']=$list;
		}
	}
	if($item['CODE']=='STORE')
	{
		$arResult['arrProp'][$key]['INPUT_VALUE']=$store_val;
	}
}
?>