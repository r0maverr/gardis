<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//Блокировка каталога для неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Вход на сайт");
?>
<p class="notetext">Вы зарегистрированы и успешно авторизовались.</p>

<p><a href="/catalog/">Вернуться на главную страницу</a></p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>