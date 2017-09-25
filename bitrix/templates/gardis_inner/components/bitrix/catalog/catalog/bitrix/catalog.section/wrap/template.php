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

//p($arResult);
?>
<?
if (!empty($arResult['ITEMS']))
{
    
	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
    $elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
    $elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
    ?>

    <div class="list-elements">
        
        <?/*<div class="section-description-s">
            <?=$arResult["DESCRIPTION"]?>
        </div>*/?>
        <?
        $areaIds = array();
        foreach ($arResult['ITEMS'] as $key => $arItem)
        {

            $uniqueId = $arItem['ID'].'_'.md5($this->randString().$component->getAction());
            $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);

            // $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            // $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
        
            $productTitle = (
                isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
                ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
                : $arItem['NAME']
            );
            $imgTitle = (
                isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
                ? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
                : $arItem['NAME']
            );

            ?>
            
            <div class="list-elements-item row" id="<?=$areaIds[$arItem['ID']]//=$this->GetEditAreaId($arItem['ID']); //echo $strMainID; ?>">
                        
                <div class="col-md-3 col-sm-3">
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="list-item-img"  title="<? echo $productTitle ?>">
                        <img class="img-responsive" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" title="<? echo $imgTitle; ?>" alt="<? echo $imgTitle; ?>">
                    </a>
                </div> 
                
                <div class="col-md-6 col-sm-6">
                    <div class="catalog-item-title">
                        <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                            <? echo $arItem['NAME']; ?>
                        </a>
                    </div> 
                    <?if($arItem['PREVIEW_TEXT']){?>
                        <div class="item-preview-text">
                            <? echo $arItem['PREVIEW_TEXT']; ?>
                        </div> 
                    <?}?> 
                </div>  
                <div class="col-md-3 col-sm-3 item-list-right"> 
                    <?/*if($arItem['PROPERTIES']['AVAILABLE']['VALUE'] == 1){?>
                        <div class="item-available">
                            В наличии    
                        </div>
                    <?}else{?>
                        <div class="item-no-available">
                            Нет в наличии    
                        </div>
                    <?}*/?> 
                    <?if($arItem['PROPERTIES']['PRICE']['VALUE']  > 0){?>
                        <div class="price">
                            <?=formatPrice($arItem['PROPERTIES']['PRICE']['VALUE'])?>
                        </div> 
                    <?}?>    
                    <a class="item-link btn btn_blue" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                        О товаре
                    </a>
                </div>  
            </div>
            
            
        <?
        }?>
    </div>
	<?
    if ($arParams["DISPLAY_BOTTOM_PAGER"])
    {
        ?><? echo $arResult["NAV_STRING"]; ?><?
    }
    ?>
    <div class="section-b-button lrg-font mrg40-0">
        <span id="scroll_top_section" class="section-top">Вверх</span>
        <span class="back-section"><a href="<?=$arResult['SECTION_BACK']?>">Назад</a></span>
    </div>   
    
<?}?>