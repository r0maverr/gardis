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
@media screen and (min-width: 992px) {
.bigSlider__name {
    border: 3px solid #fff;
    font-size: 35px;
	}
}
.bigSlider__name {
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #fff;
    text-transform: uppercase;
}
@media screen and (min-width: 992px) {
.bigSlider__name + .bigSlider__text {
    margin-top: 50px;
}
}
.bigSlider__name + .bigSlider__text {
    margin-top: 20px;
}

@media screen and (min-width: 992px) {
.bigSlider__text {
    max-width: 65%;
}
}
.bigSlider__text {
    font-weight: 300;
}
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
			<div class="bigSlider__name"><?=$arItem["NAME"]?></div>
			<div class="bigSlider__text"><p><?=$arItem["DETAIL_TEXT"]?></p></div>
		</div>
	</li>
	<?}?>
</ul>
<?}?>