//Показ ответа
$(document).ready(function() {
	$('.show_answer_item').click( function() {
		if ($(this).hasClass('act')) {
			$(this).parents('.answer_item').hide(50);
		}
		else {
			$(this).parents('.ask_item').find('.answer_item').show(50);
		}
	});
});