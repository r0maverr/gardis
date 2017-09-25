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
            <div class="col-sm-1 col-md-2 "></div>
            <div class="img-wrap col-sm-1 col-md-2 ">
                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="" style="margin:0;">
            </div>
            <div class="description-wrap col-sm-10 col-md-8 block_name_otz" style="padding-top:30px;">
                <div class="name">
                    <?=$arItem['NAME']?>
                </div>
                <?if($arItem['PROPERTIES']['POSITION']['VALUE']){?>
                    <div class="position">
                        <?=$arItem['PROPERTIES']['POSITION']['VALUE']?>
                    </div>
                <?}?>
			</div>
            <div class="description-wrap col-sm-offset-1 col-md-offset-2 col-sm-10 col-md-8">
                <div class="col-xs-12 pre-text">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
				<button class="learn_text-more onClickMore">Читать полностью</button>
            </div>
			
			<div class="col-md-7 col-sm-9 col-sm-offset-2 col-md-offset-3 asdasd" style="position:relative;margin-top:-20px;">
				<div class="button btn-mob">
					<a class="learn-more btn btn-green wdth226" href="">
						<?=Loc::getMessage("GO_CATALOG")?>
					</a>
					<div class="btn-order btn btn-yellow wdth226 onClickOrderCall">
						<?=Loc::getMessage("GET_CONSULT")?>
					</div>
				</div>
			</div>
        </div>
    <?
        $i++;
    }?>
</div>
