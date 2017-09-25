<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("not_show_title", "N");
$APPLICATION->SetTitle("Услуги");
?>
<!-- 
<p>Чтобы сотрудничество с нами было удобным для заказчика, в компании принят стандарт обслуживания, предусматривающий следующие услуги:</p>
 <br>
<table style="vertical-align: middle;"> 
  <tbody> 
    <tr><td style="padding: 10px;"><img class="blue_border" src="/upload/medialibrary/dda/Consult.jpg" title="Consult.jpg" width="120" height="80" hspace="40" align="left" vspace="10" border="0"  /></td><td height="80" style="vertical-align: top; padding:10px;"><b>1. Консультации по подбору оборудования: </b>специалисты отдела продаж, исходя из ваших потребностей, предложат оптимальное решение для выбора моделей и типоразмеров выпускаемых ограждений.</td></tr>
   
    <tr><td style="padding:10px;"><img class="blue_border" src="/upload/medialibrary/51f/dostavka.jpg" title="dostavka.jpg" width="120" height="81" hspace="40" vspace="10" align="left" border="0"  /></td><td height="80" style="vertical-align: top; padding: 10px;"> <b>2.Помощь в организации доставки в любую точку России и СНГ: </b>подбор транспортно-экспедиционной компании, заказ автотранспорта, организации и проведение погрузки оборудования.</td></tr>
   
    <tr><td style="padding: 10px;"> <img class="blue_border" src="/upload/medialibrary/580/montaj.jpg" title="montaj.jpg" width="120" height="81" hspace="40" vspace="10" align="left"  /></td><td height="80" style="vertical-align: top; padding: 10px;"><b>3. Профессиональный монтаж </b> оборудования в любой точке России и Казахстана. Шеф-монтаж: выезд специалиста для консультации по вопросам установки ограждения силами заказчика. </td></tr>
   </tbody>
 </table>
 
<!--<p></p>
 
<br />
 
<p></p>
 
<p></p>
 -->
<?$APPLICATION->IncludeComponent("bitrix:news.list", "gardis_news_list", array(
	"IBLOCK_TYPE" => "information",
	"IBLOCK_ID" => "27",
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "NAME",
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
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "gardis_navigation",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"TITLE" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>