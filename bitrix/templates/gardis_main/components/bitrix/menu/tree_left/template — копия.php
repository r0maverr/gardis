<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="nav navbar-nav">
    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):
    ?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>

        <?if ($arItem["IS_PARENT"]):?>
            <li class="dropdown dropdown-submenu" <?if($arItem["CHILD_SELECTED"] !== true):?> class="menu-close"<?endif?>>
                <a href="<?=$arItem["LINK"]?>" data-submenu="" class="<?if ($arItem["SELECTED"]):?> active<?else:?> root-item<?endif?>">
                    <?=$arItem["TEXT"]?>
                </a>
                <span class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-play" aria-hidden="true"></i>
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
<?endif?>