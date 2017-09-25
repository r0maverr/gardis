<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Завод забоных ограждений «Гардис» занимается изготовлением  металлических заборов и ограждений. Полностью автоматизированное производство ограждений в Новосибирске. Собственные склады готовой продукции.");
$APPLICATION->SetPageProperty("title", "Металлические заборы и ограждения | Производство в Новосибирске | Завод заборных ограждений Гардис");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Металлические заборы и ограждения | Производство Новосибирский завод заборных ограждений «Гардис»");

?><div class="slider-wrap " id="main-slider">
	<div class="slider-main owl-carousel">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"DETAIL_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => BANNERS_IBLOCK_ID,
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"URL",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
	<div class="form-calc-main">
		<div class="container">
			<div class="row">
				 <?$APPLICATION->IncludeFile(SITE_DIR.'include/form-calc.php',array(),array('MODE' => 'html'));?>
			</div>
		</div>
	</div>
</div>
<div class="midle-main-menu">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"main-menu",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "main",
		"USE_EXT" => "N"
	)
);?>
</div>
<div class="product-main">
	<div class="container">
		<div class="section-head clearfix">
 <a class="hv-decor" href="http://new1.gardies.ru/products/" style="color:black">
			<div class="title-section logo-blue">
				 <span>Продукция</span>
			</div>
 </a>
			<div class="link-section">
 <a href="/products/">Перейти в каталог</a>
			</div>
		</div>
		<div class="row pdoduct-list">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="pdoduct-item">
					<div class="pdoduct-img">
 <a href="/products/"><img src="/images/ogr3d.jpg"></a>
					</div>
					<div class="pdoduct-name">
 <a href="/products/">Ограждение 3D</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/"><img src="/images/ogr2d.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/">Ограждение 2D</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/stolby/"><img src="/images/stolby.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/stolby/">Столбы</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/kalitki/"><img src="/images/kalitki_raspash.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/kalitki/">Калитки распашные</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/vorota-raspashnye/"><img src="/images/vorota_raspash.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/vorota-raspashnye/">Ворота распашные</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/vorota-otkatnye/"><img src="/images/vorota_otkat.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/vorota-otkatnye/">Ворота откатные</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/krepezhi/"><img src="/images/krepeg.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/krepezhi/">Крепежи</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/aksessuary/"><img src="/images/acessuary.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/aksessuary/">Аксессуары</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div>
					<div class="pdoduct-item">
						<div class="pdoduct-img">
 <a href="/products/spiralnyy-barer-bezopasnosti/"><img src="/images/spiral_barer.jpg"></a>
						</div>
						<div class="pdoduct-name">
 <a href="/products/spiralnyy-barer-bezopasnosti/">Спиральный барьер безопасности</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pdoduct-list slider owl-carousel">
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/ogr3d.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Ограждение 3D</a>
				</div>
			</div>
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/ogr2d.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Ограждение 2D</a>
				</div>
			</div>
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/kalitki-rasp.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Калитки распашные</a>
				</div>
			</div>
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/vorota-rasp.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Ворота распашные</a>
				</div>
			</div>
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/kreplenie.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Аксессуары</a>
				</div>
			</div>
			<div class="pdoduct-item">
				<div class="pdoduct-img">
 <a href=""><img src="/images/stolb60-60green.jpg"></a>
				</div>
				<div class="pdoduct-name">
 <a href="">Винтовые сваи</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="midle-main-menu xs">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"main-menu",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "main",
		"USE_EXT" => "N"
	)
);?>
</div>
<div class="ready-solutions">
	<div class="container">
		<div class="section-head clearfix">
 <a href="http://new1.gardies.ru/gotovye-resheniya/" style="color:white">
			<div class="title-section logo-white">
				 <span>Готовые решения</span>
			</div>
 </a>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"ready-solutions", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "ready-solutions",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "55",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "URL",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
	</div>
</div>
<div class="advantage">
	<div class="container">
		<div class="section-head clearfix">
			 <!--a href="http://new1.gardies.ru/main.php" style="color:black"-->
			<div class="title-section logo-blue none-hover">
				 Преимущества работы с нами
			</div>
			 <!--/a-->
			<div class="link-section">
 <a href="/about/">Подробнее о компании</a>
			</div>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"advantage",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantage",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"DETAIL_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => ADVANTAGE_IBLOCK_ID,
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
</div>
<div class="container">
	<hr class="main-advantage-review">
	<div class="seo-text-main">
		 Сео текст на главной странице
	</div>
</div>
<div class="reviews-main">
	<div class="container">
		<div class="section-head clearfix">
 <a href="http://new1.gardies.ru/about/reviews/" style="color:black">
			<div class="title-section logo-blue">
				 <span>Отзывы о работе нашей компании</span>
			</div>
 </a>
			<div class="link-section">
 <a href="">Посмотреть все отзывы</a>
			</div>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"review-main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "review-main",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => REVIEWS_IBLOCK_ID,
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"POSITION",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
</div>
<div class="news-main">
	<div class="container">
		<div class="section-head clearfix">
 <a href="http://new1.gardies.ru/about/news/" style="color:black">
			<div class="title-section logo-blue">
				 <span>Новости</span>
			</div>
 </a>
			<div class="link-section">
 <a href="">Посмотреть все новости</a>
			</div>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news-main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news-main",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"DETAIL_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "15",
		"IBLOCK_TYPE" => "information",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "88",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form", 
	"make_order", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"NOT_SHOW_FILTER" => array(
			0 => "",
			1 => "",
		),
		"NOT_SHOW_TABLE" => array(
			0 => "",
			1 => "",
		),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "Y",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "10",
		"COMPONENT_TEMPLATE" => "make_order",
		"VARIABLE_ALIASES" => array(
			"action" => "action",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>