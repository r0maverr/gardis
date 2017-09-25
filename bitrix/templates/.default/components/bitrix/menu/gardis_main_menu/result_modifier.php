<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//Ќаходим последний родительский элемент дл€ пометки и последующего добавлени€ id="last_ul"
$id=0;
foreach($arResult as $key=>$elem)
	if($elem["IS_PARENT"]==1)$id=$key;
if($id>0)$arResult[$id]["LAST_UL"]=1;
?>