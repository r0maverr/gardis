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
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
?> 
<?//$this->addExternalJS($templateFolder."/lightslider.js");?>

<div class="row block block_mountSchemes">
	<div class="col-xs-12">
		<h2>
            Монтажные схемы
		</h2>
	</div>
	<div class="mountSchemes__list">
			<?foreach($arResult["ITEMS"] as $arItem){?>
        <?
        //if(!$arItem['PREVIEW_PICTURE'])
            //continue;

		$MEDIAFILE = $arItem["PROPERTIES"]["MEDIA_FILE"]["MODIFY"]['SRC'];

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
		<div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="mountSchemes__item">
				<a href="<?=$MEDIAFILE?>" rel="group1" class="mountSchemes__outerLink awModlinkImg"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="mountSchemes__imgContainer">
						<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
					</div>
					<div class="mountSchemes__contentContainer">
						<div class="mountSchemes__name"><?=$arItem['NAME']?></div>
					</div>
				</a>
			</div>
		</div>
		<?}?>

		<div class="col-xs-12">
			<div class="mountSchemes__item mountSchemes__item_btn">
				<a href="/upload/album-GARDIS.pdf" class="button" download>Скачать весь альбом</a>
			</div>
		</div>

	</div>	

</div>


