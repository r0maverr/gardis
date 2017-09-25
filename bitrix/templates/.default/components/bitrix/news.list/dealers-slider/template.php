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
<style>
.dealers-slides {
	position:relative;
}
.dealers-slides .bx-wrapper .bx-next {
	background: url(/img/dealers-slide-next.png) no-repeat 0 0 !important;
}
.dealers-slides .bx-wrapper .bx-prev {
	background: url(/img/dealers-slide-prev.png) no-repeat 0 0 !important;
}
.dealers-slides .bx-wrapper {
	
}
.inner-content .dealers-slide-desc {
	position:relative;
	display:block;
	font-size:19px;
	line-height:27px;
	padding-right:10px;
	margin-bottom:40px;
	position:relative;
	max-height:214px;
	overflow:hidden;
	text-overflow:ellipsis;
	text-align:justify;
}
.dealers-slide {
	min-height:320px;
	background:rgb(138,138,138);
	overflow:hidden;
	text-overflow:ellipsis;
}
.dealers-slide-content {
	position:absolute;
	top:80px;
	left:80px;
	color:white;
	padding-bottom:10px;
}

.dealers-slide-content p, .dealers-slide-content li {
	color:white;
	font-size:19px;
	line-height:27px;
	text-align:justify;
}
.dealers-slide-content h3 {
	color:white;
	font-size:43px;
	line-height:58px;
	text-transform:uppercase;
	padding:0 20px;
	border:1px solid white;
	display:inline-block;
	margin:0 0 40px 0;
}
@media (max-width:992px) {
	.dealers-slide-content {
		position:absolute;
		top:10px;
		left:10px;
	}
	.dealers-slide-content h3 {
		margin:0 0 20px 0;
	}
}

</style>
<?
if (!empty($arResult['ITEMS']))
{
?>
<script>
$(document).ready(function(){
	if ( $('#dealers-slides').length ) {
		$('#dealers-slides').bxSlider({
		mode: 'horizontal',
		captions: false,
		pager: false,
		<?if ( count($arResult["ITEMS"]) > 1) {?>
		controls: true,
		<?}else{?>
		controls: false,
		<?}?>
		infiniteLoop: false,
		onSliderLoad: function () {
			$('.bx-controls-direction').hide();
			$('.bx-wrapper').hover(
			function () { $('.bx-controls-direction').fadeIn(300); },
			function () { $('.bx-controls-direction').fadeOut(300); }
			);
		},
		});
	}
})
</script>
<div class="dealers-slides" >
	<div id="dealers-slides">
	<?foreach ($arResult['ITEMS'] as $key => $arItem){?>
	<div class="dealers-slide">
		<img class="img-responsive" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		<div class="dealers-slide-content col-xs-12 col-md-7">
			<?/*<h3><?=$arItem["NAME"]?></h3>*/?>
			<div class="dealers-slide-desc">
			<?=$arItem["DETAIL_TEXT"]?>
			</div>
			<a href="#dealers-form-container" class="fancybox2 yellow-button" title="Начните сотрудничать с нами">Начать сотрудничество</a>
		</div>
	</div>
	<?}?>
	<div class="clear">&nbsp;</div>
	</div>
</div>
<?}?>