<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
//Блокировка каталога для неавторизованных и не активированных посетителей
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
?>
<div class="bx_page">
	<p>В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки. </p>
	<div>
		<h2>Личная информация</h2>
		<a href="profile/">Изменить регистрационные данные</a>
	</div>
	<div>
		<h2>Заказы</h2>
		<a href="order/">Ознакомиться с состоянием заказов</a><br/>
		<a href="cart/">Посмотреть содержимое корзины</a><br/>
		<a href="order/">Посмотреть историю заказов</a><br/>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
