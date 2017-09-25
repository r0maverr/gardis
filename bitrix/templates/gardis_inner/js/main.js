$(document).ready(function(){
/*	
	// gotovye form
	if ( $('.request-phone').length ) {
		$('.request-phone input').attr("placeholder", "Телефон")
		$('.request-phone input').mask('+7 (999) 999-99-99', {placeholder: '+7 (___) ___-__-__'})
	}
	if ( $('.request-name').length ) {
		$('.request-name input').attr("placeholder", "Имя")
	}
*/	
	// about/production sliders 
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
		height: 'auto',
		autoSize : false,
		scrolling: 'auto',
		fitToView : false,
		helpers: { 
			title: null
		},
        overlay : {
            locked: false
        }
	});
	$('.fancybox3').fancybox({    
		width: '50%',
		padding: 50,
		height: 'auto',
		autoSize : false,
		scrolling: 'auto',
		fitToView : false,
		helpers: { 
			title: null
		},
        overlay : {
            locked: false
        }
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
                nav:true,
            }
        }
    });
    
    $('.slider-main').owlCarousel({
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
    });
    
    $('.reviews-list.owl-carousel').owlCarousel({
        loop:true,
        auto:true,
        margin:10,
        autoplay:true,
        responsiveClass:true,
        navText: ["<div class='slider-nav-left'></div>","<div class='slider-nav-right'></div>"],
        responsive:{
            0:{
                items:1,
                nav:true
            }
        }
    });

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
    
    // верхняя карусель 
    /*var leftUIEl = $('.solutions-icon-nav-left');
	var rightUIEl = $('.solutions-icon-nav-right');
	var elementsList = $('.owl-thumbs'); 

	var wrapCarusel = $('.wrap-carusel-content').width();
	var pixelsOffsetM = $(elementsList).find('.preview-wrap').outerWidth(true);
	var pixelsOffsetWM = $(elementsList).find('.preview-wrap').outerWidth();
	var pixelsOffset = pixelsOffsetM - (pixelsOffsetM-pixelsOffsetWM)/2;
	var currentLeftValue = 0;
	var elementsCount = elementsList.find('.preview-wrap').length;
	var minimumOffset = - Math.round((elementsCount - wrapCarusel/pixelsOffset) * pixelsOffset);
	var maximumOffset = 0;
console.log('wrapCarusel', wrapCarusel);
console.log('pixelsOffset', pixelsOffset);
console.log('del', wrapCarusel/pixelsOffset);
console.log('minimumOffset', minimumOffset);
	leftUIEl.click(function() {		
		if (currentLeftValue != maximumOffset) {
			currentLeftValue += pixelsOffset;
			elementsList.animate({ left : currentLeftValue + "px"}, 100);
		}		
	});

	rightUIEl.click(function() {
console.log('currentLeftValue', currentLeftValue);	
		if (currentLeftValue >= minimumOffset) {
			currentLeftValue -= pixelsOffset;
			elementsList.animate({ left : currentLeftValue + "px"}, 100);
		}		
	});*/
    
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
    $('input.phone,input[name="phone"]').mask('+7(999)999-99-99', {placeholder: '+7(___)___-__-__'});
    
});

function check_field_order_calс_form(){
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
            $('#order_calс_form_button').attr('disabled', true);
        }
        else {
            $('#order_calс_form_button').attr('disabled', false);
        }
    }
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