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
    /*
	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}*/

	$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
    $elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
    $elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
    ?>

    <div class="cart__wrap">

        <?
		
        $areaIds = array();
        foreach ($arResult['ITEMS'] as $key => $arItem)
        {
			/*
			echo"<pre>";
			print_r($arItem["PROPERTIES"]["SCOPE_APPLICATION"]);
			echo"</pre>";
			*/
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
            
            <div class="cart__item" id="<?=$areaIds[$arItem['ID']]//=$this->GetEditAreaId($arItem['ID']); //echo $strMainID; ?>">
		
		<div class="cart__name">
			<div class="cart__name-link" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
				<? echo $arItem['NAME']; ?>
			</div>
		</div> 
		<div class="cart__description">
		<?=$arItem["PROPERTIES"]["ABOUT_PRO"]["~VALUE"]["TEXT"]?>
		</div>
		 
		<div class="cart__media">		
			<?if (!$arItem['PREVIEW_PICTURE']){?>
				<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $imgTitle; ?>"  alt="<? echo $imgTitle; ?>">
					<div class="section-img no-photo">
					</div>
				</a>
			<?}else{?>
				<div class="cart__media-wrap">
					
						<img class="cart__media-image" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>">
				
				</div>
			<?}?>
			<div class="cart__price">
				<span class="cart__price-text">Стоимость:</span>				
				<div class="cart__price-value"><?if(!empty($arItem["PROPERTIES"]["PRICE"]["VALUE"])){echo$arItem["PROPERTIES"]["PRICE"]["VALUE"];}else{echo"Отсутствует";}?></div>				
				<div class="cart__order-btn product-btn-order-calc modal-window-link" data-mode="form" data-form_id="2">
					сделать заказ
				</div>
			</div>
		</div>	

		
		<div class="cart__info">		
			<?$SCOPE_APPLICATION = $arItem["PROPERTIES"]["SCOPE_APPLICATION"]["MODIFY"];
			if($SCOPE_APPLICATION!=false){
			?>
			<div class="cart__property property-row row-icons">
				<span class="property__name"><?=$arItem["PROPERTIES"]["SCOPE_APPLICATION"]["NAME"]?></span>
			
				<span class="property__val val-icons">				
				<?foreach($SCOPE_APPLICATION as $arImage){?>
					<img src="<?=$arImage["PICTURE"]["SRC"]?>" title="<?=$arImage["NAME"]?>" alt="" />
				<?}?>				
				</span>
				
			</div>
			<?}else{?>
			<div class="cart__property property-row row-text">
				<span class="property__name"><?=$arItem["PROPERTIES"]["SCOPE_APPLICATION"]["NAME"]?></span>		
				<span class="property__val val-text">Отсутствует</span>
			</div>
			<?}?>
			
			<div class="cart__property property-row row-text">
				<span class="property__name"><?=$arItem["PROPERTIES"]["TOLSHINA_PRUTKA"]["NAME"]?></span>		
				<span class="property__val val-text"><?=$arItem["PROPERTIES"]["TOLSHINA_PRUTKA"]["MODIFY"]?></span>
			</div>
			
			<?if(!empty($arItem["PROPERTIES"]["RAZMERI"]["VALUE"])){?>
			<div class="cart__property property-row row-text">
				<span class="property__name"><?=$arItem["PROPERTIES"]["RAZMER_YACHEIKI"]["NAME"]?></span>	
				<span class="property__val val-text"><?=$arItem["PROPERTIES"]["RAZMER_YACHEIKI"]["MODIFY"]?></span>
			</div>

			<?}?>
			<div class="cart__property property-table">		
				<button class="prop__btn onClickSize btn__name-size">Смотреть все размеры</button>		
				<div class="property__val-table val-table"><?=$arItem["PROPERTIES"]["RAZMERI"]["MODIFY"]?></div>
			</div>
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

                <?if(count($arResult["COMPARE"])  > 0){?>
                    <div class="compare table-responsive">
                        <table>
                            <tr>
                                <th></th>
                                <th>Особенности<br>конструктива</th>
                                <th>Толщина прутка<br>с покрытием</th>
                                <th>Размер ячейки</th>
                                <th>Цена кв.м.</th>
                                <th>Сфера<br>применения</th>
                            </tr>
                            <?
                            foreach($arResult["COMPARE"] as $idEl){
                                if($ob = CIblockElement::GetByID($idEl)->GetNextElement()){
                                    $arEl = $ob->GetFields();
                                    $arEl['PROPERTIES'] = $ob->GetProperties();
                                    $file = CFile::ResizeImageGet($arEl['PREVIEW_PICTURE'], array("width" => 162, "height" => 114));
									
									//echo"<pre>";
									//print_r($idEl);
									//print_r($arEl['PROPERTIES']);
									//echo"</pre>";
                                    ?>
                                    <tr class="compare-wrap">
                                        <td>
                                            <span class="name"><a href="<?=$arEl['DETAIL_PAGE_URL']?>"><?=$arEl['NAME']?></a></span>
                                            <span class="img"><a href="<?=$arEl['DETAIL_PAGE_URL']?>"><img src="<?=$file['src']?>"></a></span>
                                        </td> 
                                        <td class="osobennosti">
                                            <?=$arEl['PROPERTIES']['OSOBENNOSTI']['VALUE']?>
                                        </td>
                                        <td>
                                            <?if($arEl['PROPERTIES']['TOLSHINA_PRUTKA']['VALUE']){?> 
                                                <?=$arEl['PROPERTIES']['TOLSHINA_PRUTKA']['VALUE']?> мм
                                            <?}?>
                                        </td>
                                        <td>
                                            <?if($arEl['PROPERTIES']['RAZMER_YACHEIKI']['VALUE']){?> 
                                                <?=$arEl['PROPERTIES']['RAZMER_YACHEIKI']['VALUE']?> мм
                                            <?}?>
                                        </td>
                                        <td>
                                            <?if($arEl['PROPERTIES']['PRICE_KV_M']['VALUE']){?>
                                                <?=$arEl['PROPERTIES']['PRICE_KV_M']['VALUE']?> руб/кв.м
                                            <?}?>
                                        </td>
                                        <td>
                                            <?foreach($arEl['PROPERTIES']['SCOPE_APPLICATION']['VALUE'] as $idEl){
                                                if($arElScope = CIblockElement::GetByID($idEl)->fetch()){
                                                    $file = CFile::ResizeImageGet($arElScope['PREVIEW_PICTURE'], array("width" => 32, "height" => 32));
                                                    ?>
                                                    <span class="icon_scope_application">
                                                        <img src="<?=$file['src']?>">
                                                    </span> 
                                                <?
                                                }
                                            }?>
                                        </td>
                                    </tr>
                                <?
                                }
                            }?>
                        </table>                     
                    </div>                     
                <?}?>
            </div>
            <div class="accordio-toggle tab-toggle hidden-md hidden-lg" data-idx="2">Чертежи</div>
            <div class="tab">
                <div class="chertegi">
                    <a href="/upload/catalog-pdf/mont.schem.pdf" target="_blank" download>
                        <div class="btn btn-yellow link-download" >Скачать все чертежи</div>
                    </a>			
                    <?if($arResult['CHERTEG']){
						foreach($arResult['CHERTEG'] as $arItem){
                        $file = CFile::ResizeImageGet($arItem, array("width" => 794, "height" => 564));
                        $fileBig = CFile::GetPath($arItem);
			
                        ?>
                        <div class="img-cherteg">
                            <a class="fancybox" href="<?=$fileBig?>">
                                <img src="<?=$file['src']?>" alt="чертеж для <?=$arResult['NAME']?>">
                            </a>
                        </div>
                    <?}}?>
                </div>    
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
                        $file = CFile::ResizeImageGet($arEl['DETAIL_PICTURE'], array("width" => 266, "height" => 186), BX_RESIZE_IMAGE_EXACT);
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
	
	
<?}?>   

<script> 
/*
    var maxHeight = 0;
    $('.catalog-item-title a').each(function(){
        if($(this).height() > maxHeight)
            maxHeight = $(this).height();
    });
    $('.catalog-item-title').css("min-height", maxHeight);
  */
</script> 
