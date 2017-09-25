<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// Показать форму при наличии ошибки
if(!empty($arResult["ERROR_MESSAGE"]) || strlen($arResult["OK_MESSAGE"]) > 0 || (isset($_REQUEST['ask_price']) && $_REQUEST['ask_price'] == 'y'))
{?>
	<script type="text/javascript">
		$(document).ready(function(){
			$.fancybox( '#ask_price' );
		});
	</script>
<?}?>