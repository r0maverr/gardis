// �������� ����������� �� ������ �� �������� ��� ������������
$(document).ready(function(){
	$('.diploms_show').click(function(){
		$(this).parents('.img_on_top').find('.diploms').find('a').click();
		return false;
	});
});