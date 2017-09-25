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
//$this->setFrameMode(true);
?>
<style>
.got-icons {
	background:rgb(44,66,113);
	padding-top:20px;
	padding-bottom:20px;
	margin-bottom:30px;
}
.icon-link img{
	position:relative;
	display:block;
	margin:0 auto;
	max-height:78px;
	overflow:hidden;
}
.icon-link {
	position:relative;
	display:block;
	padding:18px 10px 5px 10px;
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
.got-icon:hover .icon-name, .got-icon.active .icon-name {
	color:rgb(44,66,113);
}

.got-icon:hover, .got-icon.active {
	background-color:white;
}
@media screen and (min-width:979px) {
	.got-icon:hover, .got-icon.active  {
		background-color:transparent;
		background:url(/img/folder.png) no-repeat 0 0;
		background-size:cover;
	}
}
.got-icon .icon-link img.icon-a{
	display:none;
}
.got-icon:hover .icon-link img.icon, .got-icon.active .icon-link img.icon{
	display:none;
}
.got-icon:hover .icon-link img.icon-a, .got-icon.active .icon-link img.icon-a{
	display:block;
}
.got-icon {
	position:relative;
	width:10%;
	float:left;
	height:146px;
	margin-top:15px;
	margin-bottom:15px;
	text-overflow:ellipsis;
}
@media screen and (max-width:767px) {
	.got-icon {
		position:relative;
		width:16.666666666666666667%;
        padding:0;
		float:left;
		height:130px;
	}
}
@media screen and (max-width:479px) {
	.got-icon {
		position:relative;
		width:50%;
        padding:0;
		float:left;
		height:150px;
	}
}
</style>
<div class="col-xs-12 got-icons">

<?foreach($arResult["SECTIONS"] as $arItem){
	//print_r($arItem);
	$icon = $arItem["UF_ICON"];
	$icon = CFile::GetByID($icon);
	$icon = $icon->Fetch();
	$icona = $arItem["UF_ICON_A"];
	$icona = CFile::GetByID($icona);
	$icona = $icona->Fetch();
	//print_r($icon);
	?>
		<?

		$aSection = !empty($_REQUEST["SECTION_CODE"])?$_REQUEST["SECTION_CODE"]:'shkoly';
	//echo $aSection;
		if ($aSection == $arItem["CODE"] ){?>
	<div class="got-icon active">
		<?}else{?>
	<div class="got-icon">
		<?}?>
		<a class="icon-link" href="/gotovye-resheniya/<?=$arItem["CODE"]?>/">
			<img class="img-responsive icon" src="/upload/<?=$icon["SUBDIR"]?>/<?=$icon["FILE_NAME"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<img class="img-responsive icon-a" src="/upload/<?=$icona["SUBDIR"]?>/<?=$icona["FILE_NAME"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		</a>
		<a class="icon-name" href="?SECTION_ID=<?=$arItem["CODE"]?>"><?=$arItem["NAME"]?></a>
	</div>
<?}?>

</div>