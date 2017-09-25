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

<?/*foreach($arResult["ITEMS"] as $arItem){?>
	<?
// p($arItem['PROPERTIES']['VIDEO']);
// p(CFile::GetPath($arItem['PROPERTIES']['VIDEO']['VALUE']));
    if(!$arItem['DETAIL_PICTURE'] && !$arItem['PROPERTIES']['VIDEO']['VALUE'])
        continue;
    
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="slide-item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if($arItem['DETAIL_PICTURE']){?>
            <div class="img-wrapp">
                <img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>">
            </div>
        <?}
        elseif($arItem['PROPERTIES']['VIDEO']['VALUE']){?>
            <div class="img-wrapp">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:player", 
                    ".default", 
                    array(
                        "PLAYER_TYPE" => "auto",
                        "USE_PLAYLIST" => "N",
                        "PATH" => CFile::GetPath($arItem['PROPERTIES']['VIDEO']['VALUE']),//"http://localhost:6448/upload/iblock/44b/gardis_009_s.mp4",
                        "WIDTH" => "400",
                        "HEIGHT" => "300",
                        "FULLSCREEN" => "Y",
                        "SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
                        "SKIN" => "bitrix.swf",
                        "CONTROLBAR" => "bottom",
                        "WMODE" => "transparent",
                        "HIDE_MENU" => "N",
                        "SHOW_CONTROLS" => "N",
                        "SHOW_STOP" => "N",
                        "SHOW_DIGITS" => "Y",
                        "CONTROLS_BGCOLOR" => "FFFFFF",
                        "CONTROLS_COLOR" => "000000",
                        "CONTROLS_OVER_COLOR" => "000000",
                        "SCREEN_COLOR" => "000000",
                        "AUTOSTART" => "Y",
                        "REPEAT" => "always",
                        "VOLUME" => "90",
                        "DISPLAY_CLICK" => "play",
                        "MUTE" => "N",
                        "HIGH_QUALITY" => "Y",
                        "ADVANCED_MODE_SETTINGS" => "N",
                        "BUFFER_LENGTH" => "10",
                        "DOWNLOAD_LINK_TARGET" => "_self",
                        "COMPONENT_TEMPLATE" => ".default",
                        "SIZE_TYPE" => "fluid",
                        "START_TIME" => "0",
                        "PLAYBACK_RATE" => "1",
                        "PRELOAD" => "N",
                        "PLAYER_ID" => ""
                    ),
                    false
                );?>
                <?$APPLICATION->IncludeComponent(
	"bitrix:player", 
	".default", 
	array(
		"PLAYER_TYPE" => "auto",
		"USE_PLAYLIST" => "N",
		"PATH" => "/upload/iblock/df1/gardis_009_s.mp4",
		"WIDTH" => "400",
		"HEIGHT" => "300",
		"FULLSCREEN" => "Y",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
		"SKIN" => "bitrix.swf",
		"CONTROLBAR" => "bottom",
		"WMODE" => "transparent",
		"HIDE_MENU" => "N",
		"SHOW_CONTROLS" => "N",
		"SHOW_STOP" => "N",
		"SHOW_DIGITS" => "Y",
		"CONTROLS_BGCOLOR" => "FFFFFF",
		"CONTROLS_COLOR" => "000000",
		"CONTROLS_OVER_COLOR" => "000000",
		"SCREEN_COLOR" => "000000",
		"AUTOSTART" => "Y",
		"REPEAT" => "always",
		"VOLUME" => "90",
		"DISPLAY_CLICK" => "play",
		"MUTE" => "N",
		"HIGH_QUALITY" => "Y",
		"ADVANCED_MODE_SETTINGS" => "N",
		"BUFFER_LENGTH" => "10",
		"DOWNLOAD_LINK_TARGET" => "_self",
		"COMPONENT_TEMPLATE" => ".default",
		"SIZE_TYPE" => "fluid",
		"START_TIME" => "0",
		"PLAYBACK_RATE" => "1",
		"PRELOAD" => "N",
		"PLAYER_ID" => ""
	),
	false
);?>
            </div>
        <?}?>
        <div class="description-wrapp">
			<div class="name-wrapp">
                <?if($arItem['PROPERTIES']['URL']['VALUE']){?>
                    <a class="view_more btn_blue_min btn" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">
                        <?=$arItem['PREVIEW_TEXT'] ?>
                    </a>
                <?}else{?>
                    <?=$arItem['PREVIEW_TEXT'] ?>
                <?}?>
			</div>
		</div>
	</div>
<?}*/?>