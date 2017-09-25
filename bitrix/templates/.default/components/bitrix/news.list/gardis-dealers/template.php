<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CAjax::Init();?>
<div id="dealers_list" pid="<?=CAjax::GetComponentID("bitrix:news.list","gardis-dealers",false)?>">
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
</style>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
$(document).ready(function(){
	

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);
//console.log('map ready')
function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    window.myMap = new ymaps.Map('dealers-map', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [63.594023, 101.253184], // центр россии
        zoom: 3
    }, {
        searchControlProvider: 'yandex#search'
    });
/*
    document.getElementById('destroyButton').onclick = function () {
        // Для уничтожения используется метод destroy.
        myMap.destroy();
    };
*/
}
})
</script>
<div class="row">
<div class="col-xs-12 dealers-map" id="dealers-map"></div>
</div>


<?
$cnt=0;
#echo "<pre>"; print_r($arResult["ITEMS"]);
foreach($arResult["ITEMS"] as $arItem){?>
<script>
ymaps.ready(function(){
	var myGeocoder = ymaps.geocode("<?=$arItem['PROPERTIES']['TOWN']['VALUE'];?>, <?=$arItem['PROPERTIES']['ADRESS']['VALUE']?>",{results:1});
	myGeocoder.then(
		function (res) {
			obj = res.geoObjects.get(0)
			obj.properties._data.balloonContentBody = "<div class='dealer-block'><p><strong><?=$arItem['NAME']?></strong></p><p><?=$arItem['PROPERTIES']['TOWN']['VALUE'];?></br><?if(strlen($arItem['PROPERTIES']['ADRESS']['VALUE'])>0):?><?=$arItem['PROPERTIES']['ADRESS']['VALUE'];?><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['PHONES']['VALUE'])>0):?><?=$arItem['PROPERTIES']['PHONES']['VALUE'];?><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['SITE']['VALUE'])>0):?><a href='http://<?=$arItem['PROPERTIES']['SITE']['VALUE'];?>' target='_blank'><?=$arItem['PROPERTIES']['SITE']['VALUE'];?></a><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['SITE2']['VALUE'])>0):?><a href='http://<?=$arItem['PROPERTIES']['SITE2']['VALUE'];?>' target='_blank'><?=$arItem['PROPERTIES']['SITE2']['VALUE'];?></a><br/><?endif;?><?if(strlen($arItem['PROPERTIES']['EMAIL']['VALUE'])>0):?><a href='mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>' class='mailto'><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a><?endif;?></p><?if($arItem['PROPERTIES']['STORE']['VALUE']==1):?><span class='safe_dealer'><?=GetMessage('HAS_STORE');?></span><?else:/*?><span class='safe_dealer_none'></span><?*/endif;?><?if($arItem['PROPERTIES']['MOUNTING']['VALUE']==1):?><span class='dealer_mouting'><?=GetMessage('HAS_MOUNTING');?></span><?else:/*?><span class='safe_dealer_none'></span><?*/endif;?></div>"
			window.myMap.geoObjects.add(obj)
		},
		function (err) {
			// обработка ошибки
		}
	);
})
</script>
<?}?>
</div>