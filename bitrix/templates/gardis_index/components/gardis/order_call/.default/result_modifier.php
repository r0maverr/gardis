<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// �������� ����� ��� ������� ������
if(!empty($arResult["ERROR_MESSAGE"]) || !empty($arResult["OK_MESSAGE"]) || (isset($_REQUEST['order_call']) && $_REQUEST['order_call'] == 'y'))
{?>
	<script type="text/javascript">
		$(document).ready(function(){
			$.fancybox( '#phone_take' );
		});
	</script>
<?}?>