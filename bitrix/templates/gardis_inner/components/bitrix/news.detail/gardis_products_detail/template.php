<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*Deleted
	//Другой файл чертежей для откатных ворот костыль by Spawn
	$chertPath = "/upload/catalog-pdf/mont.schem.pdf";
	if($arResult['ID'] == "15872")
		$chertPath = "/upload/catalog-pdf/montazhnye_skhemy_otkatnykh_vorot.pdf";
*/?>
<h1><?=$arResult['PROPERTIES']['TITLE_ELEMENT']['VALUE']['TEXT'];?></h1>
<div class="grid36">
	<?/*<a href="img/temp/catalogue_item_03.jpg" title="это тайт картинки" class="fancybox"><img src="img/temp/catalogue_item_03.jpg" class="grey_border"/></a>*/?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="grey_border" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
</div>

<div class="grid23 margin_left_40">
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>   
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>         
	<?if(strlen($arResult['GALLERY'])>0):?>
		<a href="<?=$arResult['GALLERY']?>" class="gallery_link"><?=GetMessage("GALLERY");?></a>
	<?endif;?>
<?/*Old ver
if(strlen($arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE'])>0):?>
	<table><tr>
        <td style="vertical-align:middle;"> <a class="dn_pdf" onclick="yaCounter24428276.reachGoal('Opisanie'); return true;" href="<?//=$arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE']?>/upload/catalog-pdf/kratkoe_opisanie.pdf" target="_blank" ></a> </td>
        <td style="vertical-align:middle;"> &nbsp; <a onclick="yaCounter24428276.reachGoal('Opisanie'); return true;" href="<?//=$arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE']?>/upload/catalog-pdf/kratkoe_opisanie.pdf" target="_blank" > Описание в PDF</a> 
</td></tr></table>
 <table><tr>
       <td style="vertical-align:middle;"> <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" class="dn1_pdf" href="<?=$chertPath?>" target="_blank" ></a> </td>
        <td style="vertical-align:middle;"> &nbsp; <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" href="<?=$chertPath?>" target="_blank" > Чертежи в PDF</a> 
</td></tr></table>
<!-- <a class="dn_pdf" href="<?//=$arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE']?>/upload/catalog-pdf/kratkoe_opisanie.pdf "target="_blank" > &nbsp;&nbsp; <?=GetMessage("DOWNLOAD");?></a>-->
<?endif;*/
//New ver:
//"Свои" файлы чертежей и инструкций. Если есть - вставляется из свойства PDF_FILES, иначе - старое как и было
	//echo "<!--";
	//print_r($arResult['PROPERTIES']['PDF_FILES']);
	//echo "-->";
	if(strlen($arResult['PROPERTIES']['PDF_FILES']['VALUE']['TEXT'])>0){
		if($arResult['PROPERTIES']['PDF_FILES']['VALUE']['TYPE']=='HTML')echo htmlspecialcharsBack($arResult['PROPERTIES']['PDF_FILES']['VALUE']['TEXT']); else echo $arResult['PROPERTIES']['PDF_FILES']['VALUE']['TEXT'];
	}elseif(strlen($arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE'])>0){?>
	<table><tr>
        	<td style="vertical-align:middle;"> <a class="dn_pdf" onclick="yaCounter24428276.reachGoal('Opisanie'); return true;" href="<?//=$arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE']?>/upload/catalog-pdf/kratkoe_opisanie.pdf "target="_blank" ></a> </td>
	        <td style="vertical-align:middle;"> &nbsp; <a onclick="yaCounter24428276.reachGoal('Opisanie'); return true;" href="<?//=$arResult['PROPERTIES']['AUTO_PDF_DESC']['VALUE']?>/upload/catalog-pdf/kratkoe_opisanie.pdf" target="_blank" > Описание в PDF</a></td>
	</tr></table>
	 <table><tr>
	       <td style="vertical-align:middle;"> <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" class="dn1_pdf" href="/upload/catalog-pdf/mont.schem.pdf" target="_blank" ></a></td>
	       <td style="vertical-align:middle;"> &nbsp; <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" href="/upload/catalog-pdf/mont.schem.pdf" target="_blank" > Чертежи в PDF </a></td>
	</tr></table>
	<?}?>

	<?/*Deleted
	<!-- <?if (count($arResult['PDF_FILES']) > 0):?>
    <div>
     <?foreach ($arResult['PDF_FILES'] as $arFile):?>
      <table><tr>
        <td style="vertical-align:middle;"> <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" class="dn1_pdf" href="<?=$chertPath?>" target="_blank" ></a> </td>
        <td style="vertical-align:middle;"> &nbsp; <a onclick="yaCounter24428276.reachGoal('Cherteji'); return true;" href="<?=$chertPath?>" target="_blank" > Чертежи в PDF  <?=$arFile['NAME']?></a> 
</td></tr></table>-->
</br>
  <!-- <a href="<?=$arFile['PATH']?>" class="dn1_pdf" target="_blank"><?=$arFile['NAME']?></a><br />-->
   <!--   <?endforeach;?>
    </div>
<?endif;?>-->*/?>
<br />
<a href="#ask_price" onclick="_gaq.push(['_trackEvent', 'all_pages', 'request_price',,, true]); yaCounter24428276.reachGoal('ORDER<?=(isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone']))?'_DIRECT':''?>'); return true;" class="fancybox grey_nice_button request_price_submit">Узнать стоимость</a> 

	
</div>
<div class="clear"></div>
<p style="text-align: justify; padding-bottom:30px;"><?=$arResult['PROPERTIES']['ABOUT_PRO']['VALUE']['TEXT'];?></p>
<div class="content_about">
	<span class="grey_span"><?=GetMessage("CONTENT");?></span>
	<div class="clear"></div>
	<?foreach($arResult['PROPERTIES']['DICTIONARY']['DESCRIPTION'] as $key=>$arItem){?>
		<a href="#punkt<?=$key?>"><?=$arItem;?></a><br/>
	<?}?>
</div>
<?if(count($arResult['PROPERTIES']['BIND']['CATALOG_LIST'])>0):?>
	<div class="see_also margin_left_10">
		<span class="grey_span"><?=GetMessage("ALSO");?></span>
		<div class="clear"></div>
		
		<div style="float:left; overflow: hidden; width: 48%; "> 
			<?
			$cnt=1;
			foreach($arResult['PROPERTIES']['BIND']['CATALOG_LIST'] as $val):
				$cnt++;?>

				<div class="product_item_in_see_also">
					<div class="product_item_in_sidebar_img_container">
						<a href="<?=$val['DETAIL_PAGE_URL']?>"><img src="<?=$val['PICTURE']["SRC"]?>" width="<?=$val['PICTURE']["WIDTH"]?>" height="<?=$val['PICTURE']["HEIGHT"]?>" title="<?=$val['NAME']?>" alt="<?=$val['NAME']?>" /></a>
					</div>
					<a href="<?=$val['DETAIL_PAGE_URL']?>"><?=$val['NAME']?></a>
				</div>
				<?if($cnt>count($arResult['PROPERTIES']['BIND']['CATALOG_LIST'])/2):?>
		</div>
					<div style="float:left; overflow: hidden; margin-left: 10px; width: 48%;"> 
				<?endif;?>

			<?endforeach;?>

		</div>
	</div>
<?endif;?>
<div class="clear"></div>

<?foreach($arResult['PROPERTIES']['DICTIONARY']['VALUE'] as $key=>$arItem){?>
	<h2 id="punkt<?=$key?>"><?=$arResult['PROPERTIES']['DICTIONARY']['DESCRIPTION'][$key];?></h2>
	<?if($arItem['TYPE']=='HTML')echo htmlspecialcharsBack($arItem['TEXT']); else echo $arItem['TEXT'];?>
	<div class="clear"></div>
	<a href="#" class="to_top"><?=GetMessage("UP");?></a>
<?}?>
<a href="#ask_price" onclick="_gaq.push(['_trackEvent', 'all_pages', 'request_price',,, true]); yaCounter24428276.reachGoal('ORDER<?=(isset($_GET['yclid']) || isset($_COOKIE['gardies-yclid-phone']))?'_DIRECT':''?>'); return true;" class="fancybox grey_nice_button request_price_submit btn_ask_price_bottom">Узнать стоимость</a>

<div class="small_spacer"></div>
<?/*if(strlen($arResult['PDF_FILE'])>0):?>
	<a href="<?=$arResult['PDF_FILE']?>" class="dn_pdf on_right"><?=GetMessage("DOWNLOAD");?></a>
<?endif;*/?>