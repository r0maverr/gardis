<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> <?CAjax::Init();?> <?if ($arResult['SECTION_FIND']['GALLERY']):?> 
<h2 style="padding-bottom: 20px; border-bottom: 1px dotted black;">Галерея</h2>
 
<div style="margin-bottom: 20px;"> 
  <div style="float: left; margin-right: 20px;"> <a href="<?=$arResult['SECTION_FIND']['GALLERY']['URL']?>" target="_blank" > <img style="border: 1px solid #B7B7B7;" src="<?=$arResult['SECTION_FIND']['GALLERY']['PICTURE']['src']?>" height="<?=$arResult['SECTION_FIND']['GALLERY']['PICTURE']['height']?>" width="<?=$arResult['SECTION_FIND']['GALLERY']['PICTURE']['width']?>"  /> </a> </div>
 
<!-- style="float: left;"-->
 
  <div><?=$arResult['SECTION_FIND']['GALLERY']['TEXT']?></div>
 
  <div style="clear: both;"></div>
 </div>
 <?endif;?> 
<h2 style="padding-bottom: 20px; border-bottom: 1px dotted black;"><?if(strlen($arResult['SECTION']['PATH'][0]['NAME'])>0):echo $arResult['SECTION']['PATH'][0]['NAME']; else:?>Продукция<?endif;?></h2>
 <?/*<h1><?if(strlen($arResult['SECTION']['PATH'][0]['NAME'])>0):echo $arResult['SECTION']['PATH'][0]['NAME']; else:?>Продукция<?endif;?>*/?&gt; <?if (getenv('REQUEST_URI')=='/products/'): ?> 
<p>Универсальные ограждения. Широко применяются на различных объектах: от спортивных площадок до территорий производственных предприятий, для участков городской инфраструктуры, строительных площадок. </p>

<br />
 <?endif;?> 
<div border="0" src="/bitrix/images/fileman/htmledit2/php.gif" bxid_965304"="" pid="&lt;img id=" id="product_list">&quot;&gt; <?$i = 0; $j = 0;?> <?foreach($arResult["ITEMS"] as $arItem):?> 	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?> <?if($arItem["DISPLAY_PROPERTIES"]["OPTIONAL_EQUIPMENT"]["VALUE"] && $j == 0):?> 		 
  <div class="clear"></div>
 
  <h2>Входные группы</h2>
 		 
  <div style="border-top: 1px dotted black; margin-bottom: 30px;" class="line"></div>
 	 <?$j++; $i = 1;?> 	<?endif;?> 	 
  <div border="0" src="/bitrix/images/fileman/htmledit2/php.gif" bxid_424780"="" class="product_card &lt;img id=">&quot; id=&quot;<?=$this->GetEditAreaId($arItem['ID']);?>&quot; &gt; 		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?> 			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?> 				 
    <div class="product_card_img_container"> 					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" > 						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"  /> 					</a> 				</div>
   			<?else:?> 				 
    <div class="product_card_img_container"> 					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"  /> 				</div>
   			<?endif;?> 		<?endif?> 		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?> 			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?> 				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" ><?echo $arItem["NAME"]; ?></a> 			<?else:?> 				<a href="#" ><?echo $arItem["NAME"]?></a> 			<?endif;?> 		<?endif;?> 		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?> 			 
    <p><?echo $arItem["PREVIEW_TEXT"];?></p>
   		<?endif;?> 	</div>
 	<?if(fmod($i,2)==0):?> 		 
  <div class="clear"></div>
 	<?endif;?> <?endforeach;?> </div>
