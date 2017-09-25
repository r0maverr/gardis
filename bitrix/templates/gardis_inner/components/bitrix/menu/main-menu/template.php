<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (!empty($arResult)){ 
?>
<div class="item-menu-left-wrap"></div>
<div class="container">
    <div class="row">

        <?
        foreach($arResult as $arItem){?>

            <div class="item-menu col-md-3 col-sm-3 col-xs-6">
                <a class="" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
        <?}?>

    </div> 
</div>  
<div class="item-menu-right-wrap"></div>
<?}?>