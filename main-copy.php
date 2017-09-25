<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Завод забоных ограждений «Гардис» занимается изготовлением  металлических заборов и ограждений. Полностью автоматизированное производство ограждений в Новосибирске. Собственные склады готовой продукции.");
$APPLICATION->SetPageProperty("title", "Металлические заборы и ограждения | Производство в Новосибирске | Завод заборных ограждений Гардис");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Металлические заборы и ограждения | Производство Новосибирский завод заборных ограждений «Гардис»");

?> 


<div class="slider-wrap">
    <div class="slider-main owl-carousel">
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
    <div class="form-calc-main">  
        <div class="container">
            <div class="row">
            <?$APPLICATION->IncludeFile(SITE_DIR.'include/form-calc.php',array(),array('MODE' => 'html'));?>
            </div>
        </div>
    </div>
</div>

<div class="midle-main-menu">               
    <?$APPLICATION->IncludeComponent("bitrix:menu", "main-menu", array(
        "ROOT_MENU_TYPE" => "main",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
        ),
        false
    );?>
</div>

<div class="product-main"> 
    <div class="container">
        <div class="section-head clearfix">
            <div class="title-section logo-blue">
                Продукция
            </div>
            <div class="link-section">
                <a href="/products/">Перейти в каталог</a>
            </div>
        </div>
        <div class="row pdoduct-list">
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="pdoduct-item">
                    <div class="pdoduct-img">
                        <a href=""><img src="/images/ogr3d.jpg"></a>
                    </div>
                    <div class="pdoduct-name">
                        <a href="">Ограждение 3D</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img">
                            <a href=""><img src="/images/ogr2d.jpg"></a>
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Ограждение 2D</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img">
                            <a href=""><img src="/images/kalitki-rasp.jpg"></a>
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Калитки распашные</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img">
                            <a href=""><img src="/images/vorota-rasp.jpg"></a>
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Ворота распашные</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img no-photo">

                        </div>
                        <div class="pdoduct-name">
                            <a href="">Ворота откатные</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img no-photo">
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Автоматика</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img no-photo">
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Спиральный барьер безопасности</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
                    <div class="pdoduct-item">
                        <div class="pdoduct-img">
                            <a href=""><img src="/images/kreplenie.jpg"></a>
                        </div>
                        <div class="pdoduct-name">
                            <a href="">Аксессуары</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="">
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
    <?$APPLICATION->IncludeComponent("bitrix:menu", "main-menu", array(
        "ROOT_MENU_TYPE" => "main",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
        ),
        false
    );?>
</div>
<div class="ready-solutions"> 
    <div class="container">
        <div class="section-head clearfix">
            <div class="title-section logo-white">
                Готовые решения
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "ready-solutions", 
            array(
                "COMPONENT_TEMPLATE" => "ready-solutions",
                "IBLOCK_TYPE" => "data",
                "IBLOCK_ID" => READY_SOLUTION_IBLOCK_ID,
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
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
</div> 


<div class="advantage"> 
    <div class="container">
        <div class="section-head clearfix">
            <div class="title-section logo-blue">
                Преимущества работы с нами
            </div>
            <div class="link-section">
                <a href="/about/">Подробнее о компании</a>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "advantage", 
            array(
                "COMPONENT_TEMPLATE" => "advantage",
                "IBLOCK_TYPE" => "data",
                "IBLOCK_ID" => ADVANTAGE_IBLOCK_ID,
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "DETAIL_PICTURE",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
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
            <div class="title-section logo-blue">
                Отзывы о работе нашей компании
            </div>
            <div class="link-section">
                <a href="">Посмотреть все отзывы</a>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "review-main", 
            array(
                "COMPONENT_TEMPLATE" => "review-main",
                "IBLOCK_TYPE" => "data",
                "IBLOCK_ID" => REVIEWS_IBLOCK_ID,
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "POSITION",
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
</div>

<div class="news-main"> 
    <div class="container">
        <div class="section-head clearfix">
            <div class="title-section logo-blue">
                Новости
            </div>
            <div class="link-section">
                <a href="">Посмотреть все новости</a>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news-main", 
	array(
		"COMPONENT_TEMPLATE" => "news-main",
		"IBLOCK_TYPE" => "information",
		"IBLOCK_ID" => "15",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
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
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "88",
		"ACTIVE_DATE_FORMAT" => "j F Y",
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
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
</div>


 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>