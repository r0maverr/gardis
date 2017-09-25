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
<div class="news-list row">

<?
//p($arResult["ITEMS"]);
// $i=1;
// $countNews = count($arResult["ITEMS"]);
$obParser = new CTextParser;
foreach($arResult["ITEMS"] as $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	/*if($i % 4 == 1)
    {?>
    <div class="row"><?}?>
        <?
        if($i % 2 == 1){?>
        <div class="col-md-6 new-preview-col<?if($i==4) echo ' pull-right';?>" >
        <?}*/?>
        <div class="col-md-6 col-sm-6">
            <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="col-md-4 col-sm-4 fl_news">
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <a class="prev_img_news" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                                    class="img-responsive"
                                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                    alt="<?=$arItem["NAME"]?>"
                                    title="<?=$arItem["NAME"]?>"
                                    /></a>
                        <?else:?>
                            <img
                                class="img-responsive"
                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                alt="<?=$arItem["NAME"]?>"
                                title="<?=$arItem["NAME"]?>"
                                />
                        <?endif;?>
                </div>
                
                <div class="col-md-8 col-sm-8">

                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <div class="news-name title">
                                <a class="underline" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                            </div>	
                        <?else:?>
                            <b><?echo $arItem["NAME"]?></b>
                        <?endif;?>
                    <?endif;?>
                    
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <div class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
                    <?endif?>
                    
                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){
                        if($arParams["PREVIEW_TRUNCATE_LEN"] > 0)
                            $arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);?>
                        <div class="news-preview">
                            <?echo $arItem["PREVIEW_TEXT"];?>
                        </div>
                    <?}?>
            
                </div>
            </div>
            
        </div>
        <?/*if($i % 2 == 0  || $i >= $countNews){?>
            </div>
            <?}?>
            
        <?
        if($i % 4 == 0 || $i >= $countNews){?>
        </div><?
        }
    $i++; */       
            
}?>
</div>
