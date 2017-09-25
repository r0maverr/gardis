<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наш адрес");

//Новое в разметке посетителей (класс подключается в init.php)
$arRef = CMyUTM::GetSource();
//if($arRef['clid'] == 'Директ' || ($arRef['first'] == 'Директ' && !$arRef['clid'])) //показываем если хоть раз с директа
if($arRef['clid'] == 'Директ'){ //показываем только если в этот раз с директа
   $phone = '239-00-27';
   $email = 'info-d@gardies.ru';
}elseif($arRef['clid'] == 'Гугл'){
   $phone = '319-00-19';
   $email = 'info-a@gardies.ru';
}else{
   $phone = '319-00-19';
   $email = 'info-s@gardies.ru';
}


?><?$APPLICATION->IncludeComponent(
	"bitrix:player", 
	".default", 
	array(
		"PLAYER_TYPE" => "auto",
		"USE_PLAYLIST" => "N",
		"PATH" => "/upload/iblock/df1/gardis_009_s.mp4ttp://localhost:6448/upload/iblock/44b/gardis_009_s.mp4",
		"WIDTH" => "",
		"HEIGHT" => "",
		"FULLSCREEN" => "Y",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
		"SKIN" => "bitrix.swf",
		"CONTROLBAR" => "bottom",
		"WMODE" => "transparent",
		"HIDE_MENU" => "N",
		"SHOW_CONTROLS" => "N",
		"SHOW_STOP" => "N",
		"SHOW_DIGITS" => "Y",
		"CONTROLS_BGCOLOR" => "FFFFFF",
		"CONTROLS_COLOR" => "000000",
		"CONTROLS_OVER_COLOR" => "000000",
		"SCREEN_COLOR" => "000000",
		"AUTOSTART" => "Y",
		"REPEAT" => "always",
		"VOLUME" => "90",
		"DISPLAY_CLICK" => "play",
		"MUTE" => "N",
		"HIGH_QUALITY" => "Y",
		"ADVANCED_MODE_SETTINGS" => "N",
		"BUFFER_LENGTH" => "10",
		"DOWNLOAD_LINK_TARGET" => "_self",
		"COMPONENT_TEMPLATE" => ".default",
		"SIZE_TYPE" => "fluid",
		"START_TIME" => "0",
		"PLAYBACK_RATE" => "1",
		"PRELOAD" => "N",
		"PLAYER_ID" => "",
		"PROVIDER" => "",
		"STREAMER" => "undefined",
		"PREVIEW" => "undefined",
		"FILE_TITLE" => "undefined",
		"FILE_DURATION" => "undefined",
		"FILE_AUTHOR" => "undefined",
		"FILE_DATE" => "undefined",
		"FILE_DESCRIPTION" => "undefined",
		"LOGO" => "undefined",
		"LOGO_LINK" => "undefined",
		"LOGO_POSITION" => "undefined",
		"PLUGINS" => array(
			0 => "undefined",
		),
		"ADDITIONAL_FLASHVARS" => "undefined",
		"ALLOW_SWF" => "undefined",
		"PLUGINS_UNDEFINED" => "undefined"
	),
	false
);?> <br>
 <br>
<p>
	 Металлические ограждения «Гардис»
</p>
<p>
	 ООО «ПГС-К»
</p>
<p itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> <span itemprop="postalCode">630025</span>, г. <span itemprop="addressLocality">Новосибирск</span>, ул. <span itemprop="streetAddress">Бердское шоссе, 61</span>, корпус 2 <br>
	 e-mail: <span itemprop="email"><a href="mailto:<?=$email?>"><?=$email?></a></span><br>
	 Тел.: <span itemprop="telephone" class="comagicphone">8-800-200-21-47<?//=$phone?><?/*<br />
+7 (383) 347-63-70<br />
+7 (383) 347-63-61<br />
+7 (383) 347-63-71*/?></span> </span>
</p>
 <?/* $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);*/?> <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view",
	".default",
	Array(
		"CONTROLS" => array(),
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:54.9593738751395;s:10:\"google_lon\";d:83.05665843072497;s:12:\"google_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:29:\"Гардис - панельные ограждения\";s:3:\"LON\";d:83.056683540344;s:3:\"LAT\";d:54.959334820658;}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "690",
		"OPTIONS" => array()
	)
);?>
<div>
 <br>
	<p>
		 Общество с ограниченной ответственностью «ПГС-К»
	</p>
	<p>
		 Юр. адрес: 630025, г. Новосибирск, ул. Бердское шоссе, дом 61
	</p>
	<p>
		 Фактический адрес: 630025, г. Новосибирск, ул. Бердское шоссе, дом 61
	</p>
	<p>
		 ИНН: 5406221521
	</p>
	<p>
		 КПП: 540901001
	</p>
	<p>
		 Р/счет: №40702810429120000351 в ОАО МДМ
	</p>
	<p>
		 БАНК г. Новосибирск
	</p>
	<p>
		 Кор.счет: 30101810100000000821
	</p>
	<p>
		 БИК: 045004821
	</p>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>