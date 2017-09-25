<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2 class="h1main">Ограждения и заборы</h2>
<div class="block_header grey">
	<span class="has_arrow"><?=GetMessage('CUSTOMERS_TITLE');?></span>
	<div class="deep_grey_block_header">
		<a href="/about/customers/"><?=GetMessage('CUSTOMERS_ALL');?></a>
	</div>
</div>
<div class="partners_slider clearfix">
	<span class="buttons prev" id="btnPrev" onmousedown="return false" onselectstart="return false">Назад</span>
	<div class="viewport" id="slider_part">
		<ul class="overview">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<a class="img" href="<?=$arItem["DETAIL_PAGE_URL"]?>" style="background-image:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>'); width:<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>px; height: <?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>px;"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" /></a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
	<span class="buttons next" id="btnNext" onmousedown="return false" onselectstart="return false"><?=GetMessage('CUSTOMERS_FUTHER');?></span>
</div>