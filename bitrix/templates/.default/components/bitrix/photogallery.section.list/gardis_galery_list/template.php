<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (empty($arResult["SECTIONS"])):?>
	<div class="photo-info-box photo-info-box-sections-list-empty">
		<div class="photo-info-box-inner"><?=GetMessage("P_EMPTY_DATA")?></div>
	</div>
	<?return false;
endif;?>
<?$cnt=0;
foreach($arResult["SECTIONS"] as $res):
	$cnt++;?>
	<div class="<?if($cnt%3==1):?>img_on_top<?endif;?> photo_gal">
		<div class="img_on_top_img_container">
			<a href="<?=$res["LINK"]?>"><img src="<?=$res['PICTURE']['SRC']?>" width="<?=$res['PICTURE']['WIDTH']?>" height="<?=$res['PICTURE']['HEIGHT']?>" /></a>
		</div>
		<a href="<?=$res["LINK"]?>"><?=$res["NAME"]?></a>
	</div>
	<?if($cnt%3==0):?><div class="clear"></div><?endif;?>
	<?/*if ($arParams["PERMISSION"] >= "W"):?>
	<div class="photo-album-menu" onmouseout="BX.removeClass(this.parentNode, 'photo-album-avatar-edit')" onclick="window.location='<?=CUtil::JSEscape(htmlspecialcharsbx($res["~LINK"]))?>';">
		<div class="photo-album-menu-substrate"></div>
			<div class="photo-album-menu-controls">
			<a rel="nofollow" href="<?=$res["EDIT_LINK"]?>" class="photo-control-edit photo-control-album-edit" title="<?=GetMessage("P_SECTION_EDIT_TITLE")?>"><span><?=GetMessage("P_SECTION_EDIT")?></span></a>
			<a rel="nofollow" href="<?= $res["DROP_LINK"]."&".bitrix_sessid_get()?>" class="photo-control-drop photo-control-album-drop" onclick="if (confirm('<?=GetMessage('P_SECTION_DELETE_ASK')?>')) {DropAlbum(this.href, parseInt('<?=$res["ID"]?>'));} return BX.PreventDefault(arguments[0]);" title="<?= GetMessage("P_SECTION_DELETE_TITLE")?>"><span><?=GetMessage("P_SECTION_DELETE")?></span></a>
		</div>
	</div>
	<?endif;*/?>
<?endforeach;?>
<div class="small_spacer"></div>
<?if(!empty($arResult["NAV_STRING"])):?><?=$arResult["NAV_STRING"]?><?endif;?>