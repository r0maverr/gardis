<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):
$sSectionName = "";
$sPath = $_SERVER["DOCUMENT_ROOT"].$APPLICATION->GetCurDir().".section.php";
include($sPath);
if(empty($sSectionName))
{
   foreach($arResult as $arItem){
       if($arItem['SELECTED'] == 1){
        $sSectionName = $arItem['TEXT'];
        break;
       }
   }
}
?>
<div class="left-menu clearfix">
    <div class="navbar navbar-default navbar-catalog" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed btn btn-navbar" data-toggle="collapse" data-target="#left_menu" <?/*aria-expanded="false"*/?>>
            <span class="sr-only">Открыть навигацию</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            
            <span class="navbar-brand menu-header"><?=$sSectionName?></span>
			    <?/*if ($isCatalog) {?><span class="navbar-brand menu-header">Каталог</span><?}*/?>
				<?/*if ($isAbout) {?><span class="navbar-brand menu-header">О компании</span><?}*/?>
				<!--<h3 class="leftmenu-header"><?$APPLICATION->ShowTitle(false);?></h3>-->
                                </div>
                                <div class="collapse navbar-collapse leftmenu-menu" id="left_menu">
    <ul class="nav navbar-nav">
    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):
    ?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>

        <?if ($arItem["IS_PARENT"]):?>
            <li class="dropdown dropdown-submenu<?if($arItem["CHILD_SELECTED"] === true || $arItem["SELECTED"]):?> open<?endif?>">
                <span class="link-block">
                    <span class="dropdown-toggle" <?/*data-toggle="dropdown"*/?>data-open="<?if ($arItem["SELECTED"]){?>Y<?}?>">
                        <i class="arrow-menu"<?/*class="fa fa-play" aria-hidden="true"*/?>></i>
                    </span>
                    <a href="<?=$arItem["LINK"]?>" data-submenu="" class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </span>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	

        <?else:?>

            <?if ($arItem["PERMISSION"] > "D"):?>
                    <li>
                        <a class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
            <?endif?>

        <?endif?>

        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

    <?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

</ul>
</div>
</div>
</div>
<?endif?>