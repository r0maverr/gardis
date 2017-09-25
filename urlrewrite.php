<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/productOld/([a-zA-Z01-9_-]+)/([a-zA-Z01-9_-]+)/[^/]*#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/productOld/detail.php",
	),
	array(
		"CONDITION" => "#^/products/([a-zA-Z01-9_-]+)/([a-zA-Z01-9_-]+)/[^/]*#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
		"ID" => "",
		"PATH" => "/products/detail.php",
	),
	array(
		"CONDITION" => "#^/gotovye-resheniya/([a-zA-Z01-9_-]+)2/.*#",
		"RULE" => "SECTION_ID=\$1",
		"ID" => "",
		"PATH" => "/gotovye-resheniya/index.php",
	),
	array(
		"CONDITION" => "#^/gotovye-resheniya/([a-zA-Z01-9_-]+)/.*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/gotovye-resheniya/index.php",
	),
	array(
		"CONDITION" => "#^/productOld/([a-zA-Z01-9_-]+)/.*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/productOld/index.php",
	),
	array(
		"CONDITION" => "#^/useful/([a-zA-Z01-9_-]+)/[^/]*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/useful/detail.php",
	),
	array(
		"CONDITION" => "#^/products/([a-zA-Z01-9_-]+)/.*#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/products/index.php",
	),
	array(
		"CONDITION" => "#^/services/([a-zA-Z01-9_-]+)/#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/services/detali.php",
	),
	array(
		"CONDITION" => "#^/about/news/([0-9]+)/[^/]*#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/about/news/detail.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/personal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/catalog/personal/order/index.php",
	),
	array(
		"CONDITION" => "#^/gallery/([0-9]+)/(.*)#",
		"RULE" => "SECTION_ID=\$1&OTHER=\$2",
		"ID" => "",
		"PATH" => "/gallery/list.php",
	),
	array(
		"CONDITION" => "#^/catalog/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/catalog/index.php",
	),
	array(
		"CONDITION" => "#^([^/]+?)\\??(.*)#",
		"RULE" => "SECTION_CODE=\$1&\$2",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/gotovye-resheniya/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/store/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/catalog/store/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/catalog/news/index.php",
	),
	array(
		"CONDITION" => "#^/products-2/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products-2/index.php",
	),
	array(
		"CONDITION" => "#^/productOld/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/productOld/index.php",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/catalog/index.php",
	),
);

?>