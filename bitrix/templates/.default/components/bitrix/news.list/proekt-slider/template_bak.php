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

<div class="reviews-list owl-carousel">
    <?
    $i = 1;
    $cntItem = count($arResult["ITEMS"]);
    foreach($arResult["ITEMS"] as $arItem){?>
        <?
        if(!$arItem['PREVIEW_PICTURE'])
            continue;
        
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="slide-item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="col-md-1 col-sm-1"></div>
            <div class="img-wrap col-md-3 col-sm-3">
                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
            </div>
            <div class="description-wrap col-md-7 col-sm-7">
                <div class="name">
                    <?=$arItem['NAME']?>
                </div>
                <?if($arItem['PROPERTIES']['POSITION']['VALUE']){?>
                    <div class="position">
                        <?=$arItem['PROPERTIES']['POSITION']['VALUE']?>
                    </div>
                <?}?>
                <div class="preview-text">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
            </div>
        </div>
    <?
        $i++;
    }?>
</div>

<div class="row">
    <div class="col-md-7 col-sm-7 col-md-offset-4 col-sm-offset-4">
        <div class="button">
            <a class="learn-more btn btn-green" href="">
                <?=Loc::getMessage("GO_CATALOG")?>
            </a>
            <div class="btn-order btn btn-yellow" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                <?=Loc::getMessage("GET_CONSULT")?>
            </div>
        </div>
    </div>
</div>