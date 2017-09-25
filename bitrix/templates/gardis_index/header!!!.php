<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon"  href="/favicon.ico">
	<title>	
	
	<?$APPLICATION->ShowTitle();?>
	
	</title>
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sexy-combo.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sexy.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sliders.css");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.1.8.0.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.easing.1.3.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.flsgallery.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.sexy-combo.pack.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.tinycarousel.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/placeholder.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/placeholder_all.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mask.min.js");
	?>
	<!--[if IE 7]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie7.css" type="text/css" media="all"><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie8.css" type="text/css" media="all"><![endif]-->
	<!--[if IE 9]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie9.css" type="text/css" media="all"><![endif]-->

    
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-52596603-1']);
_gaq.push(['_addOrganic', 'images.yandex.ru', 'text', true]);
_gaq.push(['_addOrganic', 'go.mail.ru', 'q']);
_gaq.push(['_addOrganic', 'nova.rambler.ru', 'query']);
_gaq.push(['_addOrganic', 'nigma.ru', 's']);
_gaq.push(['_addOrganic', 'webalta.ru', 'q']);
_gaq.push(['_addOrganic', 'aport.ru', 'r']);
_gaq.push(['_addOrganic', 'poisk.ru', 'text']);
_gaq.push(['_addOrganic', 'km.ru', 'sq']);
_gaq.push(['_addOrganic', 'liveinternet.ru', 'q']);
_gaq.push(['_addOrganic', 'quintura.ru', 'request']);
_gaq.push(['_addOrganic', 'search.qip.ru', 'query']);
_gaq.push(['_addOrganic', 'gde.ru', 'keywords']);
_gaq.push(['_addOrganic', 'ru.yahoo.com', 'p']);
_gaq.push(['_trackPageview']);
setTimeout('_gaq.push([\'_trackEvent\', \'NoBounce\', \'Over 15 seconds\'])',15000);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

    </head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="main_area">
	<div id="main_container" >
		<div id="gird_container" >
			<div id="header">
				<div id="logo">
					<a href="/"><img src="<?=SITE_TEMPLATE_PATH;?>/img/gardies-logo.png"/></a>
				</div>
				<?$APPLICATION->IncludeComponent(
					"gardis:banners",
					"",
					Array(
						"IBLOCK_TYPE" => "information",
						"IBLOCKS" => array("18"),
						"PARENT_SECTION" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "180",
						"CACHE_NOTES" => "",
						"CACHE_GROUPS" => "Y"
					)
				);?>
				<div id="header_contacts"style="float: right;">
					<div id="telephone">
<?$APPLICATION->IncludeComponent("gardis:order_call", ".default", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "Ваше сообщение отправлено. Наш менеджер свяжется с вами.",
	"EMAIL_TO" => "",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "25",
	),
	"AJAX_MODE" => "Y"
	),
	false
);?>
						<span><?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => "/included_files/phone.php",
								"EDIT_TEMPLATE" => ""
							),
						false
						);?></span>
					</div>
					<div id="socials"><?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => "/included_files/social.php",
								"EDIT_TEMPLATE" => ""
							),
						false
						);?></div>
				</div>
			</div>
<?$APPLICATION->IncludeComponent("bitrix:menu", "gardis_main_menu", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
			
			<div id="left_sidebar">
<?$APPLICATION->IncludeComponent("bitrix:menu", "gardis_left_menu", Array(
	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	),
	false
);?>
<?$APPLICATION->IncludeComponent("bitrix:menu", "gardis_products_menu", array(
	"ROOT_MENU_TYPE" => "products",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N",
	"AJAX_MODE" => "N"
	),
	false
);?>
<?  if($APPLICATION->GetProperty('not_show_album_list')!='Y'  &&  $APPLICATION->GetCurPage() != '/gallery/'):?>
<?//if($APPLICATION->GetCurPage() != '/gallery/'):?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "gardis_gallery_left", Array(
	"IBLOCK_TYPE" => "information",	// Тип инфоблока
	"IBLOCK_ID" => "19",	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "",	// Код раздела
	"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "UF_ICON",
		1 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	),
	false
);?>
<?endif;?>
<?if($APPLICATION->GetProperty('not_show_product_list')!='Y'):?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "gardis_products_left", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "17",
	"NEWS_COUNT" => "3",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "DESC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"CATALOG_HREF" => "/products/",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?endif;?>
<? if($APPLICATION->GetProperty('not_show_news_list')!='Y' || $APPLICATION->GetCurPage() == '/gallery/'):?>
<?//if($APPLICATION->GetCurPage() == '/gallery/'):?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "gardis_news_main_mini", array(
	"IBLOCK_TYPE" => "information",
	"IBLOCK_ID" => "15",
	"NEWS_COUNT" => "3",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"HREF" => "/about/news/",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
?>
<?endif;?>
<div class="block-smart-responder-ru">
<!-- SmartResponder.ru subscribe form code (begin) -->
<link rel="stylesheet" href="https://imgs.smartresponder.ru/e1bbeb24091b44f1f4048bbc87edacd11278fd23/">
<script type="text/javascript" src="https://imgs.smartresponder.ru/52568378bec6f68117c48f2f786db466014ee5a0/"></script>
<script type="text/javascript">
    _sr(function() {
        _sr('form[name="SR_form_297991_64"]').find('div#sr-preload_').prop('id', 'sr-preload_297991_64');
        _sr('#sr-preload_297991_64').css({'width':parseInt(_sr('form[name="SR_form_297991_64"]').width() + 'px'), 'height':parseInt(_sr('form[name="SR_form_297991_64"]').height()) + 'px', 'line-height':parseInt(_sr('form[name="SR_form_297991_64"]').height()) + 'px'}).show();
        if(_sr('form[name="SR_form_297991_64"]').find('input[name="script_url_297991_64"]').length) {
            _sr.ajax({
                url: _sr('input[name="script_url_297991_64"]').val() + '/' + (typeof document.charset !== 'undefined' ? document.charset : document.characterSet),
                dataType: "script",
                success: function() {
                    _sr('#sr-preload_297991_64').hide();
                }
            });
        }
    });
</script>
<div id="outer_alignment" align="left">
    <form class="sr-box" method="post" action="https://smartresponder.ru/subscribe.html" target="_blank" name="SR_form_297991_64" style="width: 230px; border: 1px solid rgb(217, 217, 217); margin-left: ; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px;">
        <input type="text" name="field_name" class="sr-name">
        <div id="sr-preload_" style="display: none; background-color: #f6f6f6; opacity: 0.5; position: absolute; z-index: 100; text-align: center; font: bold 15px Arial;">Загрузка...</div>
        <ul class="sr-box-list"><li class="sr-297991_64" style="text-align: center; background-color: rgb(19, 90, 130); border: 0px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: auto; padding: 0px;"><input type="hidden" name="element_header" value="" style="font-family: Arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; font-weight: normal; background-color: rgb(255, 255, 255); border: none; box-shadow: none;"><table id="elem_table_element_header" border="0" cellspacing="0" cellpadding="0" style="display: inline-table; border-collapse: separate; width: 230px; margin: -1px 0px 0px -1px;"><tbody><tr><td id="elem_left_element_header" valign="middle" style="background-image: url(https://imgs.smartresponder.ru/on/9c6ddfe5efd23754cf31269923aa077ae5f17f97/); background-color: transparent; width: 33px; height: 65px; background-position: 50% 0%; background-repeat: no-repeat;"></td><td id="elem_container_element_header" style="vertical-align: middle;"><label class="" style="font-family: arial; color: rgb(19, 19, 19); font-size: 12px; font-weight: bold; background-image: url(https://imgs.smartresponder.ru/on/3a2d965f6aad95b10fd73aa4d60355c41099a5be/); background-color: transparent; width: 100%; text-align: center; box-sizing: border-box; height: auto; line-height: 25px; padding: 20px 0px; margin-top: 0px; background-position: 50% 0%; background-repeat: repeat repeat;">Подписка на рассылку</label></td><td id="elem_right_element_header" style="background-image: url(https://imgs.smartresponder.ru/on/6c180e8e16e219c9c15c7ae65d90030068b97d3f/); background-color: transparent; width: 33px; height: 65px; background-position: 50% 0%; background-repeat: no-repeat;"></td></tr></tbody></table></li><li class="sr-297991_64" style="text-align: center; background-color: rgb(19, 90, 130); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 45px;">
<label class="remove_labels" style="font-weight: normal; font-family: arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; display: none;"></label>
<input type="text" name="field_email" class="sr-required" style="font-family: arial; color: rgb(148, 148, 148); font-size: 11px; font-weight: bold; border: 1px solid rgb(217, 217, 217); background-color: rgb(255, 255, 255); background-image: url(https://imgs.smartresponder.ru/on/0783f068cfde922df5c22e1d66e9d58e1aed1f22/); height: 30px; box-shadow: none; margin-top: 0px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-position: 95% 50%; background-repeat: no-repeat;" value="Ваш E-mail">
            </li><li class="sr-297991_64" style="text-align: center; background-color: rgb(19, 90, 130); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 45px;"><label class="remove_labels" style="font-weight: normal; font-family: arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; display: none;"></label><input type="text" name="field_name_first" style="font-family: arial; color: rgb(148, 148, 148); font-size: 11px; font-weight: bold; border: 1px solid rgb(217, 217, 217); background-color: rgb(255, 255, 255); background-image: url(https://imgs.smartresponder.ru/on/ca4bfc13b0f1418fed2aee7476eb72c190fda244/); height: 30px; box-shadow: none; margin-top: 0px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-position: 95% 50%; background-repeat: no-repeat;" value="Ваше имя"></li><li class="sr-297991_64" style="text-align: center; background-color: rgb(19, 90, 130); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; height: 110px; border: 0px;"><table id="elem_table_subscribe" border="0" cellspacing="0" cellpadding="0" style="display: inline-table; border-collapse: separate; margin-top: 32px;"><tbody><tr><td id="elem_left_subscribe" valign="middle" style="background-image: url(https://imgs.smartresponder.ru/on/1a3214c377ac8380a4360b025912bec0447a0241/); background-color: transparent; width: 5px; height: 42px; background-position: 0% 50%; background-repeat: no-repeat;"></td><td id="elem_container_subscribe" style="vertical-align: middle;"><input type="submit" name="subscribe" value="Подписаться" style="font-family: arial; color: rgb(255, 255, 255); font-size: 15px; font-weight: bold; border: 0px solid rgb(99, 129, 18); box-shadow: none; background-image: url(https://imgs.smartresponder.ru/on/fe42bf4cc5c30464384dc4b590f7272829e3689d/); background-color: transparent; height: 42px; width: 100%; margin: 0px; padding: 0px 45px; background-position: 0% 50%; background-repeat: repeat repeat;"></td><td id="elem_right_subscribe" style="background-image: url(https://imgs.smartresponder.ru/on/944b6cfcd7afce6b4d95c6be2ae85c7349e84e20/); background-color: transparent; width: 5px; height: 42px; background-position: 0% 50%; background-repeat: no-repeat;"></td></tr></tbody></table></li></ul>
        <input type="hidden" name="uid" value="632848">
    <input type="hidden" name="did[]" value="760547"><input type="hidden" name="tid" value="0"><input type="hidden" name="lang" value="ru"><input name="script_url_297991_64" type="hidden" value="https://imgs.smartresponder.ru/on/0c4d3683566546252a6b5bdf26191bc2910c0cbb/297991_64"></form>
</div>
<!-- SmartResponder.ru subscribe form code (end) -->
</div>

</div>
			<div id="content_block" class="<?$APPLICATION->ShowProperty('add_class');?>">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "gardis_breadcrumb", Array(
	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
	"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
	),
	false
);?>
				<?if($APPLICATION->GetProperty('not_show_title')!='Y'):?><h2 style="padding-bottom: 20px; border-bottom: 1px dotted black;"><?$APPLICATION->ShowTitle();?></h2><?endif;?>