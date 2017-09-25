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
<style>

</style>
<?
if (!empty($arResult['ITEMS']))
{
?>
<script type="text/javascript" src="/js/bundle.js"></script>
<link rel="stylesheet" type="text/css" href="/css/awStyle.css">
<ul id="bigSlider" class="bigSlider" style="">
	<?foreach ($arResult['ITEMS'] as $key => $arItem){?>
	<li class="bigSlider__item" style="height:429px;background-image: url('<?=$arItem["DETAIL_PICTURE"]["SRC"]?>');">
		<div class="bigSlider__content">
			<div class="bigSlider__text"><h2><?=$arItem["DETAIL_TEXT"]?></h2></div>
		</div>
	</li>
	<?}?>
</ul>
<?}?>