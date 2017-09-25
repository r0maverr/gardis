<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <?
		CJSCore::Init(array("jquery"));
		$this->addExternalCss($templateFolder."/swiper/swiper.min.css");
		$this->addExternalJS($templateFolder."/swiper/swiper.min.js");
	?> <!-- Swiper -->
	<?foreach($arResult['SECTIONS'] as $arSection){?>
<div class="swiper-title">
	<div class="swiper-title-logo">
 		<img src=" /images/slides/<?=$arSection['CODE']?>.png" height="40px">
	</div>
	<h2><?=$arSection['NAME']?></h2>
</div>
<div class="swiper-container">
	<div class="swiper-button-prev">
	</div>
	<div class="swiper-wrapper">
	<?$arElem = $arResult[$arSection['ID']]?>
	<?if(count($arElem)>0){
		foreach($arElem as $arItem){
		?>
		<div class="swiper-slide">
			<div class="swiper-slide-photo" style="background-image: url(<?=$arItem['ITEM']['PREVIEW_PICTURE']['SRC']?>);">
			</div>
			<div class="swiper-slide-content">
				<h2 lang="ru"><?=$arItem['ITEM']['NAME']?></h2>
				<p>
					<?=$arItem['ITEM']['PREVIEW_TEXT']?>
				</p>
				<?if(count($arItem['PROPERTIES']['AddInfo']['DESCRIPTION'])>0){?>
				<ul>
				<?
				$addDesc = $arItem['PROPERTIES']['AddInfo']['DESCRIPTION'];
				$addVal = $arItem['PROPERTIES']['AddInfo']['VALUE'];
				foreach($addDesc as $key => $arProp){?>
					<li>
						<span><?=$addVal[$key]?></span><b><?=$arProp?></b>
					</li>
					<?}?>
				</ul>
				<?}?>
 <a href="javascript:void(0)" class="onClickOrder btn btn-default">онявхрюире лме</a>
			</div>
		</div>
		<?}}?>
	</div>
	 <!-- Add Arrows -->
	<div class="swiper-button-next">
	</div>
	<div class="swiper-pagination">
	</div>
</div>
 
<?}?>