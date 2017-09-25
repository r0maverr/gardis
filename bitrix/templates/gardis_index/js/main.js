$(document).ready(function() {
	$('.fancybox').fancybox();
});


$(document).ready(function(){
	$('.slider_tiny').tinycarousel({ display: 1, interval: false, controls: true  });
});

//хак)
$(document).ready(function() {
	var browserWindow = $(window);
	var height = $('#gird_container').height();
	var vis_screen_height = parseInt(browserWindow.height());
	if (height < vis_screen_height ) {
		height = vis_screen_height - 83;
		$('#gird_container').css('height',height);
	}
	else
	{}
	
});

//отступы в полях ввода для ие7 8
		$(document).ready(function() {
			var IE='\v'=='v';
			if(IE) {
				$(document).ready(function() {
					$('input[type=text]').each( function(){
						var he = parseInt($(this).css('height'));
						he = he - 5;
						$(this).css('height',he);
					});
					$('input[type=password]').each( function(){
						var he = parseInt($(this).css('height'));
						he = he - 5;
						$(this).css('height',he);
					});
				});
				
			}
		});
	
//для ие 7 8	
$(document).ready(function() {
	var IE='\v'=='v';
	if(IE) {
//alert("ie8");
		$("#head_menu ul li:last-child").css({'border-right':'0px'});
		$("#head_menu ul li ul li:last-child").css({'border-bottom':'1px solid #c9d7ee'});
		$(".product_card:nth-child(2n)").css({'margin-left':'0px'});
		$("table.nice_table tbody tr:nth-child(odd) td").css({'background':'#e8edf4'});
		$("table.nice_table tbody tr:first-child td").css({'background':'#738fb4','height':'44px','color':'#fff'});
		$(".dealer_block:nth-child(3n+2)").css({'margin-left':'50px'});
		$(".img_on_top:nth-child(3n+2)").css({'margin-left':'0px'});
		$(".photo_gal:nth-child(4n+3)").css({'margin-left':'0px'});
		}				
});



//Обрезание текста в блоке с новостью
$(document).ready(function() {
    $.each($('.main_news_block p'), function() {
      var tt = $(this).text();
      var tt_link = $(this).siblings('a').text().length;
      var temp;
      var l = tt.length + tt_link;
      if (l > 270) {
        temp = 270 - tt_link;
        tt = tt.slice(0, temp);
        $(this).text( tt + '...');
      }
    });
/*
  var tt = $('.main_news_block p').text();
  var tt_link = $('.main_news_block a').text().length;
  var temp;
  var l = tt.length + tt_link;
  if(l > 270) {
    temp = 270 - tt_link;
    tt = tt.slice(0, temp);
    $('.main_news_block p').text( tt + '...');
  }
*/  
});

//Скриптик для галлререи 
$(document).ready(function() {
	var first_img = $('.small_photo:first-child');
	var last_img = $('.small_photo:last-child');
	var href_attr;
	var main_photo_img = $('.main_photo img');

	$('.small_photo').click( function(){
		if ($(this).hasClass('act')) {}
		else {
			$(this).parents('.main_gallery').find('.act').removeClass('act');
			$(this).addClass('act');
			href_attr = $(this).find('img').attr('src');
			main_photo_img.attr('src',href_attr);
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
			return;
		}
		href_attr = next_img.find('img').attr('src');
		active_img.removeClass('act');
		next_img.addClass('act');
		main_photo_img.attr('src',href_attr);
	});
	
	$('.prev.button').click( function(){
		var active_img = $('.small_photos_container').find('.act');
		var prev_img = active_img.prev();
		if (active_img.is(':first-child')) {
			active_img.removeClass('act');
			last_img.addClass('act');
			href_attr = last_img.find('img').attr('src');
			main_photo_img.attr('src',href_attr);
			return;
		}
		href_attr = prev_img.find('img').attr('src');
		active_img.removeClass('act');
		prev_img.addClass('act');
		main_photo_img.attr('src',href_attr);
	});
	
	
});

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

//бираем стрелки, если в слайдере мало фото
$(document).ready(function() {
	$('.slider_tiny').each( function() {
		var i = 0;
		$(this).find('.slide_img_container').each( function() {
			i = i +1;
			console.log(i);
		});
		if (i <= 6) {
			$(this).find('.next').css('visibility','hidden');
			$(this).find('.prev').css('visibility','hidden');
		}
	});
});

$(document).ready(function(){
	$("select").sexyCombo();
});