<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>
<p>Вы зарегистрированы и успешно авторизовались.</p>

<?if($USER->isAdmin() || in_array("5", $USER->GetUserGroupArray())){?>

<p><a href="/catalog/">Перейти в интернет-магазин</a></p>

<?}else{?>

<p>Ваша учетная запись будет активирована после проверки ваших данных менежджером компании.</p>

<p>После активации вы получите уведомление по E-mail.</p>
 
<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>


<?}?>
 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>