$(document).ready(function(){

	// about/production sliders

	if ( $('video.vjs-tech').length ) {
	    $('video.vjs-tech').attr("loop", "loop")
		$('video.vjs-tech').attr("autoplay", "autoplay")
/*
		$('video.vjs-tech').get(0).play()*/
	}

	if ( $('#slider-1').length ) {
		$('#slider-1').bxSlider({
		  mode: 'fade',
		  captions: true,
		  pager: false
		});
	}
 	if ( $('#slider-2').length ) {
		$('#slider-2').bxSlider({
		  mode: 'fade',
		  captions: true,
		  pager: false
		});
	}
	if ( $('#slider-3').length ) {
		$('#slider-3').bxSlider({
		  mode: 'fade',
		  captions: true,
		  pager: false
		});
	}
	if ( $('#slider-4').length ) {
		$('#slider-4').bxSlider({
		  mode: 'fade',
		  captions: true,
		  pager: false
		});
	}

    $('.fancybox').fancybox();
	$('.fancybox2').fancybox({
		width: '50%',
		autoSize : false,
		fitToView : false,
	});

	//$('.slider_tiny').tinycarousel({ display: 1, interval: false, controls: true });

    $('.owl-slider').owlCarousel({
        loop:true,
        margin:10,
        dots: false,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:2,
                nav:true
            },
            600:{
                items:4,
                nav:true
            },
            1000:{
                items:5,
                nav:true,
                loop:true
            }
        }
    });


    $('.pdoduct-list.slider').owlCarousel({
        loop:true,
        margin:10,
        dots: false,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:true
            },
            1000:{
                items:4,
                nav:true,
            }
        }
    });

    $('.related-products .pdoduct-list-slider').owlCarousel({
        loop:true,
        margin:10,
        dots: false,
        //nav:true,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:true
            },
            1000:{
                items:3,
                loop:true,
                nav:true
            }
        }
    });

    /* $('.slider-main').owlCarousel({
        loop:true,
        margin:10,
        video:true,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            }
        }
    });*/

    var owl = $('.slider-main');
      owl.owlCarousel({
        loop:true,
        margin:10,
        video:true,
        dots:false,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            }
        }
      })
      owl.on('translate.owl.carousel',function(e){
        $('.owl-item video').each(function(){
          $(this).get(0).pause();
        });
      });
      owl.on('translated.owl.carousel',function(e){
        $('.owl-item.active video').get(0).play();
      })

    $('.owl-item .item-video').each(function(){
        var attrmp4 = $(this).attr('data-videomp4src');
        var attrwebm = $(this).attr('data-videowebmsrc');
        if (typeof attrmp4 !== typeof undefined && attrmp4 !== false && typeof attrwebm !== typeof undefined && attrwebm !== false) {
            var videomp4src = $(this).attr('data-videomp4src');
            var videowebmsrc = $(this).attr('data-videowebmsrc');
            $(this).prepend('<video muted><source src="' + videomp4src + '" type="video/mp4"><source src="' + videowebmsrc + '" type="video/webm"></video>');
            $(this).prepend('');
      }
    });
    $('.owl-item.active video').attr('autoplay', true).attr('loop', true);


    var $solutionsList = $(".ready-solutions-list"),
        $solutionsThumbs = $(".ready-solutions-list-icon");
    $solutionsList.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.ready-solutions-list-icon'
    });
    $solutionsThumbs.slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.ready-solutions-list',
        prevArrow: '<div class="solutions-icon-nav-left"></div>',
        nextArrow: '<div class="solutions-icon-nav-right"></div>',
        //centerMode: true,
        focusOnSelect: true,

        responsive: [
        {
          breakpoint: 1170,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
            //infinite: true,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
    $('.solutions-nav-right').click(function(e) {
        e.preventDefault();
        $solutionsList.slick('slickNext');
    });
    $('.solutions-nav-left').click(function(e) {
        e.preventDefault();
        $solutionsList.slick('slickPrev');
    });

    /*$('.ready-solutions-list').owlCarousel({
        loop:true,
        // margin:10,
        // responsiveClass:true,
        // navContainer: true,
        // navClass: [ 'solutions-nav-left', 'solutions-nav-right' ],
        nav:false,
        thumbs: true,
        thumbsPrerendered: true,
        //navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1
                //,nav:true
            }
        }
    });
    $('.solutions-nav-right').click(function(e) {
        e.preventDefault();
        $(".owl-carousel").trigger('next.owl.carousel');
    });
    $('.solutions-nav-left').click(function(e) {
        e.preventDefault();
        $(".owl-carousel").trigger('prev.owl.carousel');
    });*/

    function showNav(e){
        $(".solutions-nav-right").fadeIn();
        $(".solutions-nav-left").fadeIn();

    }
    function hideNav(e){
        $(".solutions-nav-right").fadeOut();
        $(".solutions-nav-left").fadeOut();
    }
    $(".ready-solutions-list .img-wrap").hover(showNav, hideNav);

    //tabs


    //tabs
    // tabs-accordion
    $('.tabs-accordion').each(function () {
        var base = this;
        $('.tab:nth-child(n+2)', base).slideUp(0);
        tabAccodionShow(base, 0);
        $('.tab-toggle', base).on('click', function () {
            var idx = $(this).data('idx');
            tabAccodionShow(base, idx, $(this).hasClass('is-active'));
        });
    });

    function tabAccodionShow(base, idx, close) {
        $('.tab', base).stop(true).slideUp(700)
            .removeClass('is-active');
        $('.tab-toggle', base).removeClass('is-active');
        if (!close) {
            $('.tab', base).eq(idx).addClass('is-active')
                .slideToggle(700);
            $('.tab-toggle[data-idx=' + idx + ']', base).addClass('is-active');
        }
    }


    //


});

function check_field_order_calc_form(){
    var order_calс_form = $('#order_calс_form');
    if ( order_calс_form ) {
        var err=0;
        $(order_calс_form).find('textarea, input').each(function(){
            if (this.type != "submit" ) {
                /*$(this).css('border', '1px solid red');*/
                switch (this.id) {
                    //case "re_input_name":
                    case "re_input_phone":
                    //case "re_input_subject":
                    if ( this.value !== "" ) {
                        $(this).css('borderColor', '#d1cfcf');
                    }
                    else {
                        $(this).css('borderColor', 'red');
                        err = 1
                    }
                    break;
                }
            }
        });
        if ( err == 1 ) {
            $('#order_calc_form_button').attr('disabled', true);
        }
        else {
            $('#order_calc_form_button').attr('disabled', false);
        }
    }
}

function checkreq(button) {
    var error = 0;
    $(button).parents('form').find('.check').each(function () {
        var input = $(this);
        var error2 = 0;
        $(input).removeClass('error');
        if ($(input).is('input')) {
            var input_name = $(this).attr('data-sid');
            if ($(this).val().length < 1) {
                error2 = 1;
            } else if (input_name == 'USER_EMAIL' || input_name == 'NEW_EMAIL' || input_name == 'EMAIL') {
                if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($(this).val())) {
                    error2 = 1;
                }
            }
        }
        if ($(this).is('select')) {
            if ($(this).val() < 1) {
                error2 = 1;
            }
        }
        if ($(this).is('textarea')) {
            if ($(this).val().length < 2) {
                error2 = 1;
            }
        }

        if ($(this).hasClass('checkboks')) {
            if (!$(this).hasClass('checked')) {
                if(!$(this).is(':checked')){
                    error2 = 1;
                    $(this).addClass('error');
                }else{
                    $(this).removeClass('error');
                }
            }
        }

        if (error2 == 1) {
            error = 1;
            $(input).addClass('error');
        }
        else{
            $(input).removeClass('error');
            console.log('input', $(input));
        }
    });
    if (error == 1) {
        $(button).parents('form').parent().find('.errortext').html('Не заполнены обязательные поля').show();
    }
    return error;
}


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
	//	alert("ie8");
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
		var tt = $('.main_news_block p').text();
		var tt_link = $('.main_news_block a').text().length;
		var temp;
		var l = tt.length + tt_link;
		if(l > 270) {
			temp = 270 - tt_link;
			tt = tt.slice(0, temp);
			$('.main_news_block p').text( tt + '...');
        }
});

//убираем стрелки, если в слайдере мало фото
/*$(document).ready(function() {
	$('.slider_tiny').each( function() {
		var i = 0;
		$(this).find('.slide_img_container').each( function() {
			i = i +1;
			// console.log(i);
		});
		if (i <= 6) {
			$(this).find('.next').css('visibility','hidden');
			$(this).find('.prev').css('visibility','hidden');
		}
	});
});*/