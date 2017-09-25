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
<script>
var slider;
$(document).ready(function(){
	if ( $('#got-items').length ) {
slider = $('#got-items').bxSlider({
		mode: 'fade',
		adaptiveHeight: true,
		captions: false,
		pager: true,
		autoHover: true,
		nextSelector: '#got-next',
		prevSelector: '#got-prev',
		nextText: '',
		prevText: '',
		onSliderLoad: function () {
		    /*$('.bx-controls-direction').hide();*/
			$('.bx-wrapper').hover(
			function () { $('.bx-controls-direction').fadeIn(300); },
			function () { $('.bx-controls-direction').fadeOut(300); }
			);
		},
		});
	}

});
</script>

<h2 class="got-h2 got-<?=$arResult['ID']?>" style="background:url(<?=$arResult['PICTURE']["SRC"]?>) no-repeat 12px 0;"><?=$arResult['NAME']?></h2>
<?//print_r($arResult);?>
<?
$linked = array();
if (!empty($arResult['ITEMS']))
{
?>
<div class="got-items">
<div class="got__controlArrow">
  <span id="got-prev" class="got__prev"></span><span id="got-next" class="got__next"></span>
</div>
	<div id="got-items">

	<?foreach ($arResult['ITEMS'] as $keyItem => $arItem){?>
	<div class="got-item">
		<!--img class="img-responsive" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" / -->
		<div class="img-content" style="background-image:url(<?=$arItem["DETAIL_PICTURE"]["SRC"]?>)"></div>
        <div class="got-item-content col-xs-12">
			<h3 class="col-xs-12"><?=$arItem["NAME"]?></h3>
			<div class="got-desc col-xs-12 col-sm-4">
			<?=$arItem["DETAIL_TEXT"]?>
			</div>
			<div class="got-props col-xs-12 col-sm-4">
				<?foreach ($arItem['PROPERTIES'] as $propkey => $itemProp){//print_r($itemProp);?>
					<?if ($itemProp["PROPERTY_TYPE"] == "S"){?>
					<p class="got-prop"><span><?=$itemProp["NAME"]?></span><span><?=$itemProp["VALUE"]?></span></p>
					<?}
                }?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<a href="/products/" class="got-button" title="<?=$ar_res["NAME"]?>">Посмотреть панель в каталоге</a>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		<div class="got-others col-xs-12">
			<p class="col-xs-12 f19">При строительстве ограждения использовалась продукция:</p>
			<?
			foreach($arItem['PROPERTIES']['GOODS']['GOOD_NAME'] as $keyGood => $good){
			/*
			$prop1 = CIBlockElement::GetProperty(17, $ar_res["ID"], array("sort" => "asc"), Array("CODE"=>"TOLSHINA_PRUTKA"));
			if($prop1 = $prop1->Fetch()){
				$props[] = $prop1;
			}
			$prop2 = CIBlockElement::GetProperty(17, $ar_res["ID"], array("sort" => "asc"), Array("CODE"=>"RAZMER_YACHEIKI"));
			if($prop2 = $prop2->Fetch()){
				$props[] = $prop2;
			}
            */
			?>
			<div class="got-other col-xs-12 col-md-3">
			<?//print_r($ar_res);?>
				<a href="<?=$arItem['PROPERTIES']['GOODS']['URL'][$keyGood]?>" title="<?=$good?>"><img class="img-responsive" src="<?=$arItem['PROPERTIES']['GOODS']['IMG'][$keyGood]?>" alt="<?=$good?>" /></a>
				<h4><a href="<?=$arItem['PROPERTIES']['GOODS']['URL'][$keyGood]?>"><?=$good?></a></h4>
				<?if (count($props) > 0) {?>
				<div class="got-other-props">
					<?foreach ($props as $itemProp){
						//print_r($itemProp);?>
						<?if (strlen($itemProp["VALUE"]) > 0){?>
						<p class="got-other-prop"><span><?=$itemProp["NAME"]?></span><span><?=$itemProp["VALUE"]?> мм</span></p>
						<?}?>
					<?}?>
				</div>
				<?}?>
			</div>
			<?}?>
			<div class="clear">&nbsp;</div>
		</div>
	</div>
	<?}?>
	</div>
</div>
<?}?>
