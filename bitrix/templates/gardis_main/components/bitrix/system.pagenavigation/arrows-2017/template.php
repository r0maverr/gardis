<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$ClientID = 'navigation_'.$arResult['NavNum'];

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>
<div class="clear">&nbsp;</div>

<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

	// to show always first and last pages
	$arResult["nStartPage"] = 1;
	$arResult["nEndPage"] = $arResult["NavPageCount"];

	$sPrevHref = '';
	if ($arResult["NavPageNomer"] > 1)
	{
		$bPrevDisabled = false;
		
		if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
		{
			$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
		}
		else
		{
			$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
		}
	}
	else
	{
		$bPrevDisabled = true;
	}

	$sNextHref = '';
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$bNextDisabled = false;
		$sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
	}
	else
	{
		$bNextDisabled = true;
	}
	?>
		<div class="col-xs-12 col-md-6 navigation">
			<?if (!$bPrevDisabled){?>
			<a href="<?=$arResult["sUrlPath"]?>" class="pp-prev-1" title="На первую страницу">&nbsp;</a>
			<a href="<?=$sPrevHref;?>" class="pp-prev-2" title="Предыдущая страница">&nbsp;</a>
			<?}?>
			<?if (!$bNextDisabled){?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nEndPage"]?>" class="pp-next-1" title="На последнюю страницу">&nbsp;</a>
			<a href="<?=$sNextHref;?>" class="pp-next-2" title="Следующая страница">&nbsp;</a>
			<?}?>
			<div class="navigation-pages">
	<?
	$bFirst = true;
	$bPoints = false;
	do
	{
		if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
		{

			if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
	?>
			<span class="nav-current-page"><?=$arResult["nStartPage"]?></span>
	<?
			elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
	?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
	<?
			else:
	?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
	<?
			endif;
			$bFirst = false;
			$bPoints = true;
		}
		else
		{
			if ($bPoints)
			{
	?>...<?
				$bPoints = false;
			}
		}
		$arResult["nStartPage"]++;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);

if ($arResult["bShowAll"]):
	if ($arResult["NavShowAll"]):
?>
		<a class="nav-page-pagen" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"><?=GetMessage("nav_paged")?></a>
<?
	else:
?>
		<a class="nav-page-all" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_all")?></a>
<?
	endif;
endif;
?>
			</div>
	<div class="clear">&nbsp;</div>
	</div>