<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("�����������");
?>
<p>�� ���������������� � ������� ��������������.</p>

<?if($USER->isAdmin() || in_array("5", $USER->GetUserGroupArray())){?>

<p><a href="/catalog/">������� � ��������-�������</a></p>

<?}else{?>

<p>���� ������� ������ ����� ������������ ����� �������� ����� ������ ����������� ��������.</p>

<p>����� ��������� �� �������� ����������� �� E-mail.</p>
 
<p><a href="<?=SITE_DIR?>">��������� �� ������� ��������</a></p>


<?}?>
 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>