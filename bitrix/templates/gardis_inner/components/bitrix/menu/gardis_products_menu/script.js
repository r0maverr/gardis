//Обновление списка товаров без перезагрузки страницы на jquery
$(document).ready(function(){
  /*
	$("a[rel='ReplaceContentProduct']").click(function(){
		var pid=$("#product_list").attr('pid');
		var ths=$(this);
		var menu_pid=$("#product_menu_list").attr('pid');
		$.get($(this).attr('href'),{'AJAX_CALL':'Y','bxajaxid':pid},function(data){
			$('#comp_'+pid).html(data);
			$("#product_menu_list li.act").removeClass('act');
			ths.parents('li').addClass('act');
		});
		return false;
	});
  */
});