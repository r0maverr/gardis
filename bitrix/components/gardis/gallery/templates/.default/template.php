<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

  <? $class = ($arParams['GALLERY_STYLE'] == 2) ? 'rows-2' : 'rows-1' ; ?>

  <div class="slider_tiny <?=$class?>">
    <span class="buttons prev">left</span>
    <div class="viewport">
      <ul class="overview">
        <? $i = 1; ?>
        <? foreach ($arResult['ITEMS'] as $item) : ?>
          <? if (($arParams['GALLERY_STYLE'] == 1) || (($arParams['GALLERY_STYLE'] == 2) && ($i % 2 > 0))) : ?>
            <li><div class="tiny_slide_container">
          <? endif; ?>
                
              <div class="slide_img_container">
                <a class="fancybox" rel="group" href="<?=$item['DETAIL_PICTURE']['SRC']?>" title="<?=$item['NAME']?>">
                  <img src="<?=$item['PREVIEW']?>" width="<?=$arResult['PREVIEW_WIDTH']?>" height="<?=$arResult['PREVIEW_HEIGHT']?>" />
                </a>
              </div>

          <? if (($arParams['GALLERY_TYPE'] == 1) || (($arParams['GALLERY_TYPE'] == 2) && ($i % 2 == 0))) : ?>
            </div></li>
          <? endif; ?>
          <? $i++; ?>
        <? endforeach; ?>
      </ul>
    </div>
    <span class="buttons next" href="#">right</span>
  </div>
