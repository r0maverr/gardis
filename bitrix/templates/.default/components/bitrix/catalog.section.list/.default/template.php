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
<script type="text/javascript" src="/js/bundle2.js"></script>
<link href="/css/awStyle2.css" type="text/css" rel="stylesheet" />
<?//print_r($arResult);?>
<div class="block_projectSlider">
	<div class="col-xs-12">
		<div class="projectSlider tab" style="">
			<div class="projectSlider__controllsInner">
				<div class="projectSlider__tabsContainer tab_indexChecker">
				<?//$s = 0;?>
				<?foreach($arResult["SECTIONS"] as $s=>$arSection) {
					//print_r( $arSection);
					//if ($arSection["DEPTH_LEVEL"] < 1) continue;
					if ( in_array($arSection["ID"], array(1493,1489,1490,1491)) ) {
					?>
					<?if ($arSection["ID"] == 1493){?>
						<button class="tab__toggle tab__toggle_active"><?=$arSection["NAME"]?></button>
					<?}else{?>
						<button class="tab__toggle"><?=$arSection["NAME"]?></button>
					<?}?>
					<?}
					$s++;
					?>
				<?}?>
				</div>
			</div>
			<div class="projectSlider__contentInner">
			<?foreach($arResult["SECTIONS"] as $s=>$arSection) {
				if ( !in_array($arSection["ID"], array(1493,1489,1490,1491)) ) continue;?>
				<div class="tab__content <?if ($arSection["ID"] == 1493){?>tab__content_active<?}?>">
					<ul class="projectSlider__slider">
<?
$arSelect = Array("ID", "NAME", "DETAIL_TEXT", "DETAIL_PAGE_URL", "PROPERTY_COLORS", "PROPERTY_SCOPE_APPLICATION", "PROPERTY_TOLSHINA_PRUTKA", "PROPERTY_RAZMER_YACHEIKI", "PROPERTY_ABOUT_PRO", "PROPERTY_BIG_SLIDE");
$arFilter = Array("IBLOCK_ID"=>IntVal(64), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID" => $arSection["ID"], "INCLUDE_SUBSECTIONS" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	//print_r($arFields);
	if ($arFields["PROPERTY_BIG_SLIDE_VALUE"] > 0) {
	$rsFile = CFile::GetByID($arFields["PROPERTY_BIG_SLIDE_VALUE"]);
	$arFile = $rsFile->Fetch();
	//print_r($arFile);
	$path = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	}
	else {
		$path='';
	}
?>
						<li class="projectSlider__sliderItem" style="overflow:hidden;">
						<div class="projectSlider__backgrounder" style="background-image: url('<?=$path?>') !important;">
						</div>
						<div class="projectSlider__contentContainer">
							<div class="projectSlider__name"><?=$arFields["NAME"]?></div>
							<?if (false && strlen($arFields["PROPERTY_ABOUT_PRO_VALUE"]["TEXT"]) > 0) {?>
							<span class="ps-about"><p><?=$arFields["PROPERTY_ABOUT_PRO_VALUE"]["TEXT"]?></p></span>
							<?}?>
							<?if (false && strlen($arFields["DETAIL_TEXT"]) > 0) {?>
							<span class="ps-details"><p><?=$arFields["DETAIL_TEXT"]?></p></span>
							<?}?>
							<?if (count($arFields["PROPERTY_SCOPE_APPLICATION_VALUE"]) > 0) {
							//print_r($arFields["PROPERTY_SCOPE_APPLICATION_VALUE"]);
								?>
							<div class="scope_application">
 <span class="text_scope_application">Сфера применения:</span>
 <?foreach ( $arFields["PROPERTY_SCOPE_APPLICATION_VALUE"] as $scope) {?>
 <?//echo $scope;
$r1 = CIBlockSection::GetByID($scope);
if($ar_res = $r1->GetNext()) {
	//print_r($ar_res);
	if ($ar_res["PICTURE"] > 0) {
	$rsFile1 = CFile::GetByID($ar_res["PICTURE"]);
	$arFile1 = $rsFile1->Fetch();
	//print_r($arFile);
	$path1 = '/upload/'.$arFile1["SUBDIR"].'/'.$arFile1["FILE_NAME"];
	}
	?>
 <span class="icon_scope_application"> <img src="<?=$path1?>"> </span> 
<?}

?>
  <?}?>

							</div>
							<?}?>
                            <div class="data">
							<?if (strlen($arFields["PROPERTY_TOLSHINA_PRUTKA_VALUE"]) > 0) {?>
								<div class="data__item">
									<div class="data__name">Толщина прутка</div>
									<div class="data__value"><?=$arFields["PROPERTY_TOLSHINA_PRUTKA_VALUE"]?></div>
								</div>
							<?}?>
							<?if (strlen($arFields["PROPERTY_RAZMER_YACHEIKI_VALUE"]) > 0) {?>
								<div class="data__item">
									<div class="data__name">Размер ячейки</div>
									<div class="data__value"><?=$arFields["PROPERTY_RAZMER_YACHEIKI_VALUE"]?></div>
								</div>
							<?}?>
							</div>
							<?if (false && count($arFields["PROPERTY_COLORS_VALUE"]) > 0) {?>
							<div class="colors">
								<div class="text-colors">Цвет</div>
							<?foreach ( $arFields["PROPERTY_COLORS_VALUE"] as $color) {
$r2 = CIBlockElement::GetByID($color);
if($ar_res2 = $r2->GetNext()) {
  //echo $ar_res2['NAME'];
  //print_r($ar_res2);
	if ($ar_res2["PREVIEW_PICTURE"] > 0) {
	$rsFile2 = CFile::GetByID($ar_res2["PREVIEW_PICTURE"]);
	$arFile2 = $rsFile2->Fetch();
	//print_r($arFile);
	$path2 = '/upload/'.$arFile2["SUBDIR"].'/'.$arFile2["FILE_NAME"];
	}
								?>
								<div class="color-wrap">
 <span class="icon-color"> <img src="<?=$path2?>"> </span> <span class="name-color"><?=$ar_res2["NAME"]?></span> <span class="name-color-anons"><?=$ar_res2["PREVIEW_TEXT"]?></span>
								</div>
<?}?>
							<?}?>
							</div>
							<?}?>
 <a href="/calculator/<?/*=$arFields["DETAIL_PAGE_URL"]*/?>" class="button">Рассчитать стоимость</a>
						</div>
                        
 </li>
 <?}?>
	
					</ul>
				</div>
			<?}?>
			</div>
		</div>
	</div>
</div>