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
.dealer-advantages {
	overflow:hidden;
	position:relative;
	margin:20px 0;
}
</style>
<div class="dealer-advantages owl-slider owl-carousel">
<?
//$i=1;
//$cntItem = count($arResult["ITEMS"]);
foreach($arResult["ITEMS"] as $arItem){?>
	<?
    

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
?>
            
        <div class="advantage-item" id="<?=$this->GetEditAreaId($arItem['ID']); ?>">
            <div class="img">
                <?/*<a class="fancybox" data-fancybox="advantage" href="<?=$arItem['DETAIL_PICTURE']['SRC']?>" title="<?=$arItem['NAME']?>">*/?>
                    <img class="img-responsive" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                <?/*</a>*/?>
            </div>
            
            <div class="name">
                <?=$arItem['NAME']?>
            </div>
            
        </div>
<?}?>   
</div>