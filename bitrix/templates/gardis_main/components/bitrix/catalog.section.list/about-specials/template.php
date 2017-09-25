<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<ul class="special-list">
<?
foreach ($arResult['SECTIONS'] as &$arSection)
{
?>
<li class="col-md-6"><a href="<?=$arSection['SECTION_PAGE_URL']?>?SECTION_ID=<?=$arSection['ID']?>"><?=$arSection['NAME']?></a></li>
<?}?>
<div class="clear">&nbsp;</div>
</ul>
