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
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
?> 
<?$this->addExternalCss($templateFolder."/lightslider.css");?>
<?$this->addExternalJS($templateFolder."/lightslider.js");?>
<div class="row block block_bigSlider" style="">
	<div class="col-xs-12">
		<ul id="bigSlider" class="bigSlider">
		<?foreach($arResult["ITEMS"] as $arItem){?>
        <?
        if(!$arItem['PREVIEW_PICTURE'])
            continue;
        
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
			<li class="bigSlider__item" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="bigSlider__content">
					<div class="bigSlider__text"><?=$arItem['PREVIEW_TEXT']?></div>
				</div>
			</li>					
		<?}?>				
	 				
		</ul>
	</div>
</div>

