<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������������ ������");
//���������� �������� ��� ���������������� � �� �������������� �����������
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "noaccess", "AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html",),false,Array('HIDE_ICONS' => 'Y'));
?>
<div class="bx_page">
	<p>� ������ �������� �� ������ ��������� ������� ��������� �������, ��� ���������� ����� �������, ����������� ��� �������� ������ ����������, � ����� ����������� �� ������� � ������ �������������� ��������. </p>
	<div>
		<h2>������ ����������</h2>
		<a href="profile/">�������� ��������������� ������</a>
	</div>
	<div>
		<h2>������</h2>
		<a href="order/">������������ � ���������� �������</a><br/>
		<a href="cart/">���������� ���������� �������</a><br/>
		<a href="order/">���������� ������� �������</a><br/>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
