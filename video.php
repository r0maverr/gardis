<?
require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
?>

<script>
$(document).ready(function(){
    /*var owl = $('.slider-test');
    owl.owlCarousel({
        loop:true,
        margin:10,
        video:true,
        //autoplay:true,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            }
        }
        ,afterAction: function(current) {
            current.find('video').get(0).play();
        }
    });
    //$('.owl-item.active video').attr('autoplay',true).attr('loop',true);*/
   

      var owl = $('.slider-test');
      owl.owlCarousel({
        loop:true,
        margin:10,
        video:true,
        dots:false,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            }
        }
      })
      owl.on('translate.owl.carousel',function(e){
        $('.owl-item video').each(function(){
          $(this).get(0).pause();
        });
      });
      owl.on('translated.owl.carousel',function(e){
        $('.owl-item.active video').get(0).play();
      })

    $('.owl-item .item-video').each(function(){
      var attr = $(this).attr('data-videosrc');
      if (typeof attr !== typeof undefined && attr !== false) {
        console.log('hit');
        var videosrc = $(this).attr('data-videosrc');
        $(this).prepend('<video muted><source src="'+videosrc+'" type="video/mp4"></video>');
      }
    });
    $('.owl-item.active video').attr('autoplay',true).attr('loop',true);
 

});
</script>
<div class="slider-test owl-carousel">
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"COMPONENT_TEMPLATE" => "slider",
		"IBLOCK_TYPE" => "data",
		"IBLOCK_ID" => BANNERS_IBLOCK_ID,
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "URL",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:player", 
	"main", 
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
		"COMPONENT_TEMPLATE" => "main",
		"SIZE_TYPE" => "fluid",
		"START_TIME" => "0",
		"PLAYBACK_RATE" => "1",
		"PRELOAD" => "N",
		"PLAYER_ID" => ""
	),
	false
);?>


                <?
require($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");
?>