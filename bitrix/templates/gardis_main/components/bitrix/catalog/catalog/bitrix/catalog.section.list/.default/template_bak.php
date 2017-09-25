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

//p($arResult,'arResult');
$res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
if($arRes = $res->GetNext()){
//p($arRes, 'arRes');
    $iblockName = $arRes['NAME'];
    $descripton = $arRes['DESCRIPTION'];
} 
if($arResult['SECTION']['DEPTH_LEVEL'] == 0){
    if($descripton){?>
        <div class="section-description-s">
            <?=$descripton?>
        </div>
    <?}
}else{
    
    if($arResult['SECTION']['~UF_PREVIEW_TEXT'] && false){?>
        <div class="section-description-s">
            <?=$arResult['SECTION']['~UF_PREVIEW_TEXT']?>
        </div>
    <?}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
//p($arResult['SECTION']['DEPTH_LEVEL']);
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<div class="catalog-section lvl<?=$arResult['SECTION']['DEPTH_LEVEL']?>"><?
    /*echo (
        isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
        ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
        : $arResult['SECTION']['NAME']
    );*/
    ?>

    <div class="section-list row" 222>
    
    <?if (0 < $arResult["SECTIONS_COUNT"])
    {
        // $i=1;
        // $cntSection = $arResult["SECTIONS_COUNT"];  
        foreach ($arResult['SECTIONS'] as $arSection)
        {
 // p($arSection['PICTURE'], 'PICTURE');
 // p($arSection['IPROPERTY_VALUES'], 'IPROPERTY_VALUES');
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
             
            $itemTitle = (
                isset($arSection['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'])&& $arSection['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] != ''
                ? $arSection['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']
                : $arSection['NAME']
            );
             
            /*if($i % $cntLine == 1){?>
            <div class="row">
            <?}*/?>

                <div class="section-list-item col-md-6 col-xs-6" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                    <?if (!$arSection['PICTURE']){?>
                        <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" title="<? echo $itemTitle ?>">
                            <div class="section-img no-photo">
                            </div>
                        </a>
                    <?}else{?>
                        <div class="section-img">
                            <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" title="<? echo $itemTitle ?>">
                                <img class="img-responsive" src="<? echo $arSection['PICTURE']['SRC']; ?>"  title="<? echo $arSection['PICTURE']['TITLE']; ?>"  title="<? echo $arSection['PICTURE']['ALT']; ?>">
                            </a>
                        </div>
                    <?}?>
                    <div class="section-name">
                        <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"  title="<? echo $itemTitle ?>">
                            <? echo $arSection['NAME']; ?>
                        </a>
                    </div>  
                </div>    
                <?
                
            /*if($i % $cntLine == 0 || $i >= $cntSection){?>
            </div>
            <?}*/
            
            //$i++;
        }    
	}?>
    </div>
    <?/*if($arResult['SECTION']['~DESCRIPTION']){?>
        <div class="section-description hidden container" id="sect_dop_wrap">
            <?=$arResult['SECTION']['~DESCRIPTION']?>
        </div>
    <?}*/?> 

</div>

<?}?>