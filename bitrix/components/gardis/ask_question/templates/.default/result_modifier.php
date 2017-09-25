<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// Показать форму при наличии ошибки
if(!empty($arResult["ERROR_MESSAGE"]) || !empty($arResult["OK_MESSAGE"]) || (isset($_REQUEST['ask_question']) && $_REQUEST['ask_question'] == 'y'))
{?>
	<script type="text/javascript">
		$(document).ready(function(){
			$.fancybox( '#ask_take' );
		});
	</script>
<?}?>