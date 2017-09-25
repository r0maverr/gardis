<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Крупным компаниям");
?>
	 	<div class="row block block_bigSlider">
	 		<div class="col-xs-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"krupnim-slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "65",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
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
			1 => "",
		),
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
		"COMPONENT_TEMPLATE" => "krupnim-slider"
	),
	false
);?>
	 		</div>
	 	</div>
 		<div class="row block block_text">
	 		<div class="col-xs-12">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	 		</div>
	 	</div> 
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"gotovye-icons",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "gotovye-icons",
		"COUNT_ELEMENTS" => "N",
		"HIDE_SECTION_NAME" => "N",
		"IBLOCK_ID" => "59",
		"IBLOCK_TYPE" => "information",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"UF_ICON",1=>"UF_ICON_A",2=>"",),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	)
);?>
<div class="clear">&nbsp;</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"gotovye-items",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "59",
		"IBLOCK_TYPE" => "information",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(0=>"HEIGHT",1=>"OTHER",2=>"LINK",3=>"TYPE",4=>"COLOR",5=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
	 	<div class="row block block_brandsSlider">
	 		<div class="col-xs-12">
				<div class="block__title">
					С нами работают
				</div>
	 			<ul id="brandsSlider" class="brandsSlider">
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/7tsvetov.jpg);">
	 						<!--img src="/img/brands/7tsvetov.jpg" alt="" class="brandsSlider__img" -->
	 					</div>
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/b6fd1f54d965a9a650168cfba3ab79ca.png);">
	 						<!--img src="/img/brands/b6fd1f54d965a9a650168cfba3ab79ca.png" alt="" class="brandsSlider__img"-->
	 					</div>
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/7tsvetov.jpg);">
	 						<!--img src="/img/brands/bella.jpg" alt="" class="brandsSlider__img"-->
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/diskus.png);">
	 						<!--img src="/img/brands/diskus.png" alt="" class="brandsSlider__img"-->
	 					</div>
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/escimos4.jpg);">
	 						<!--img src="/img/brands/escimos4.jpg" alt="" class="brandsSlider__img"-->
	 					</div>
	 					<div class="brandsSlider__imgContainer" style="background-image:url(/img/brands/faeton.jpg);">
	 						<!--img src="/img/brands/faeton.jpg" alt="" class="brandsSlider__img"-->
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/gazprom.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/gerts-inzhiniring.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/goskorporatsiya-po-orvd.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/ipc-machines.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/irkutskaya-neftyanaya-kompaniya.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/kryar2.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/lerua-merlen.png" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/logotip-1.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/m-vid.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/marsel_logo.png" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/maz.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/mobilnye-gtes.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/mvd-rossii.png" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/noringa5.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/rosneft.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/sibakademstroy.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/sibmotor.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/sintez1.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/stroymaster.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/tdsk.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/tolmachevo.ru.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 				<li class="brandsSlider__item">
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/transneft.png" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/vimm8.jpg" alt="" class="brandsSlider__img">
	 					</div>
	 					<div class="brandsSlider__imgContainer">
	 						<img src="/img/brands/zelenyy_dom.png" alt="" class="brandsSlider__img">
	 					</div>
	 				</li>
	 			</ul>
	 			<div class="brandsSlider__bottom">
	 				<a href="/about/reviews/" class="button">Смотреть отзывы</a>
	 				<a href="#" class="button">Пригласить в тендер</a>
	 			</div>
	 		</div>
	 	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>