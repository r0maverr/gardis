<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block_header">
	<span class="has_arrow">Галерея объектов<?//=GetMessage("TITLE");?></span>
</div>
<div id="right_slider_zone">
	<?
	$cnt=0;
	foreach($arResult["SECTIONS"] as $arSection):
		$cnt++;
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));?>
		<div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="item_resolut">
			<div class="item_resolut_img">
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<img src="<?=$arSection['UF_IMAGE']['src'];?>" width="<?=$arSection['UF_IMAGE']['width'];?>" height="<?=$arSection['UF_IMAGE']['height'];?>" title="<?=$arSection["NAME"]?>" alt="<?=$arSection["NAME"]?>" />
					</a>
			</div>	
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?if(strlen($arSection['UF_TITLE'])>0):?><?=$arSection['UF_TITLE'];?><?else:?><?=$arSection['NAME'];?><?endif;?></a>
		</div>
		<?if($cnt%2==0):?><div class="between_item_resolut"></div><?endif;?>
	<?endforeach?>
</div>