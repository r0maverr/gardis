<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h3><?=GetMessage("TITLE");?></h3>
<div class="gallery_in_sidebar">
	<?foreach($arResult["SECTIONS"] as $arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));?>
			<div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="album_in_sidebar ">
			  <?if($APPLICATION->GetCurPage() == $arSection["SECTION_PAGE_URL"]) { ?>
				<div class="product_item_in_sidebar_img_container" style="width: 220px;">
					<a class="act_in_gallery" href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<img src="<?=$arSection["ICON"]["SRC"]?>" style="float: left;">

                                                <?if ($arSection["SECTION_PAGE_URL"] == '/gallery/108/'|| $arSection["SECTION_PAGE_URL"] == '/gallery/111/'|| $arSection["SECTION_PAGE_URL"] == '/gallery/98/') { ?>
                                                  <span style="margin-top: 8px;">
                                                <?} else { ?>
						  <span>
						<? } ?>
						 	  <?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?>
						</span>

					</a>
				</div>
			  <?} else { ?>
				<div class="product_item_in_sidebar_img_container" style="width: 220px;">
					<a class="gallery" href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<img src="<?=$arSection["ICON"]["SRC"]?>" style="float: left;">

                                                <?if ($arSection["SECTION_PAGE_URL"] == '/gallery/108/'|| $arSection["SECTION_PAGE_URL"] == '/gallery/111/'|| $arSection["SECTION_PAGE_URL"] == '/gallery/98/') { ?>
                                                  <span style="margin-top: 8px;">
                                                <?} else { ?>
						  <span>
						<? } ?>
						 	  <?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?>
					        </span>

					</a>
				</div>
			  <? } ?>	
			</div>
			<div class="clear"></div>	
	<?endforeach?>
</div>
