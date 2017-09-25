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

    <div class="section-list row" 111>
        
		<?if(isset($_REQUEST["adm"])){
			echo"<pre>";
			print_r($arResult);
			echo"</pre>";
		}
		?>
		
        <?/*<div class="section-description-s">
            <?=$arResult["DESCRIPTION"]?>
        </div>*/?>
        <?
        $areaIds = array();
        foreach ($arResult['ITEMS'] as $key => $arItem)
        {

            // $uniqueId = $arItem['ID'].'_'.md5($this->randString().$component->getAction());
            // $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
            // $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
            // $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
        
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
            
            <div class="section-list-item col-md-6 col-xs-6" id="<?=$areaIds[$arItem['ID']]//=$this->GetEditAreaId($arItem['ID']); //echo $strMainID; ?>">
                
                <?if (!$arItem['PREVIEW_PICTURE']){?>
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $imgTitle; ?>"  alt="<? echo $imgTitle; ?>">
                        <div class="section-img no-photo">
                        </div>
                    </a>
                <?}else{?>
                    <div class="section-img">
                          <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="item-img"  title="<? echo $productTitle ?>">
                            <img class="img-responsive" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>">
                        </a>
                    </div>
                <?}?>
                <div class="section-name">
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                        <? echo $arItem['NAME']; ?>
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
<?}?>   
 
<div class="section-description-s">
    <?=$arResult["DESCRIPTION"]?>
</div>
  
<script> 

    var maxHeight = 0;
    $('.catalog-item-title a').each(function(){
        if($(this).height() > maxHeight)
            maxHeight = $(this).height();
    });
    $('.catalog-item-title').css("min-height", maxHeight);
  
</script> 
