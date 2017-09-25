<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (!empty($arResult)): 
//nav-justified
?>
<ul class="nav navbar-nav">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
        <li class="dropdown dropdown-submenu lvl<?=$arItem["DEPTH_LEVEL"]?><?/*if($arItem["CHILD_SELECTED"] === true || $arItem["SELECTED"]):?> open<?endif*/?>">
            <a href="<?=$arItem["LINK"]?>" data-submenu="" class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>">
                <?=$arItem["TEXT"]?>
            </a>
            <span class="dropdown-toggle" data-toggle="dropdown"<?/*data-open="<?if ($arItem["SELECTED"]){?>Y<?}?>"*/?>>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	

    <?else:?>

        <?if ($arItem["PERMISSION"] > "D"){
            $text = $arItem["TEXT"];    
        ?>
            <li>
                <a class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>" href="<?=$arItem["LINK"]?>"><?=$text?></a>
            </li>
        <?}?>

    <?endif?>
    
    
    <?/*if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="dropdown">
                <a href="<?=$arItem["LINK"]?>" class="dropdown-toggle" data-toggle="dropdown">
                    <?=$arItem["TEXT"]?>
                    <b class="caret"></b>
                </a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>>
                <a href="<?=$arItem["LINK"]?>" class="parent">
                    <?=$arItem["TEXT"]?>
                </a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>active<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif*/?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>