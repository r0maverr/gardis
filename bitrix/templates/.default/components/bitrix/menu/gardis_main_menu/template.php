<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div id="head_menu">
		<ul>
			<?
			$previousLevel = 0;
			foreach($arResult as $arItem):?>
				<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
					<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
				<?endif?>
				<?if ($arItem["IS_PARENT"]):?>
					<li <?if ($arItem["SELECTED"]):?> class="act"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?else:?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?endif?>
						<ul <?if($arItem["LAST_UL"]):?>id="last_ul"<?endif;?>>
				<?else:?>
					<?if ($arItem["PERMISSION"] > "D"):?>
						<li <?if ($arItem["SELECTED"]):?>class="act"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?else:?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?endif?></li>
					<?else:?>
						<li><span><?=$arItem["TEXT"]?></span></li>
					<?endif?>
				<?endif?>
				<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
			<?endforeach?>

			<?if ($previousLevel > 1)://close last item tags?>
				<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
			<?endif?>
		</ul>
	</div>
<?endif?>