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
.got-icons {
	background:rgb(44,66,113);
	padding-top:20px;
	padding-bottom:20px;
}
.icon-link img{
	position:relative;
	display:block;
	margin:0 auto;
}
.icon-link {
	position:relative;
	display:block;
	padding:10px;
}
.icon-name {
	position:relative;
	display:block;
	font-size:12px;
	line-height:17px;
	color:white;
	padding:0 10px;
	text-align:center;
	text-overflow:ellipsis;
	overflow: hidden;
}

.got-icon {
	position:relative;
	width:11.11111111111111111111%;
	float:left;
	height:150px;
	margin-bottom:30px;
	text-overflow:ellipsis;
}
@media screen and (max-width:767px) {
	.got-icon {
		position:relative;
		width:16.666666666666666667%;
		float:left;
		height:90px;
	}
	.icon-name {
		display:none;
	}
}
@media screen and (max-width:479px) {
	.got-icon {
		position:relative;
		width:25%;
		float:left;
		height:90px;
	}
	.icon-name {
		display:none;
	}
}
</style>
<div class="col-xs-12 got-icons">

<?foreach($arResult["ITEMS"] as $arItem){?>
	<div class="got-icon">
		<a class="icon-link" href=""><img class="img-responsive" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
		<a class="icon-name" href=""><?=$arItem["NAME"]?></a>
	</div>
<?}?>

</div>
