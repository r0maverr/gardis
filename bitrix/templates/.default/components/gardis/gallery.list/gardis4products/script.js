//Скриптик для галлререи 
$(document).ready(function() {
	var first_img = $('.small_photo:first-child');
	var last_img = $('.small_photo:last-child');
	var href_attr;
	var main_photo_img = $('.main_photo img');
	var gallery_info = $('#product_gallery_info');

	$('.small_photo').click( function(){
		if ($(this).hasClass('act')) {}
		else {
console.log($("#info_"+$(this).attr('id')));
			$(this).parents('.main_gallery').find('.act').removeClass('act');
			$(this).addClass('act');
			href_attr = $(this).find('img').attr('src');
			main_photo_img.attr('src',href_attr);
			gallery_info.html($("#info_"+$(this).attr('id')).html());
		}	
	});
	
	$('.next.button').click( function(){
		var active_img = $('.small_photos_container').find('.act');
		var next_img = active_img.next();
		if (active_img.is(':last-child')) {
			active_img.removeClass('act');
			first_img.addClass('act');
			href_attr = first_img.find('img').attr('src');
			main_photo_img.attr('src',href_attr);
			gallery_info.html($("#info_"+first_img.attr('id')).html());
			return;
		}
		href_attr = next_img.find('img').attr('src');
		active_img.removeClass('act');
		next_img.addClass('act');
		main_photo_img.attr('src',href_attr);
		gallery_info.html($("#info_"+next_img.attr('id')).html());
	});
	
	$('.prev.button').click( function(){
		var active_img = $('.small_photos_container').find('.act');
		var prev_img = active_img.prev();
		if (active_img.is(':first-child')) {
			active_img.removeClass('act');
			last_img.addClass('act');
			href_attr = last_img.find('img').attr('src');
			main_photo_img.attr('src',href_attr);
			gallery_info.html($("#info_"+last_img.attr('id')).html());
			return;
		}
		href_attr = prev_img.find('img').attr('src');
		active_img.removeClass('act');
		prev_img.addClass('act');
		main_photo_img.attr('src',href_attr);
		gallery_info.html($("#info_"+prev_img.attr('id')).html());
	});
	
	
});