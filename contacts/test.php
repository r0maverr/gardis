<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("��� �����");

//����� � �������� ����������� (����� ������������ � init.php)
$arRef = CMyUTM::GetSource();
//if($arRef['clid'] == '������' || ($arRef['first'] == '������' && !$arRef['clid'])) //���������� ���� ���� ��� � �������
if($arRef['clid'] == '������'){ //���������� ������ ���� � ���� ��� � �������
   $phone = '239-00-27';
   $email = 'info-d@gardies.ru';
}elseif($arRef['clid'] == '����'){
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
	 ������������� ���������� �������
</p>
<p>
	 ��� ����-ʻ
</p>
<p itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> <span itemprop="postalCode">630025</span>, �. <span itemprop="addressLocality">�����������</span>, ��. <span itemprop="streetAddress">�������� �����, 61</span>, ������ 2 <br>
	 e-mail: <span itemprop="email"><a href="mailto:<?=$email?>"><?=$email?></a></span><br>
	 ���.: <span itemprop="telephone" class="comagicphone">8-800-200-21-47<?//=$phone?><?/*<br />
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
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:54.9593738751395;s:10:\"google_lon\";d:83.05665843072497;s:12:\"google_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:29:\"������ - ��������� ����������\";s:3:\"LON\";d:83.056683540344;s:3:\"LAT\";d:54.959334820658;}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "690",
		"OPTIONS" => array()
	)
);?>
<div>
 <br>
	<p>
		 �������� � ������������ ���������������� ����-ʻ
	</p>
	<p>
		 ��. �����: 630025, �. �����������, ��. �������� �����, ��� 61
	</p>
	<p>
		 ����������� �����: 630025, �. �����������, ��. �������� �����, ��� 61
	</p>
	<p>
		 ���: 5406221521
	</p>
	<p>
		 ���: 540901001
	</p>
	<p>
		 �/����: �40702810429120000351 � ��� ���
	</p>
	<p>
		 ���� �. �����������
	</p>
	<p>
		 ���.����: 30101810100000000821
	</p>
	<p>
		 ���: 045004821
	</p>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>