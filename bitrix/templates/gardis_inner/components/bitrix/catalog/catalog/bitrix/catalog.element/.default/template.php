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


//$strMainID = $this->GetEditAreaId($arResult['ID']);


$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>

<div class="item-detail" id="<?echo $strMainID ?>">
                     
    <div class="item-wrap">    
        <div class="row">    
            <div class="col-md-6">
                <div class="item-img">
                    <a class="fancybox" data-fancybox="item-photo" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
                        <img class="img-responsive" src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" title="<? echo $strTitle; ?>" alt="<? echo $strAlt; ?>">
                    </a>
                </div> 
                
                <?if(count($arResult["MORE_PHOTO"])>0){?>
                    <div class="more-photo clearfix">
                        <?foreach($arResult["MORE_PHOTO"] as $PHOTO){?>
                            <div class="image">
                                <a class="fancybox" data-fancybox="item-photo" href="<?=$PHOTO["SRC"]?>" title="<?=(strlen($PHOTO["DESCRIPTION"]) > 0 ? $PHOTO["DESCRIPTION"] : $arResult["NAME"])?>">
                                    <img src="<?=$PHOTO["SRC_PREVIEW"]?>" alt="<?=$arResult["NAME"]?>" title="<?=(strlen($PHOTO["DESCRIPTION"]) > 0 ? $PHOTO["DESCRIPTION"] : $arResult["NAME"])?>"/>
                                </a>
                            </div>
                        <?}?>
                    </div>    
                <?}?>
                
                <div class="description-wrap">

                    <div class="description">
                        <?=$arResult['PROPERTIES']['ABOUT_PRO']['VALUE']['TEXT']?>
                    </div>
                
                    <div class="price-wrap">
                        <span class="price-text">Стоимость:</span>
                        
                        <div class="price-value">
                            <?=$arResult['PROPERTIES']['PRICE']['VALUE']?>
                        </div>
                        
                        <div class="btn btn-yellow product-btn-order-calc modal-window-link" data-mode="form" data-form_id="2">
                            заявка на расчет ограждения
                        </div>
                    </div>
                </div>
                
                
            </div> 
            
            <div class="col-md-6">
                <div class="clearfix">
                    <?
                   //p($arResult['PROPERTIES']['SCOPE_APPLICATION']['VALUE']);
                    if(count($arResult['PROPERTIES']['SCOPE_APPLICATION']['VALUE'])  > 0){?>
                        <div class="scope_application">
                            <span class="text_scope_application">Сфера применения:</span> 
                            <?foreach($arResult['PROPERTIES']['SCOPE_APPLICATION']['VALUE'] as $idEl){
                                if($arEl = CIblockElement::GetByID($idEl)->fetch()){
                                    $file = CFile::ResizeImageGet($arEl['PREVIEW_PICTURE'], array("width" => 32, "height" => 32));
                                    ?>
                                    <span class="icon_scope_application">
                                        <img src="<?=$file['src']?>">
                                    </span> 
                                <?
                                }
                            }?>
                        </div>                     
                    <?}?>
                    <div class="props">
                        <div class="prop">
                            <?if($arResult['PROPERTIES']['TOLSHINA_PRUTKA']['VALUE']){?>
                                <span class="prop-name">
                                    <?=$arResult['PROPERTIES']['TOLSHINA_PRUTKA']['NAME']?>
                                </span> 
                                <span class="prop-value">
                                    <?=$arResult['PROPERTIES']['TOLSHINA_PRUTKA']['VALUE']?> мм
                                </span> 
                            <?}?> 
                        </div> 
                        <div class="prop">
                            <?if($arResult['PROPERTIES']['RAZMER_YACHEIKI']['VALUE']){?>
                                <span class="prop-name">
                                    <?=$arResult['PROPERTIES']['RAZMER_YACHEIKI']['NAME']?>
                                </span> 
                                <span class="prop-value">
                                    <?=$arResult['PROPERTIES']['RAZMER_YACHEIKI']['VALUE']?> мм
                                </span> 
                            <?}?> 
                        </div>

                        <?if($arResult['DETAIL_TEXT']){?>
                            <div class="item-detail-text">
                                <? echo $arResult['DETAIL_TEXT']; ?>
                            </div> 
                        <?}?>                    
                    </div> 

                    <?
                    $arDictonary = array();
                    foreach($arResult['PROPERTIES']['DICTIONARY']['DESCRIPTION'] as $key=>$value){
                        $arDictonary[$value] = $arResult['PROPERTIES']['DICTIONARY']['VALUE'][$key];
                    }
                    ?>
                    <div class="pokritie">
                        <?=htmlspecialcharsBack($arDictonary['Защитно-декоративное покрытие']['TEXT'])?>
                    </div>
                    
                    <div class="pokritie table-responsive">
                        <?=htmlspecialcharsBack($arDictonary['Стандартные размеры']['TEXT'])?>
                    </div>
                    
                    <?/*if($arResult['PREVIEW_TEXT']){?>
                        <div class="item-preview-text">
                            <? echo $arResult['PREVIEW_TEXT']; ?>
                        </div> 
                    <?}*/?>

                </div>
                
            </div>  
        </div>  
    </div>  
    
    <div class="tabs-accordion">
        <div class="tabs-toggles hidden-xs clearfix">
            <div class="toggle tab-toggle" data-idx="0"><span class="tab-toggle-text">Готовые решения</span></div>
            <div class="toggle tab-toggle" data-idx="1"><span class="tab-toggle-text">Сравнить</span></div>
            <div class="toggle tab-toggle" data-idx="2"><span class="tab-toggle-text">Чертежи</span></div>
        </div>
        <div class="tabs-enum">
            <div class="accordio-toggle tab-toggle hidden-md hidden-lg" data-idx="0">Готовые решения</div>
            <div class="tab">
                <div class="ready-solutions"> 
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list", 
                        "ready-solutions", 
                        array(
                            "COMPONENT_TEMPLATE" => "ready-solutions",
                            "IBLOCK_TYPE" => "data",
                            "IBLOCK_ID" => READY_SOLUTION_IBLOCK_ID,
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => array(
                                0 => "DETAIL_PICTURE",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "URL",
                                1 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "STRICT_SECTION_CHECK" => "N",
                            "BUTTON_POSITION" => "LEFT"
                        ),
                        false
                    );?>
                </div> 
            </div> 
        
            <div class="accordio-toggle tab-toggle hidden-md hidden-lg" data-idx="1">Сравнить</div>
            <div class="tab">
                Таблица сравнения
            </div>
            <div class="accordio-toggle tab-toggle hidden-md hidden-lg" data-idx="2">Чертежи</div>
            <div class="tab">
                Чертежи
            </div>
        </div> 
    </div> 
    
    <?if(count($arResult['PROPERTIES']['BIND']['VALUE'])){?>
        <div class="related-products">
            <div class="related-products-tilte">
                Сопутствующие товары
            </div>
            <div class="pdoduct-list pdoduct-list-slider owl-carousel">
                <?foreach($arResult['PROPERTIES']['BIND']['VALUE'] as $idEl){
                    if($arEl = CIblockElement::GetByID($idEl)->GetNext()){
                        $file = CFile::ResizeImageGet($arEl['DETAIL_PICTURE'], array("width" => 266, "height" => 186));
                        ?>
                        <div class="pdoduct-item">
                            <div class="pdoduct-img">
                                <a href="<?=$arEl['DETAIL_PAGE_URL']?>"><img src="<?=$file['src']?>"></a>
                            </div>
                            <div class="pdoduct-name">
                                <a href="<?=$arEl['DETAIL_PAGE_URL']?>"><?=$arEl['NAME']?></a>
                            </div>
                        </div> 
                    <?
                    }
                }?>
            </div>
        </div>
    <?}?>
    
</div>
