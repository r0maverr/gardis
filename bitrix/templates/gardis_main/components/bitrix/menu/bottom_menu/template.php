<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

//p($arResult, 'arResult');
?>
<div class="bottom-menu">
    <ul>        
        <?
        foreach($arResult as $arItem){?>

            <li class="item-menu">
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </li>
        <?}?>
    </ul>
</div>