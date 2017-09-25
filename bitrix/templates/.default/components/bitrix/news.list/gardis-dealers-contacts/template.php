<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//CAjax::Init();?>
<div id="dealers_list">
<style>
.dealers-map {
	position:relative;
	height:500px;
	margin-bottom:40px;
}
.dealer-block {
    float: left;
    padding: 0px 0px 30px 0;
    width: 270px;
}
.safe_dealer {
    float: left;
    padding-left: 35px;
    margin-top: 5px;
    width: 235px;
    height: 27px;
    background: url(/bitrix/templates/gardis_inner/./img/dealers.png) no-repeat left top;
}
.dealer_mouting {
    float: left;
    padding-left: 35px;
    margin-top: 5px;
    width: 235px;
    height: 27px;
    background: url(/bitrix/templates/gardis_inner/./img/mounting.png) no-repeat left top;
}
@media(max-width:991px){
.dealers-map {
	height:300px;
}}
</style>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
$(document).ready(function(){
	ymaps.ready(init);
	function init () {
		window.myMap = new ymaps.Map('dealers-map', {
			center: [55.008548, 83.065805],
			zoom: 10
		}, {
			searchControlProvider: 'yandex#search'
		});
		
		window.myMap.behaviors.disable('scrollZoom');
	}
})
</script>
<div class="row">
<div class="col-xs-12 dealers-map" id="dealers-map"></div>
</div>
<?
//default Nsk
if ( !$_REQUEST['arrDealersFilter_pf']['TOWN']) $_REQUEST['arrDealersFilter_pf']['TOWN'] = "Новосибирск";

foreach($arResult["ITEMS"] as $arItem){
	if ($_REQUEST["arrDealersFilter_pf"]["TOWN"] != 'all'){
		if ($arItem['PROPERTIES']['TOWN']['VALUE'] != $_REQUEST["arrDealersFilter_pf"]["TOWN"]) continue;
	}?>
<script>
ymaps.ready(function(){
	var myGeocoder = ymaps.geocode("<?=$arItem['PROPERTIES']['TOWN']['VALUE'];?>, <?=$arItem['PROPERTIES']['ADRESS']['VALUE']?>",{results:1});
	myGeocoder.then(
		function (res) {
			obj = res.geoObjects.get(0)
			obj.properties._data.balloonContentBody = "<div class='dealer-block'><p><strong><?=$arItem['NAME']?></strong></p><p><?=$arItem['PROPERTIES']['TOWN']['VALUE'];?></br><?if(strlen($arItem['PROPERTIES']['ADRESS']['VALUE'])>0):?><?=$arItem['PROPERTIES']['ADRESS']['VALUE'];?><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['PHONES']['VALUE'])>0):?><?=$arItem['PROPERTIES']['PHONES']['VALUE'];?><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['SITE']['VALUE'])>0):?><a href='http://<?=$arItem['PROPERTIES']['SITE']['VALUE'];?>' target='_blank'><?=$arItem['PROPERTIES']['SITE']['VALUE'];?></a><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['SITE2']['VALUE'])>0):?><a href='http://<?=$arItem['PROPERTIES']['SITE2']['VALUE'];?>' target='_blank'><?=$arItem['PROPERTIES']['SITE2']['VALUE'];?></a><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['EMAIL']['VALUE'])>0):?><a href='mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>' class='mailto'><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a><?endif;?></p><?if($arItem['PROPERTIES']['STORE']['VALUE']==1):?><span class='safe_dealer'><?=GetMessage('HAS_STORE');?></span><?else:/*?><span class='safe_dealer_none'></span><?*/endif;?><?if($arItem['PROPERTIES']['MOUNTING']['VALUE']==1):?><span class='dealer_mouting'><?=GetMessage('HAS_MOUNTING');?></span><?else:/*?><span class='safe_dealer_none'></span><?*/endif;?></div>"
			window.myMap.geoObjects.add(obj)
<?if ($_REQUEST["arrDealersFilter_pf"]["TOWN"] != 'all'){?>
			//console.log(<?=$_REQUEST["arrDealersFilter_pf"]["TOWN"]?>);
			window.myMap.setCenter(obj.geometry._coordinates)
			window.myMap.setZoom(10)
<?}else{?>
			window.myMap.setCenter([62.231701, 85.169200])
			window.myMap.setZoom(4)
<?}?>
		},
		function (err) {
			// обработка ошибки
		}
	);
})
</script>
<?}?>

</div>