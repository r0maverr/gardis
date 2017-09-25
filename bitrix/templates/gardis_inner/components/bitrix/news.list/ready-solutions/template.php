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
<div class="ready-solutions-list-icon owl-carousel">
        <?foreach($arResult["ITEMS"] as $arItem){?>
            <?
            if(!$arItem['DETAIL_PICTURE'])
                continue;
            ?>
            <div class="preview-wrap">
                <div class="img-wrap">
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                </div>
                <div class="name-preview">
                    <?=$arItem['NAME']?>
                </div>
            </div>
           
        <?}?>
</div>

<?/*<div class="ready-solutions-list-icon ">
    <div class="wrap-carusel-content">
        <div class="owl-thumbs clearfix" data-slider-id="1">
            <?foreach($arResult["ITEMS"] as $arItem){?>
                <?
                if(!$arItem['DETAIL_PICTURE'])
                    continue;
                ?>
                <div class="preview-wrap owl-thumb-item">
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">

                    <div class="name-preview">
                        <?=$arItem['NAME']?>
                    </div>
                </div>
               
            <?}?>
        </div>
     </div>
    <div class="solutions-icon-nav-left"></div>
    <div class="solutions-icon-nav-right"></div>
</div>  */?>
<div class="row ready-solutions-list owl-carousel" data-slider-id="1" >
    <?
    $i = 1;
    $cntItem = count($arResult["ITEMS"]);
    foreach($arResult["ITEMS"] as $arItem){?>
        <?
		
	
        if(!$arItem['DETAIL_PICTURE'])
            continue;
        
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="slide-item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="img-wrap col-md-8">
                <img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>">

                <div class="solutions-nav-left<?echo $i==1 ? ' disabled' : ''?>"></div>
                <div class="solutions-nav-right<?echo $i==$cntItem ? ' disabled' : ''?>"></div>
                <?if($arParams['BUTTON_POSITION'] == 'LEFT'){?>
                    <?if($arItem['PROPERTIES']['URL']['VALUE']){?>
                        <a class="learn-more btn btn-green" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                            Узнать подробнее
                        </a>
                    <?}?>
                    <div class="btn-order btn btn-yellow modal-window-link" data-form_id="2" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                        Сделать заказ
                    </div>
                <?}?>

            </div>
            <div class="description-wrap col-md-4">
                <div class="preview-text">
                    <?=$arItem['PREVIEW_TEXT'] ?>
                </div>
                <?if($arParams['BUTTON_POSITION'] != 'LEFT'){?>
                    <?if($arItem['PROPERTIES']['URL']['VALUE']){?>
                        <a class="learn-more btn btn-green" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                            Узнать подробнее
                        </a>
                    <?}?>
                    <div class="btn-order btn btn-yellow" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                        Сделать заказ
                    </div>
                <?}?>
            </div>
        </div>
    <?
        $i++;
    }?>
</div>