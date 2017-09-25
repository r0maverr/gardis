<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon"  href="/favicon.ico">
	<title>	
	<?$APPLICATION->ShowTitle();?>
	</title>

	<?$APPLICATION->ShowHead();?>
	<?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css");
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/style2.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap.min.css');
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/jquery.bxslider.css");
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/fontawesome/font-awesome.min.css');
	// $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sexy-combo.css");
	// $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sexy.css");
	//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sliders.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css");
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/14-08-2017.css');
	//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.1.8.0.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-3.2.0.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.easing.1.3.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.fancybox.pack.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.flsgallery.js");
	//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.sexy-combo.pack.js");
	//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.tinycarousel.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/placeholder.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/placeholder_all.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");
	//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mask.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/owl.carousel2.thumbs.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/slick.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/bootstrap.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.bxslider.min.js');
	?>
	<!--[if IE 7]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie7.css" type="text/css" media="all"><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie8.css" type="text/css" media="all"><![endif]-->
	<!--[if IE 9]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/css/ie9.css" type="text/css" media="all"><![endif]-->    

	<?/*$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/google-tag-manager-1.php"
));*/?>

<?/*$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/facebook_pixel.php"
                    ));?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/vk_pixel.php"
                    ));?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/counter_comagic.php"
                    ));*/?>

    </head>
<body>

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?
$curPage = $APPLICATION->GetCurPage(false);
$curPageFull = $APPLICATION->GetCurPage(true);
$isCatalog = strpos($curPage,'/products/') !== false ? true : false;
$isAbout = strpos($curPage,'/about/') !== false ? true : false;
?>
<div class="header">
    <div class="top-menu navbar navbar-default navbar-custom" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed btn btn-navbar" data-toggle="collapse" data-target="#top_menu" <?/*aria-expanded="false"*/?>>
                    <span class="sr-only">Открыть навигацию</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo xs">
                    <a href="/"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/img/gardies-logo-new.png" alt="Гардис"></a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="top_menu">               
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"test_shablon", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "test_shablon"
	),
	false
);?>
            </div>
        </div>
    </div>
    
    <div class="head-block">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="logo">
						<a href="/"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/img/gardies-logo-new.png" alt="Гардис"></a>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="top-centr-block">
                        <div class="row">
                            <div class="top-centr-wr col-md-4 col-sm-4 col-xs-4">
                                <a href="/calculator/" class="clearfix">
                                    <div class="top-centr-img"><img src="<?=SITE_TEMPLATE_PATH?>/img/online-calc.png" class="img-circle" alt="Онлайн расчет"></div>
                                    <div class="top-centr-text">Онлайн<br> расчет</div>
                                </a>  
                            </div>
                            <div class="top-centr-wr col-md-4 col-sm-4 col-xs-4">
                                <a href="#tenders-form-container" class="clearfix fancybox2">
                                    <div class="top-centr-img"><img src="<?=SITE_TEMPLATE_PATH?>/img/tender.png" class="img-circle" alt="Пригласить в тендер"></div>
                                    <div class="top-centr-text">Пригласить<br> в тендер</div>
                                </a>   
                            </div>
                            <div class="top-centr-wr col-md-4 col-sm-4 col-xs-4">
                                <a href="#phone_take" class="clearfix fancybox">  
                                    <div class="top-centr-img"><img src="<?=SITE_TEMPLATE_PATH?>/img/call-phone.png" class="img-circle" alt="Заказать звонок"></div>
                                    <div class="top-centr-text">Заказать<br> звонок</div>
                                </a>
                            </div>
                        </div>
					</div>
				</div>
                <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="contacts-block">
						<div class="main-phone">
                            <?$APPLICATION->IncludeFile(SITE_DIR.'include/main-phone.php',array(),array('MODE' => 'html'));?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <?if($curPage != SITE_DIR && $curPageFull != '/main.php'){?>
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
        <div class="inner-content main-bg <?$APPLICATION->ShowProperty('add_class');?>">
            <div class="container">
                <div class="row"> 
                        <div class="col-xs-12 breadcrumb_wrap" id="breadcrumb_wrap">
                            <div class="breadcrumbs-b">
                                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "gardis", Array(
                                    "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                                        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                        "SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    <div class="col-sm-3 col-md-3 left-content">
                        <div class="left-menu clearfix">

                            <div class="navbar navbar-default navbar-catalog" role="navigation">
                            
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed btn btn-navbar" data-toggle="collapse" data-target="#left_menu" <?/*aria-expanded="false"*/?>>
                                        <span class="sr-only">Открыть навигацию</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
									<?if ($isCatalog) {?><span class="navbar-brand menu-header">Каталог</span><?}?>
									<?if ($isAbout) {?><span class="navbar-brand menu-header">О компании</span><?}?>
									<!--<h3 class="leftmenu-header"><?$APPLICATION->ShowTitle(false);?></h3>-->
                                </div>

                                <div class="collapse navbar-collapse leftmenu-menu" id="left_menu">

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu", 
                                        "tree_left", 
                                        array(
                                            "COMPONENT_TEMPLATE" => "tree_left",
                                            "ROOT_MENU_TYPE" => "left",
                                            "MENU_CACHE_TYPE" => "N",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "N",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "2",
                                            "CHILD_MENU_TYPE" => "product",
                                            "USE_EXT" => "N",
                                            "DELAY" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "MENU_THEME" => "site"
                                        ),
                                        false
                                    );?>
                                </div>
                            </div>
                        </div>
						<div class="subscribe-block">
 <?$APPLICATION->IncludeComponent("bitrix:subscribe.form", ".default", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"AJAX_MODE" => "Y",
		"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
		"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
		"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
	),
	false
);?>
						</div>
                    </div>
                    <div class="col-sm-9 col-md-9 right-content">
                        <h1><?=$APPLICATION->ShowTitle(false)//Showh1()?></h1>
				<?/*if($APPLICATION->GetProperty('not_show_title')!='Y'):?><h2 style="padding-bottom: 20px; border-bottom: 1px dotted black;"><?$APPLICATION->ShowTitle();?></h2><?endif;*/?>
   <?}?>
   
     <?$APPLICATION->IncludeComponent(
    "bitrix:form",
    "request-form-tenders",
    Array(
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
        "EDIT_STATUS" => "N",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "NOT_SHOW_FILTER" => array(0=>"",1=>"",),
        "NOT_SHOW_TABLE" => array(0=>"",1=>"",),
        "RESULT_ID" => $_REQUEST[RESULT_ID],
        "SEF_MODE" => "N",
        "SHOW_ADDITIONAL" => "N",
        "SHOW_ANSWER_VALUE" => "N",
        "SHOW_EDIT_PAGE" => "N",
        "SHOW_LIST_PAGE" => "N",
        "SHOW_STATUS" => "Y",
        "SHOW_VIEW_PAGE" => "N",
        "START_PAGE" => "new",
        "SUCCESS_URL" => "",
        "USE_EXTENDED_ERRORS" => "N",
        "VARIABLE_ALIASES" => array("action"=>"action",),
        "WEB_FORM_ID" => "14"
    )
);?>

<div class="clear20">
     
</div>