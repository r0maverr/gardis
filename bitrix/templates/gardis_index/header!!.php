<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon"  href="/favicon.ico">
<? if (getenv('REQUEST_URI')=='/'): ?>
<title>Ia?a?aaiey e caai?u a Iiaineae?nea | Caaia caai?iuo ia?a?aaiee «Aa?aen»</title>
<?else:?>
	<title><?$APPLICATION->ShowTitle();?></title>
<?endif;?>
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
<div id="main_area" class="home_page" >
	<div id="main_container" >
		<div id="gird_container" >
			<div id="header">
				<div id="logo">
<?/*					<a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/gardies-logo-main.png"/></a>
					<h1>металличесие ограждения</h1>*/?>
<img src="<?=SITE_TEMPLATE_PATH;?>/img/gardies-logo.png"/>
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
				<div id="header_contacts" style="float: right;">
					<div id="telephone">
						<?$APPLICATION->IncludeComponent("gardis:order_call", ".default", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "Aaoa niiauaiea ioi?aaeaii. Iao iaiaa?a? nay?aony n aaie.",
	"EMAIL_TO" => "darkcorco@gmail.com",
	"REQUIRED_FIELDS" => array(
		0 => "PHONE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "25",
	),
	"AJAX_MODE" => "N"
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
<?$APPLICATION->IncludeComponent("bitrix:menu", "gardis_main_menu", Array(
	"ROOT_MENU_TYPE" => "top",	// Oei iai? aey ia?aiai o?iaiy
	"MAX_LEVEL" => "2",	// O?iaaiu aei?aiiinoe iai?
	"CHILD_MENU_TYPE" => "left",	// Oei iai? aey inoaeuiuo o?iaiae
	"USE_EXT" => "N",	// Iiaee??aou oaeeu n eiaiaie aeaa .oei_iai?.menu_ext.php
	"DELAY" => "N",	// Ioeeaauaaou auiieiaiea oaaeiia iai?
	"ALLOW_MULTI_SELECT" => "Y",	// ?ac?aoeou ianeieuei aeoeaiuo ioieoia iaiia?aiaiii
	"MENU_CACHE_TYPE" => "N",	// Oei eaoe?iaaiey
	"MENU_CACHE_TIME" => "3600",	// A?aiy eaoe?iaaiey (nae.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// O?eouaaou i?aaa ainooia
	"MENU_CACHE_GET_VARS" => "",	// Cia?eiua ia?aiaiiua cai?ina
	),
	false
);?>