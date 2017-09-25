//Обновление списка дилеров без перезагрузки страницы на jquery
/*$(document).ready(function(){
	$("#dealers_select,#dealers_checkbox").change(function(){
		var pid=$("#dealers_list").attr('pid');
		var select_name=$('#dealers_select').attr('name');
		var checkbox_name=$('#dealers_checkbox').attr('name');
		var select_val=$('#dealers_select').val();
		var checkbox_val=$('#dealers_checkbox').val();
		$.get('/dealers/',{'AJAX_CALL':'Y','bxajaxid':pid,'set_filter':'Y',select_name:select_val,checkbox_name:checkbox_val},function(data){
			alert(data);
			$('#comp_'+pid).html(data);
		});
	});
});*/
$(document).ready(function(){
	$("#dealers_select,#dealers_checkbox").change(function(){
		$('#dealers_form').submit();
	});
});
