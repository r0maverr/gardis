$(document).ready(function(){
	
	$('.onClickSize').on('click', function(){
		var parent = $(this).parent();
		if(parent.hasClass('table-show')){
			
			parent.removeClass('table-show');
			parent.find('.btn__name-size').html('�������� ��� �������');
			}else{
				
				parent.addClass('table-show');
				parent.find('.btn__name-size').html('��������');
				}
		
	});
	
});