(function ($, undefined) {
    'use strict';
    var defaults = {
        item: 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 10,
        addClass: '',
        mode: 'slide',
        useCSS: true,
        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',
        easing: 'linear', //'for jquery animation',//
        speed: 400, //ms'
        auto: false,
        pauseOnHover: false,
        loop: false,
        slideEndAnimation: true,
        pause: 2000,
        keyPress: false,
        controls: true,
        prevHtml: '',
        nextHtml: '',
        rtl: false,
        adaptiveHeight: false,
        vertical: false,
        verticalHeight: 500,
        vThumbWidth: 100,
        thumbItem: 10,
        pager: true,
        gallery: false,
        galleryMargin: 5,
        thumbMargin: 5,
        currentPagerPosition: 'middle',
        enableTouch: true,
        enableDrag: true,
        freeMove: true,
        swipeThreshold: 40,
        responsive: [],
        /* jshint ignore:start */
        onBeforeStart: function ($el) {},
        onSliderLoad: function ($el) {},
        onBeforeSlide: function ($el, scene) {},
        onAfterSlide: function ($el, scene) {},
        onBeforeNextSlide: function ($el, scene) {},
        onBeforePrevSlide: function ($el, scene) {}
        /* jshint ignore:end */
    };
    $.fn.lightSlider = function (options) {
        if (this.length === 0) {
            return this;
        }

        if (this.length > 1) {
            this.each(function () {
                $(this).lightSlider(options);
            });
            return this;
        }

        var plugin = {},
            settings = $.extend(true, {}, defaults, options),
            settingsTemp = {},
            $el = this;
        plugin.$el = this;

        if (settings.mode === 'fade') {
            settings.vertical = false;
        }
        var $children = $el.children(),
            windowW = $(window).width(),
            breakpoint = null,
            resposiveObj = null,
            length = 0,
            w = 0,
            on = false,
            elSize = 0,
            $slide = '',
            scene = 0,
            property = (settings.vertical === true) ? 'height' : 'width',
            gutter = (settings.vertical === true) ? 'margin-bottom' : 'margin-right',
            slideValue = 0,
            pagerWidth = 0,
            slideWidth = 0,
            thumbWidth = 0,
            interval = null,
            isTouch = ('ontouchstart' in document.documentElement);
        var refresh = {};

        refresh.chbreakpoint = function () {
            windowW = $(window).width();
            if (settings.responsive.length) {
                var item;
                if (settings.autoWidth === false) {
                    item = settings.item;
                }
                if (windowW < settings.responsive[0].breakpoint) {
                    for (var i = 0; i < settings.responsive.length; i++) {
                        if (windowW < settings.responsive[i].breakpoint) {
                            breakpoint = settings.responsive[i].breakpoint;
                            resposiveObj = settings.responsive[i];
                        }
                    }
                }
                if (typeof resposiveObj !== 'undefined' && resposiveObj !== null) {
                    for (var j in resposiveObj.settings) {
                        if (resposiveObj.settings.hasOwnProperty(j)) {
                            if (typeof settingsTemp[j] === 'undefined' || settingsTemp[j] === null) {
                                settingsTemp[j] = settings[j];
                            }
                            settings[j] = resposiveObj.settings[j];
                        }
                    }
                }
                if (!$.isEmptyObject(settingsTemp) && windowW > settings.responsive[0].breakpoint) {
                    for (var k in settingsTemp) {
                        if (settingsTemp.hasOwnProperty(k)) {
                            settings[k] = settingsTemp[k];
                        }
                    }
                }
                if (settings.autoWidth === false) {
                    if (slideValue > 0 && slideWidth > 0) {
                        if (item !== settings.item) {
                            scene = Math.round(slideValue / ((slideWidth + settings.slideMargin) * settings.slideMove));
                        }
                    }
                }
            }
        };

        refresh.calSW = function () {
            if (settings.autoWidth === false) {
                slideWidth = (elSize - ((settings.item * (settings.slideMargin)) - settings.slideMargin)) / settings.item;
            }
        };

        refresh.calWidth = function (cln) {
            var ln = cln === true ? $slide.find('.lslide').length : $children.length;
            if (settings.autoWidth === false) {
                w = ln * (slideWidth + settings.slideMargin);
            } else {
                w = 0;
                for (var i = 0; i < ln; i++) {
                    w += (parseInt($children.eq(i).width()) + settings.slideMargin);
                }
            }
            return w;
        };
        plugin = {
            doCss: function () {
                var support = function () {
                    var transition = ['transition', 'MozTransition', 'WebkitTransition', 'OTransition', 'msTransition', 'KhtmlTransition'];
                    var root = document.documentElement;
                    for (var i = 0; i < transition.length; i++) {
                        if (transition[i] in root.style) {
                            return true;
                        }
                    }
                };
                if (settings.useCSS && support()) {
                    return true;
                }
                return false;
            },
            keyPress: function () {
                if (settings.keyPress) {
                    $(document).on('keyup.lightslider', function (e) {
                        if (!$(':focus').is('input, textarea')) {
                            if (e.preventDefault) {
                                e.preventDefault();
                            } else {
                                e.returnValue = false;
                            }
                            if (e.keyCode === 37) {
                                $el.goToPrevSlide();
                            } else if (e.keyCode === 39) {
                                $el.goToNextSlide();
                            }
                        }
                    });
                }
            },
            controls: function () {
                if (settings.controls) {
                    $el.after('<div class="lSAction"><a class="lSPrev">' + settings.prevHtml + '</a><a class="lSNext">' + settings.nextHtml + '</a></div>');
                    if (!settings.autoWidth) {
                        if (length <= settings.item) {
                            $slide.find('.lSAction').hide();
                        }
                    } else {
                        if (refresh.calWidth(false) < elSize) {
                            $slide.find('.lSAction').hide();
                        }
                    }
                    $slide.find('.lSAction a').on('click', function (e) {
                        if (e.preventDefault) {
                            e.preventDefault();
                        } else {
                            e.returnValue = false;
                        }
                        if ($(this).attr('class') === 'lSPrev') {
                            $el.goToPrevSlide();
                        } else {
                            $el.goToNextSlide();
                        }
                        return false;
                    });
                }
            },
            initialStyle: function () {
                var $this = this;
                if (settings.mode === 'fade') {
                    settings.autoWidth = false;
                    settings.slideEndAnimation = false;
                }
                if (settings.auto) {
                    settings.slideEndAnimation = false;
                }
                if (settings.autoWidth) {
                    settings.slideMove = 1;
                    settings.item = 1;
                }
                if (settings.loop) {
                    settings.slideMove = 1;
                    settings.freeMove = false;
                }
                settings.onBeforeStart.call(this, $el);
                refresh.chbreakpoint();
                $el.addClass('lightSlider').wrap('<div class="lSSlideOuter ' + settings.addClass + '"><div class="lSSlideWrapper"></div></div>');
                $slide = $el.parent('.lSSlideWrapper');
                if (settings.rtl === true) {
                    $slide.parent().addClass('lSrtl');
                }
                if (settings.vertical) {
                    $slide.parent().addClass('vertical');
                    elSize = settings.verticalHeight;
                    $slide.css('height', elSize + 'px');
                } else {
                    elSize = $el.outerWidth();
                }
                $children.addClass('lslide');
                if (settings.loop === true && settings.mode === 'slide') {
                    refresh.calSW();
                    refresh.clone = function () {
                        if (refresh.calWidth(true) > elSize) {
                            /**/
                            var tWr = 0,
                                tI = 0;
                            for (var k = 0; k < $children.length; k++) {
                                tWr += (parseInt($el.find('.lslide').eq(k).width()) + settings.slideMargin);
                                tI++;
                                if (tWr >= (elSize + settings.slideMargin)) {
                                    break;
                                }
                            }
                            var tItem = settings.autoWidth === true ? tI : settings.item;

                            /**/
                            if (tItem < $el.find('.clone.left').length) {
                                for (var i = 0; i < $el.find('.clone.left').length - tItem; i++) {
                                    $children.eq(i).remove();
                                }
                            }
                            if (tItem < $el.find('.clone.right').length) {
                                for (var j = $children.length - 1; j > ($children.length - 1 - $el.find('.clone.right').length); j--) {
                                    scene--;
                                    $children.eq(j).remove();
                                }
                            }
                            /**/
                            for (var n = $el.find('.clone.right').length; n < tItem; n++) {
                                $el.find('.lslide').eq(n).clone().removeClass('lslide').addClass('clone right').appendTo($el);
                                scene++;
                            }
                            for (var m = $el.find('.lslide').length - $el.find('.clone.left').length; m > ($el.find('.lslide').length - tItem); m--) {
                                $el.find('.lslide').eq(m - 1).clone().removeClass('lslide').addClass('clone left').prependTo($el);
                            }
                            $children = $el.children();
                        } else {
                            if ($children.hasClass('clone')) {
                                $el.find('.clone').remove();
                                $this.move($el, 0);
                            }
                        }
                    };
                    refresh.clone();
                }
                refresh.sSW = function () {
                    length = $children.length;
                    if (settings.rtl === true && settings.vertical === false) {
                        gutter = 'margin-left';
                    }
                    if (settings.autoWidth === false) {
                        $children.css(property, slideWidth + 'px');
                    }
                    $children.css(gutter, settings.slideMargin + 'px');
                    w = refresh.calWidth(false);
                    $el.css(property, w + 'px');
                    if (settings.loop === true && settings.mode === 'slide') {
                        if (on === false) {
                            scene = $el.find('.clone.left').length;
                        }
                    }
                };
                refresh.calL = function () {
                    $children = $el.children();
                    length = $children.length;
                };
                if (this.doCss()) {
                    $slide.addClass('usingCss');
                }
                refresh.calL();
                if (settings.mode === 'slide') {
                    refresh.calSW();
                    refresh.sSW();
                    if (settings.loop === true) {
                        slideValue = $this.slideValue();
                        this.move($el, slideValue);
                    }
                    if (settings.vertical === false) {
                        this.setHeight($el, false);
                    }

                } else {
                    this.setHeight($el, true);
                    $el.addClass('lSFade');
                    if (!this.doCss()) {
                        $children.fadeOut(0);
                        $children.eq(scene).fadeIn(0);
                    }
                }
                if (settings.loop === true && settings.mode === 'slide') {
                    $children.eq(scene).addClass('active');
                } else {
                    $children.first().addClass('active');
                }
            },
            pager: function () {
                var $this = this;
                refresh.createPager = function () {
                    thumbWidth = (elSize - ((settings.thumbItem * (settings.thumbMargin)) - settings.thumbMargin)) / settings.thumbItem;
                    var $children = $slide.find('.lslide');
                    var length = $slide.find('.lslide').length;
                    var i = 0,
                        pagers = '',
                        v = 0;
                    for (i = 0; i < length; i++) {
                        if (settings.mode === 'slide') {
                            // calculate scene * slide value
                            if (!settings.autoWidth) {
                                v = i * ((slideWidth + settings.slideMargin) * settings.slideMove);
                            } else {
                                v += ((parseInt($children.eq(i).width()) + settings.slideMargin) * settings.slideMove);
                            }
                        }
                        var thumb = $children.eq(i * settings.slideMove).attr('data-thumb');
                        if (settings.gallery === true) {
                            pagers += '<li style="width:100%;' + property + ':' + thumbWidth + 'px;' + gutter + ':' + settings.thumbMargin + 'px"><a href="#"><img src="' + thumb + '" /></a></li>';
                        } else {
                            pagers += '<li><a href="#">' + (i + 1) + '</a></li>';
                        }
                        if (settings.mode === 'slide') {
                            if ((v) >= w - elSize - settings.slideMargin) {
                                i = i + 1;
                                var minPgr = 2;
                                if (settings.autoWidth) {
                                    pagers += '<li><a href="#">' + (i + 1) + '</a></li>';
                                    minPgr = 1;
                                }
                                if (i < minPgr) {
                                    pagers = null;
                                    $slide.parent().addClass('noPager');
                                } else {
                                    $slide.parent().removeClass('noPager');
                                }
                                break;
                            }
                        }
                    }
                    var $cSouter = $slide.parent();
                    $cSouter.find('.lSPager').html(pagers); 
                    if (settings.gallery === true) {
                        if (settings.vertical === true) {
                            // set Gallery thumbnail width
                            $cSouter.find('.lSPager').css('width', settings.vThumbWidth + 'px');
                        }
                        pagerWidth = (i * (settings.thumbMargin + thumbWidth)) + 0.5;
                        $cSouter.find('.lSPager').css({
                            property: pagerWidth + 'px',
                            'transition-duration': settings.speed + 'ms'
                        });
                        if (settings.vertical === true) {
                            $slide.parent().css('padding-right', (settings.vThumbWidth + settings.galleryMargin) + 'px');
                        }
                        $cSouter.find('.lSPager').css(property, pagerWidth + 'px');
                    }
                    var $pager = $cSouter.find('.lSPager').find('li');
                    $pager.first().addClass('active');
                    $pager.on('click', function () {
                        if (settings.loop === true && settings.mode === 'slide') {
                            scene = scene + ($pager.index(this) - $cSouter.find('.lSPager').find('li.active').index());
                        } else {
                            scene = $pager.index(this);
                        }
                        $el.mode(false);
                        if (settings.gallery === true) {
                            $this.slideThumb();
                        }
                        return false;
                    });
                };
                if (settings.pager) {
                    var cl = 'lSpg';
                    if (settings.gallery) {
                        cl = 'lSGallery';
                    }
                    $slide.after('<ul class="lSPager ' + cl + '"></ul>');
                    var gMargin = (settings.vertical) ? 'margin-left' : 'margin-top';
                    $slide.parent().find('.lSPager').css(gMargin, settings.galleryMargin + 'px');
                    refresh.createPager();
                }

                setTimeout(function () {
                    refresh.init();
                }, 0);
            },
            setHeight: function (ob, fade) {
                var obj = null,
                    $this = this;
                if (settings.loop) {
                    obj = ob.children('.lslide ').first();
                } else {
                    obj = ob.children().first();
                }
                var setCss = function () {
                    var tH = obj.outerHeight(),
                        tP = 0,
                        tHT = tH;
                    if (fade) {
                        tH = 0;
                        tP = ((tHT) * 100) / elSize;
                    }
                    ob.css({
                        'height': tH + 'px',
                        'padding-bottom': tP + '%'
                    });
                };
                setCss();
                if (obj.find('img').length) {
                    if ( obj.find('img')[0].complete) {
                        setCss();
                        if (!interval) {
                            $this.auto();
                        }   
                    }else{
                        obj.find('img').on('load', function () {
                            setTimeout(function () {
                                setCss();
                                if (!interval) {
                                    $this.auto();
                                }
                            }, 100);
                        });
                    }
                }else{
                    if (!interval) {
                        $this.auto();
                    }
                }
            },
            active: function (ob, t) {
                if (this.doCss() && settings.mode === 'fade') {
                    $slide.addClass('on');
                }
                var sc = 0;
                if (scene * settings.slideMove < length) {
                    ob.removeClass('active');
                    if (!this.doCss() && settings.mode === 'fade' && t === false) {
                        ob.fadeOut(settings.speed);
                    }
                    if (t === true) {
                        sc = scene;
                    } else {
                        sc = scene * settings.slideMove;
                    }
                    //t === true ? sc = scene : sc = scene * settings.slideMove;
                    var l, nl;
                    if (t === true) {
                        l = ob.length;
                        nl = l - 1;
                        if (sc + 1 >= l) {
                            sc = nl;
                        }
                    }
                    if (settings.loop === true && settings.mode === 'slide') {
                        //t === true ? sc = scene - $el.find('.clone.left').length : sc = scene * settings.slideMove;
                        if (t === true) {
                            sc = scene - $el.find('.clone.left').length;
                        } else {
                            sc = scene * settings.slideMove;
                        }
                        if (t === true) {
                            l = ob.length;
                            nl = l - 1;
                            if (sc + 1 === l) {
                                sc = nl;
                            } else if (sc + 1 > l) {
                                sc = 0;
                            }
                        }
                    }

                    if (!this.doCss() && settings.mode === 'fade' && t === false) {
                        ob.eq(sc).fadeIn(settings.speed);
                    }
                    ob.eq(sc).addClass('active');
                } else {
                    ob.removeClass('active');
                    ob.eq(ob.length - 1).addClass('active');
                    if (!this.doCss() && settings.mode === 'fade' && t === false) {
                        ob.fadeOut(settings.speed);
                        ob.eq(sc).fadeIn(settings.speed);
                    }
                }
            },
            move: function (ob, v) {
                if (settings.rtl === true) {
                    v = -v;
                }
                if (this.doCss()) {
                    if (settings.vertical === true) {
                        ob.css({
                            'transform': 'translate3d(0px, ' + (-v) + 'px, 0px)',
                            '-webkit-transform': 'translate3d(0px, ' + (-v) + 'px, 0px)'
                        });
                    } else {
                        ob.css({
                            'transform': 'translate3d(' + (-v) + 'px, 0px, 0px)',
                            '-webkit-transform': 'translate3d(' + (-v) + 'px, 0px, 0px)',
                        });
                    }
                } else {
                    if (settings.vertical === true) {
                        ob.css('position', 'relative').animate({
                            top: -v + 'px'
                        }, settings.speed, settings.easing);
                    } else {
                        ob.css('position', 'relative').animate({
                            left: -v + 'px'
                        }, settings.speed, settings.easing);
                    }
                }
                var $thumb = $slide.parent().find('.lSPager').find('li');
                this.active($thumb, true);
            },
            fade: function () {
                this.active($children, false);
                var $thumb = $slide.parent().find('.lSPager').find('li');
                this.active($thumb, true);
            },
            slide: function () {
                var $this = this;
                refresh.calSlide = function () {
                    if (w > elSize) {
                        slideValue = $this.slideValue();
                        $this.active($children, false);
                        if ((slideValue) > w - elSize - settings.slideMargin) {
                            slideValue = w - elSize - settings.slideMargin;
                        } else if (slideValue < 0) {
                            slideValue = 0;
                        }
                        $this.move($el, slideValue);
                        if (settings.loop === true && settings.mode === 'slide') {
                            if (scene >= (length - ($el.find('.clone.left').length / settings.slideMove))) {
                                $this.resetSlide($el.find('.clone.left').length);
                            }
                            if (scene === 0) {
                                $this.resetSlide($slide.find('.lslide').length);
                            }
                        }
                    }
                };
                refresh.calSlide();
            },
            resetSlide: function (s) {
                var $this = this;
                $slide.find('.lSAction a').addClass('disabled');
                setTimeout(function () {
                    scene = s;
                    $slide.css('transition-duration', '0ms');
                    slideValue = $this.slideValue();
                    $this.active($children, false);
                    plugin.move($el, slideValue);
                    setTimeout(function () {
                        $slide.css('transition-duration', settings.speed + 'ms');
                        $slide.find('.lSAction a').removeClass('disabled');
                    }, 50);
                }, settings.speed + 100);
            },
            slideValue: function () {
                var _sV = 0;
                if (settings.autoWidth === false) {
                    _sV = scene * ((slideWidth + settings.slideMargin) * settings.slideMove);
                } else {
                    _sV = 0;
                    for (var i = 0; i < scene; i++) {
                        _sV += (parseInt($children.eq(i).width()) + settings.slideMargin);
                    }
                }
                return _sV;
            },
            slideThumb: function () {
                var position;
                switch (settings.currentPagerPosition) {
                case 'left':
                    position = 0;
                    break;
                case 'middle':
                    position = (elSize / 2) - (thumbWidth / 2);
                    break;
                case 'right':
                    position = elSize - thumbWidth;
                }
                var sc = scene - $el.find('.clone.left').length;
                var $pager = $slide.parent().find('.lSPager');
                if (settings.mode === 'slide' && settings.loop === true) {
                    if (sc >= $pager.children().length) {
                        sc = 0;
                    } else if (sc < 0) {
                        sc = $pager.children().length;
                    }
                }
                var thumbSlide = sc * ((thumbWidth + settings.thumbMargin)) - (position);
                if ((thumbSlide + elSize) > pagerWidth) {
                    thumbSlide = pagerWidth - elSize - settings.thumbMargin;
                }
                if (thumbSlide < 0) {
                    thumbSlide = 0;
                }
                this.move($pager, thumbSlide);
            },
            auto: function () {
                if (settings.auto) {
                    clearInterval(interval);
                    interval = setInterval(function () {
                        $el.goToNextSlide();
                    }, settings.pause);
                }
            },
            pauseOnHover: function(){
                var $this = this;
                if (settings.auto && settings.pauseOnHover) {
                    $slide.on('mouseenter', function(){
                        $(this).addClass('ls-hover');
                        $el.pause();
                        settings.auto = true;
                    });
                    $slide.on('mouseleave',function(){
                        $(this).removeClass('ls-hover');
                        if (!$slide.find('.lightSlider').hasClass('lsGrabbing')) {
                            $this.auto();
                        }
                    });
                }
            },
            touchMove: function (endCoords, startCoords) {
                $slide.css('transition-duration', '0ms');
                if (settings.mode === 'slide') {
                    var distance = endCoords - startCoords;
                    var swipeVal = slideValue - distance;
                    if ((swipeVal) >= w - elSize - settings.slideMargin) {
                        if (settings.freeMove === false) {
                            swipeVal = w - elSize - settings.slideMargin;
                        } else {
                            var swipeValT = w - elSize - settings.slideMargin;
                            swipeVal = swipeValT + ((swipeVal - swipeValT) / 5);

                        }
                    } else if (swipeVal < 0) {
                        if (settings.freeMove === false) {
                            swipeVal = 0;
                        } else {
                            swipeVal = swipeVal / 5;
                        }
                    }
                    this.move($el, swipeVal);
                }
            },

            touchEnd: function (distance) {
                $slide.css('transition-duration', settings.speed + 'ms');
                if (settings.mode === 'slide') {
                    var mxVal = false;
                    var _next = true;
                    slideValue = slideValue - distance;
                    if ((slideValue) > w - elSize - settings.slideMargin) {
                        slideValue = w - elSize - settings.slideMargin;
                        if (settings.autoWidth === false) {
                            mxVal = true;
                        }
                    } else if (slideValue < 0) {
                        slideValue = 0;
                    }
                    var gC = function (next) {
                        var ad = 0;
                        if (!mxVal) {
                            if (next) {
                                ad = 1;
                            }
                        }
                        if (!settings.autoWidth) {
                            var num = slideValue / ((slideWidth + settings.slideMargin) * settings.slideMove);
                            scene = parseInt(num) + ad;
                            if (slideValue >= (w - elSize - settings.slideMargin)) {
                                if (num % 1 !== 0) {
                                    scene++;
                                }
                            }
                        } else {
                            var tW = 0;
                            for (var i = 0; i < $children.length; i++) {
                                tW += (parseInt($children.eq(i).width()) + settings.slideMargin);
                                scene = i + ad;
                                if (tW >= slideValue) {
                                    break;
                                }
                            }
                        }
                    };
                    if (distance >= settings.swipeThreshold) {
                        gC(false);
                        _next = false;
                    } else if (distance <= -settings.swipeThreshold) {
                        gC(true);
                        _next = false;
                    }
                    $el.mode(_next);
                    this.slideThumb();
                } else {
                    if (distance >= settings.swipeThreshold) {
                        $el.goToPrevSlide();
                    } else if (distance <= -settings.swipeThreshold) {
                        $el.goToNextSlide();
                    }
                }
            },



            enableDrag: function () {
                var $this = this;
                if (!isTouch) {
                    var startCoords = 0,
                        endCoords = 0,
                        isDraging = false;
                    $slide.find('.lightSlider').addClass('lsGrab');
                    $slide.on('mousedown', function (e) {
                        if (w < elSize) {
                            if (w !== 0) {
                                return false;
                            }
                        }
                        if ($(e.target).attr('class') !== ('lSPrev') && $(e.target).attr('class') !== ('lSNext')) {
                            startCoords = (settings.vertical === true) ? e.pageY : e.pageX;
                            isDraging = true;
                            if (e.preventDefault) {
                                e.preventDefault();
                            } else {
                                e.returnValue = false;
                            }
                            // ** Fix for webkit cursor issue https://code.google.com/p/chromium/issues/detail?id=26723
                            $slide.scrollLeft += 1;
                            $slide.scrollLeft -= 1;
                            // *
                            $slide.find('.lightSlider').removeClass('lsGrab').addClass('lsGrabbing');
                            clearInterval(interval);
                        }
                    });
                    $(window).on('mousemove', function (e) {
                        if (isDraging) {
                            endCoords = (settings.vertical === true) ? e.pageY : e.pageX;
                            $this.touchMove(endCoords, startCoords);
                        }
                    });
                    $(window).on('mouseup', function (e) {
                        if (isDraging) {
                            $slide.find('.lightSlider').removeClass('lsGrabbing').addClass('lsGrab');
                            isDraging = false;
                            endCoords = (settings.vertical === true) ? e.pageY : e.pageX;
                            var distance = endCoords - startCoords;
                            if (Math.abs(distance) >= settings.swipeThreshold) {
                                $(window).on('click.ls', function (e) {
                                    if (e.preventDefault) {
                                        e.preventDefault();
                                    } else {
                                        e.returnValue = false;
                                    }
                                    e.stopImmediatePropagation();
                                    e.stopPropagation();
                                    $(window).off('click.ls');
                                });
                            }

                            $this.touchEnd(distance);

                        }
                    });
                }
            },




            enableTouch: function () {
                var $this = this;
                if (isTouch) {
                    var startCoords = {},
                        endCoords = {};
                    $slide.on('touchstart', function (e) {
                        endCoords = e.originalEvent.targetTouches[0];
                        startCoords.pageX = e.originalEvent.targetTouches[0].pageX;
                        startCoords.pageY = e.originalEvent.targetTouches[0].pageY;
                        clearInterval(interval);
                    });
                    $slide.on('touchmove', function (e) {
                        if (w < elSize) {
                            if (w !== 0) {
                                return false;
                            }
                        }
                        var orig = e.originalEvent;
                        endCoords = orig.targetTouches[0];
                        var xMovement = Math.abs(endCoords.pageX - startCoords.pageX);
                        var yMovement = Math.abs(endCoords.pageY - startCoords.pageY);
                        if (settings.vertical === true) {
                            if ((yMovement * 3) > xMovement) {
                                e.preventDefault();
                            }
                            $this.touchMove(endCoords.pageY, startCoords.pageY);
                        } else {
                            if ((xMovement * 3) > yMovement) {
                                e.preventDefault();
                            }
                            $this.touchMove(endCoords.pageX, startCoords.pageX);
                        }

                    });
                    $slide.on('touchend', function () {
                        if (w < elSize) {
                            if (w !== 0) {
                                return false;
                            }
                        }
                        var distance;
                        if (settings.vertical === true) {
                            distance = endCoords.pageY - startCoords.pageY;
                        } else {
                            distance = endCoords.pageX - startCoords.pageX;
                        }
                        $this.touchEnd(distance);
                    });
                }
            },
            build: function () {
                var $this = this;
                $this.initialStyle();
                if (this.doCss()) {

                    if (settings.enableTouch === true) {
                        $this.enableTouch();
                    }
                    if (settings.enableDrag === true) {
                        $this.enableDrag();
                    }
                }

                $(window).on('focus', function(){
                    $this.auto();
                });
                
                $(window).on('blur', function(){
                    clearInterval(interval);
                });

                $this.pager();
                $this.pauseOnHover();
                $this.controls();
                $this.keyPress();
            }
        };
        plugin.build();
        refresh.init = function () {
            refresh.chbreakpoint();
            if (settings.vertical === true) {
                if (settings.item > 1) {
                    elSize = settings.verticalHeight;
                } else {
                    elSize = $children.outerHeight();
                }
                $slide.css('height', elSize + 'px');
            } else {
                elSize = $slide.outerWidth();
            }
            if (settings.loop === true && settings.mode === 'slide') {
                refresh.clone();
            }
            refresh.calL();
            if (settings.mode === 'slide') {
                $el.removeClass('lSSlide');
            }
            if (settings.mode === 'slide') {
                refresh.calSW();
                refresh.sSW();
            }
            setTimeout(function () {
                if (settings.mode === 'slide') {
                    $el.addClass('lSSlide');
                }
            }, 1000);
            if (settings.pager) {
                refresh.createPager();
            }
            if (settings.adaptiveHeight === true && settings.vertical === false) {
                $el.css('height', $children.eq(scene).outerHeight(true));
            }
            if (settings.adaptiveHeight === false) {
                if (settings.mode === 'slide') {
                    if (settings.vertical === false) {
                        plugin.setHeight($el, false);
                    }else{
                        plugin.auto();
                    }
                } else {
                    plugin.setHeight($el, true);
                }
            }
            if (settings.gallery === true) {
                plugin.slideThumb();
            }
            if (settings.mode === 'slide') {
                plugin.slide();
            }
            if (settings.autoWidth === false) {
                if ($children.length <= settings.item) {
                    $slide.find('.lSAction').hide();
                } else {
                    $slide.find('.lSAction').show();
                }
            } else {
                if ((refresh.calWidth(false) < elSize) && (w !== 0)) {
                    $slide.find('.lSAction').hide();
                } else {
                    $slide.find('.lSAction').show();
                }
            }
        };
        $el.goToPrevSlide = function () {
            if (scene > 0) {
                settings.onBeforePrevSlide.call(this, $el, scene);
                scene--;
                $el.mode(false);
                if (settings.gallery === true) {
                    plugin.slideThumb();
                }
            } else {
                if (settings.loop === true) {
                    settings.onBeforePrevSlide.call(this, $el, scene);
                    if (settings.mode === 'fade') {
                        var l = (length - 1);
                        scene = parseInt(l / settings.slideMove);
                    }
                    $el.mode(false);
                    if (settings.gallery === true) {
                        plugin.slideThumb();
                    }
                } else if (settings.slideEndAnimation === true) {
                    $el.addClass('leftEnd');
                    setTimeout(function () {
                        $el.removeClass('leftEnd');
                    }, 400);
                }
            }
        };
        $el.goToNextSlide = function () {
            var nextI = true;
            if (settings.mode === 'slide') {
                var _slideValue = plugin.slideValue();
                nextI = _slideValue < w - elSize - settings.slideMargin;
            }
            if (((scene * settings.slideMove) < length - settings.slideMove) && nextI) {
                settings.onBeforeNextSlide.call(this, $el, scene);
                scene++;
                $el.mode(false);
                if (settings.gallery === true) {
                    plugin.slideThumb();
                }
            } else {
                if (settings.loop === true) {
                    settings.onBeforeNextSlide.call(this, $el, scene);
                    scene = 0;
                    $el.mode(false);
                    if (settings.gallery === true) {
                        plugin.slideThumb();
                    }
                } else if (settings.slideEndAnimation === true) {
                    $el.addClass('rightEnd');
                    setTimeout(function () {
                        $el.removeClass('rightEnd');
                    }, 400);
                }
            }
        };
        $el.mode = function (_touch) {
            if (settings.adaptiveHeight === true && settings.vertical === false) {
                $el.css('height', $children.eq(scene).outerHeight(true));
            }
            if (on === false) {
                if (settings.mode === 'slide') {
                    if (plugin.doCss()) {
                        $el.addClass('lSSlide');
                        if (settings.speed !== '') {
                            $slide.css('transition-duration', settings.speed + 'ms');
                        }
                        if (settings.cssEasing !== '') {
                            $slide.css('transition-timing-function', settings.cssEasing);
                        }
                    }
                } else {
                    if (plugin.doCss()) {
                        if (settings.speed !== '') {
                            $el.css('transition-duration', settings.speed + 'ms');
                        }
                        if (settings.cssEasing !== '') {
                            $el.css('transition-timing-function', settings.cssEasing);
                        }
                    }
                }
            }
            if (!_touch) {
                settings.onBeforeSlide.call(this, $el, scene);
            }
            if (settings.mode === 'slide') {
                plugin.slide();
            } else {
                plugin.fade();
            }
            if (!$slide.hasClass('ls-hover')) {
                plugin.auto();
            }
            setTimeout(function () {
                if (!_touch) {
                    settings.onAfterSlide.call(this, $el, scene);
                }
            }, settings.speed);
            on = true;
        };
        $el.play = function () {
            $el.goToNextSlide();
            settings.auto = true;
            plugin.auto();
        };
        $el.pause = function () {
            settings.auto = false;
            clearInterval(interval);
        };
        $el.refresh = function () {
            refresh.init();
        };
        $el.getCurrentSlideCount = function () {
            var sc = scene;
            if (settings.loop) {
                var ln = $slide.find('.lslide').length,
                    cl = $el.find('.clone.left').length;
                if (scene <= cl - 1) {
                    sc = ln + (scene - cl);
                } else if (scene >= (ln + cl)) {
                    sc = scene - ln - cl;
                } else {
                    sc = scene - cl;
                }
            }
            return sc + 1;
        }; 
        $el.getTotalSlideCount = function () {
            return $slide.find('.lslide').length;
        };
        $el.goToSlide = function (s) {
            if (settings.loop) {
                scene = (s + $el.find('.clone.left').length - 1);
            } else {
                scene = s;
            }
            $el.mode(false);
            if (settings.gallery === true) {
                plugin.slideThumb();
            }
        };
        $el.destroy = function () {
            if ($el.lightSlider) {
                $el.goToPrevSlide = function(){};
                $el.goToNextSlide = function(){};
                $el.mode = function(){};
                $el.play = function(){};
                $el.pause = function(){};
                $el.refresh = function(){};
                $el.getCurrentSlideCount = function(){};
                $el.getTotalSlideCount = function(){};
                $el.goToSlide = function(){}; 
                $el.lightSlider = null;
                refresh = {
                    init : function(){}
                };
                $el.parent().parent().find('.lSAction, .lSPager').remove();
                $el.removeClass('lightSlider lSFade lSSlide lsGrab lsGrabbing leftEnd right').removeAttr('style').unwrap().unwrap();
                $el.children().removeAttr('style');
                $children.removeClass('lslide active');
                $el.find('.clone').remove();
                $children = null;
                interval = null;
                on = false;
                scene = 0;
            }

        };
        setTimeout(function () {
            settings.onSliderLoad.call(this, $el);
        }, 10);
        $(window).on('resize orientationchange', function (e) {
            setTimeout(function () {
                if (e.preventDefault) {
                    e.preventDefault();
                } else {
                    e.returnValue = false;
                }
                refresh.init();
            }, 200);
        });
        return this;
    };
}(jQuery));

/*
  *  $.SV_MegaBox v3.5.1
  *  Libraly Jquery 1.8.3+
  *  Developer Sergey Vorobyev
  *  E-mail workbiznet@gmail.com
  *  (ed.3.5.2)
  *  (ed.3.5.3)
  */

;(function($){

  /* включаем режим use strict */
  'use strict';

  $.SV_MegaBox = function(newSetting){
     var setting = _Settings(newSetting);
     _PreloaderCreate();
     _MaskCreate();
     _MaskStyle(setting);
     if(!$('.'+prv.classes.imgTmp).length)
        $('body').append('<div class="'+prv.classes.imgTmp+'"/>');
  };

  /* объявляем публичные опции по умолчанию */
  $.SV_MegaBox.defaults = {

        preloader                  :true,
        /* mode mask */
        showMask                   :true,
        clickCloseMask             :true,
        /* mode mask (end)*/

        /* css mask */
        newStyleMask               :false,
        bgColorMask                :'#000',
        opacityMask                :0.7,
        zIndexMask                 :999,
    positionMask               :'fixed',
        addCssMask                 :{},
        /* css mask (end) */

        /* css box */
        styleClass                 :'',
        addClasses                 :'',
        width                      :'',
        height                     :'',
        align                      :'',
        background                 :'',
        font                       :'',
        color                      :'',
        padding                    :'',
        radius                     :'',
        top                        :'',
        bottom                     :'',
        left                       :'',
        right                      :'',
        zIndexBox                  :1000,
        offsetPositionValTop       :20,
        offsetPositionValBottom    :20,
        offsetPositionValLeft      :20,
        offsetPositionValRight     :20,
        cssPosition                :'fixed',
        addCssBox                  :{},
        /* css box (end)*/

        /* mode box*/
        defaultStyle               :true,
        fixBody                    :true,
        fullSize                   :false,
        fullWidth                  :false,
        fullHeight                 :false,
        heightLimit                :true,
        typeBox                    :'',
        preClosed                  :false,
        modePosition               :'center',
        scale                      :true,
        unselect                   :true,
        ctrlEsc                    :true,
        topsheet                   :false,
        typeAjax                   :'POST',
        dataAjax                   :{},
        tooltip_tringle            :true,
        modificate                 :true,
        parent                     :false,
        parent_custom              :false,

        /* mode box (end)*/

        /* content */
        content                    :'',
        text                       :'',
        linkStyle                  :'',   /*dark or light*/
        /* content (end) */

        /* title */
        title                      :'',
        titleBg                    :'',
        titleColor                 :'',
        titleAlign                 :'',
        titleFont                  :'',
        titlePadding               :'',
        titleTransform             :'',
        /* title (end) */

        /* buttonText */
        buttonOkClose              :true,
        buttonNoClose              :true,
        buttonTextOk               :'Ок',
        buttonTextCancel           :'Отмена',
        buttonTextYes              :'Да',
        buttonTextNo               :'Нет',
        /* buttonText (end) */

        /* footer */
        footer:'',
        footerFunc                 :function(box,footer){},
        footerBg                   :'',
        footerColor                :'',
        footerAlign                :'',
        footerFont                 :'',
        footerPadding              :'',
        /* footer (end) */

        /* effects */
        effectShowMask             :'show',
        effectCloseMask            :'hide',
        effectShowBox              :'fadeIn',
        effectCloseBox             :'fadeOut',
        effectShowBoxPrev          :'animateShowRight',
        effectShowBoxNext          :'animateShowLeft',
        effectCloseBoxPrev         :'animateHideRight',
        effectCloseBoxNext         :'animateHideLeft',
        /* effect (end) */

        /* time effects */
        timeEffect                 :0,
        timeEffectShowMask         :null,
        timeEffectCloseMask        :null,
        timeEffectShowBox          :500,
        timeEffectCloseBox         :500,
        /* time effects (end) */

        /* closeLink */
        closeLink                  :true,
        closeLinkClass             :'close',
        closeLinkAddClass          :'',
        closeLinkTitle             :'Закрыть окно',
        /* closeLink (end) */

        /* image */
        counter_img                :false,
        minWidthImg                :100,
        minHeightImg               :100,
        counter_img_text           :'#CURRENT_INDEX# / #COUNT_IMAGE#',
        counter_img_position       :'top',
        title_img_prev             :'назад',
        title_img_next             :'вперед',
        keycode_prev               :37,
        keycode_next               :39,
        circular                   :true,
        /* image (end) */

        /* callback */
        onShowMask                 :function(){},
        onCloseMask                :function(){},
        onBeforeHtmlClick          :function(link,box){},
        onBeforeAjaxClick          :function(link,url){},
        onBeforeImageClick         :function(link,src){},
        onBefore                   :function(box){},
        onAfter                    :function(box){},
        onBoxClose                 :function(box){},
        onClosed                   :function(){},
        onUserOk                   :function(button){},
        onUserNo                   :function(button){},
        onAnswer                   :function(text){},
        onAjaxError                :function(data){},
        onAjaxSuccessBefore        :function(data){},
        onAjaxSuccessAfter         :function(data,box){}
        /* callback (end) */

  };


 /*
  * Приватные опции плагина
  * ************************
  */

  var prv = {};
  prv.effects = {};
  prv.classes = {};
  prv.attr = {};

  prv.classes.prefix = 'sv-';
  prv.classes.prefixIdBox = prv.classes.prefix+'box-id-';
  prv.classes.prefixIdMess = prv.classes.prefix+'message-id-';
  prv.classes.megabox = prv.classes.prefix + 'megabox';
  prv.classes.show = prv.classes.megabox + '-show';
  prv.classes.maskShow = prv.classes.megabox + '-mask-show';
  prv.classes.preloaderShow = prv.classes.megabox + '-preloader-show';
  prv.classes.hide = prv.classes.megabox + '-hide';
  prv.classes.wrap = prv.classes.megabox + '-wrap';
  prv.classes.header = prv.classes.megabox + '-header';
  prv.classes.content = prv.classes.megabox + '-content';
  prv.classes.footer = prv.classes.megabox + '-footer';
  prv.classes.link = prv.classes.megabox + '-link';
  prv.classes.linkClose = prv.classes.link + '-close';
  prv.classes.mask = prv.classes.megabox + '-mask';
  prv.classes.tringle = prv.classes.megabox + '-tringle';
  prv.classes.container = prv.classes.megabox + '-container';
  prv.classes.preloader = prv.classes.megabox + '-preloader';
  prv.classes.linkLoaded = prv.classes.megabox + '-link-loaded';
  prv.classes.bodyFix = prv.classes.megabox + '-body-fix';

  prv.classes.headerOn = 'header-on';
  prv.classes.headerOff = 'header-off';
  prv.classes.linkCloseOn = 'link-close-on';
  prv.classes.linkCloseOff = 'link-close-off';
  prv.classes.footerOn = 'footer-on';
  prv.classes.footerOff = 'footer-off';
  prv.classes.autoOn = 'auto-on';
  prv.classes.autoOff = 'auto-off';
  prv.classes.buttonOk = prv.classes.megabox+'-button-ok';
  prv.classes.buttonNo = prv.classes.megabox+'-button-no';

  prv.classes.alert = prv.classes.prefix+'alert';
  prv.classes.confirm = prv.classes.prefix+'confirm';
  prv.classes.prompt = prv.classes.prefix+'prompt';

  prv.classes.defaultStyle = 'default-style';
  prv.classes.tooltip = 'tooltip';
  prv.classes.img = prv.classes.megabox+'-img';
  prv.classes.imgBox = prv.classes.megabox+'-img-box';
  prv.classes.imgCounter = prv.classes.megabox+'-img-counter';
  prv.classes.imgTitle = prv.classes.megabox+'-img-title';
  prv.classes.imgDesc = prv.classes.megabox+'-img-desc';
  prv.classes.imgTmp = prv.classes.megabox+'-img-tmp';
  prv.classes.Prev = prv.classes.megabox+'-prev';
  prv.classes.Next = prv.classes.megabox+'-next';

  prv.errorText = 'Контент для вывода не найден!';

  prv.attr.content = 'data-content';
  prv.attr.dinamic = 'data-dinamic';
  prv.attr.title = 'data-title';
  prv.attr.desc = 'data-desc';
  prv.attr.type = 'data-type';
  prv.attr.modificate = 'data-modificate';
  prv.attr.power = 'data-power';
  prv.attr.group = 'data-group';

  prv.effects = {
    show:function(obj,time,callBack){
       obj.show(time,function(){callBack();});
    },
    hide:function(obj,time,callBack){
       obj.hide(time,function(){callBack();});
    },
    fadeIn:function(obj,time,callBack){
       obj.fadeIn(time,function(){callBack();});
    },
    fadeOut:function(obj,time,callBack){
       obj.fadeOut(time,function(){callBack();});
    },
    slideDown:function(obj,time,callBack){
       obj.slideDown(time,function(){callBack();});
    },
    slideUp:function(obj,time,callBack){
       obj.slideUp(time,function(){callBack();});
    },
    animateShowTop:function(obj,time,callBack){
        var topOrig = obj.css('top');
        obj.css('top','-100%').show().animate({top:topOrig},time,function(){callBack();});
    },
    animateHideTop:function(obj,time,callBack){
        var topOrig = obj.css('top');
        obj.animate({top:'-100%'},time,function(){callBack();$(this).hide().css('top',topOrig);});
    },
    animateShowBottom:function(obj,time,callBack){
        var topOrig = obj.css('top');
        obj.css('top','100%').show().animate({top:topOrig},time,function(){callBack();});
    },
    animateHideBottom:function(obj,time,callBack){
        var topOrig = obj.css('top');
        obj.animate({top:'100%'},time,function(){callBack();$(this).hide().css('top',topOrig);});
    },
    animateShowLeft:function(obj,time,callBack){
        var leftOrig = obj.css('left');
        obj.css('left','-100%').show().animate({left:leftOrig},time,function(){callBack();});
    },
    animateHideLeft:function(obj,time,callBack){
        var leftOrig = obj.css('left');
        obj.animate({left:'-100%'},time,function(){callBack();$(this).hide().css('left',leftOrig);});
    },
    animateShowLeftFade:function(obj,time,callBack){
        var leftOrig = obj.css('left'),opacityOrig = obj.css('opacity');
        obj.css({'left':'-100%','opacity':0}).show().animate({left:leftOrig,opacity:opacityOrig},time,function(){callBack();});
    },
    animateHideLeftFade:function(obj,time,callBack){
        var leftOrig = obj.css('left'),opacityOrig = obj.css('opacity');
        obj.animate({left:'-100%',opacity:0},time,function(){callBack();$(this).hide().css({'left':leftOrig,'opacity':opacityOrig});});
    },
    animateShowRight:function(obj,time,callBack){
        var leftOrig = obj.css('left');
        obj.css('left','100%').show().animate({left:leftOrig},time,function(){callBack();});
    },
    animateHideRight:function(obj,time,callBack){
        var leftOrig = obj.css('left');
        obj.animate({left:'100%'},time,function(){callBack();$(this).hide().css('left',leftOrig);});
    }
  };
  /*
   * Приватные методы плагина
   * ************************
   */

   /* метод определения актуальных настроек */
   var _Settings = function(newSetting){
     return (typeof newSetting === 'object' && !$.isEmptyObject(newSetting)) ? $.extend({},$.SV_MegaBox.defaults,newSetting) : $.SV_MegaBox.defaults;
   };

   /* метод создания прелоадера */
   var _PreloaderCreate = function(){
          if($('.'+prv.classes.preloader).length) return;
          $('body').append('<div class="' + prv.classes.preloader + '"></div>');
   };

   /* метод создания маски */
   var _MaskCreate = function(){
          if($('.'+prv.classes.mask).length) return;
          var mask = '<div class="' + prv.classes.mask + '"/>';
          $('body').append(mask);
          return mask;
   };

   /* метод стилизации маски */
   var _MaskStyle = function(newSetting){
          var setting = _Settings(newSetting);
          $('.'+prv.classes.mask).css({
              'background-color': setting.bgColorMask,
            'filter': 'alpha(opacity='+setting.opacityMask*100+')',
            '-moz-opacity': setting.opacityMask,
            'opacity': setting.opacityMask,
            'z-index': setting.zIndexMask,
            'position': setting.positionMask
          });
          if(!$.isEmptyObject(setting.addCssMask)){
             $('.'+prv.classes.mask).css(setting.addCssMask);
          }

   };

   /*метод для модификации контента для модального окна*/
   var _Modificate = function(element,newSetting,link){
            var setting = _Settings(newSetting),link = link || {};
            element.addClass(prv.classes.megabox);

            if(setting.modificate){
                element.wrapInner('<div class="'+prv.classes.wrap+'"/>');
                element.find('.'+prv.classes.wrap).wrapInner('<div class="'+prv.classes.content+'"/>');
                var title = '',footer = '';

                if(!$.isEmptyObject(link) && link.attr(prv.attr.title) && link.attr(prv.attr.title) != '') title = link.attr(prv.attr.title);
                else if(element.attr(prv.attr.title) && element.attr(prv.attr.title) != '') title = element.attr(prv.attr.title);
                else if(setting.title != '') title = setting.title;
                /*если есть title, то создаем заголовок модального окна*/
                if(title != ''){
                  element.find('.'+prv.classes.wrap).prepend('<div class="'+prv.classes.header+'"></div>');
                  element.find('.'+prv.classes.header).html('<span>'+title+'</span>');
                  element.addClass(prv.classes.headerOn);
                }else{
                  element.addClass(prv.classes.headerOff);
                }

                /*если есть footer,то создаем его*/
                if(setting.footer != '' ){
                  element.find('.'+prv.classes.wrap).append('<div class="'+prv.classes.footer+'">'+setting.footer+'</div>');
                  element.addClass(prv.classes.footerOn);
                  setting.footerFunc(element,element.find('.'+prv.classes.footer));
                }else{
                  element.addClass(prv.classes.footerOff);
                }


            }
            element.attr(prv.attr.modificate,'on');

            /*если опция включена, то создаем ссылку для закрытия модального окна и навешиваем обработчик на нее*/
            if(setting.closeLink || element.find('.'+prv.classes.linkClose).length){
                element.prepend('<div class="'+prv.classes.linkClose+'" title="'+setting.closeLinkTitle+'"></div>');
                if(setting.closeLinkAddClass != '') element.find('.'+prv.classes.linkClose).addClass(setting.closeLinkAddClass);
                element.addClass(prv.classes.linkCloseOn);
            }else{
              element.addClass(prv.classes.linkCloseOff);
            }
            if(element.find('.'+prv.classes.header).length){element.addClass(prv.classes.headerOn);}
            else{element.addClass(prv.classes.headerOff);}

            if(element.find('.'+prv.classes.footer).length){element.addClass(prv.classes.footerOn);}
            else{element.addClass(prv.classes.footerOff);}

            if(setting.modePosition == 'current-link' && setting.tooltip_tringle){
              element.addClass(prv.classes.tooltip);
              element.prepend('<div class="'+prv.classes.tringle+'"></div>');
            }



            /* возвращаем модифицированный megabox*/
            return element;
   };

   /* метод определения времени эффекта */
   var _TimeEffect = function(time,setting){
     return (time == null) ? setting.timeEffect : time;
   };

   /* метод для фиксации body */
   var _FixBody = function(val){
       $('body').addClass(prv.classes.bodyFix);
       $(window).scroll(function(){
         if(!$('body').hasClass(prv.classes.bodyFix)) return;
         $('html,body').scrollTop(val);
        });
   };

   /* метод вывода сообщений */
   var _MsgShow = function(msg,status){
        var status = status || false;
        if(!status) console.error('$.SV_MegaBox.Error - '+msg);
        if(status) console.info('$.SV_MegaBox.Warning - '+msg);
   };

   var _TypeContent = function(content_string) {
         var type = 'html';
         if(isString(content_string)){
           if(content_string.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)) type = 'image';
           if(content_string.match(/\.(swf)((\?|#).*)?$/i)) type = 'swf';
           if(content_string.match(/\.(html|php|phtml|tpl)((\?|#).*)?$/i)) type = 'ajax';
         }
         function isString(string) {
      return string && $.type(string) === "string";
     }
         return type;
   };


   /* метод определения типа контента и его вывода */
   var _getContentString = function(link,newSetting){
     var setting = _Settings(newSetting), content_string = '';
     if(link.is('a')) content_string = link.attr(prv.attr.content) || link.attr('href') || setting.content;
     else content_string = link.attr(prv.attr.content) || setting.content;
     return content_string;
   };

   /* метод стилизации модального окна */
   var _BoxStyle = function(element,newSetting,link){
        var setting = _Settings(newSetting),link = link || {};
        if(setting.defaultStyle) element.addClass(prv.classes.defaultStyle);
        if(setting.styleClass){element.addClass(setting.styleClass);}
        if(!$.isEmptyObject(setting.addCssBox)){element.css(setting.addCssBox);}
        if(setting.typeBox){ element.addClass(setting.typeBox);}
        if(setting.addClasses){ element.addClass(setting.addClasses);}
        if(setting.width){element.css({'width':setting.width+'px'});}
        if(setting.height){element.css({'height':setting.height+'px'});}
        if(setting.background){element.find('.'+prv.classes.wrap).css({'background':setting.background});}
        if(setting.radius){element.find('.'+prv.classes.wrap).css({'border-radius':setting.radius});}
        if(setting.align){element.find('.'+prv.classes.content).css({'text-align':setting.align});}
        if(setting.padding){element.find('.'+prv.classes.content).css({'padding':setting.padding});}
        if(setting.color){element.find('.'+prv.classes.content).css({'color':setting.color});}
        if(setting.font){element.find('.'+prv.classes.content).css({'font':setting.font});}
        if(setting.linkStyle){element.find('.'+prv.classes.content).addClass('link-'+setting.linkStyle);}

        if((!$.isEmptyObject(link) && link.attr(prv.attr.title) && link.attr(prv.attr.title) != '') || (element.attr(prv.attr.title) && element.attr(prv.attr.title) != '') || setting.title){
            if(setting.titleFont){element.find('.'+prv.classes.header).css({'font':setting.titleFont});}
            if(setting.titleTransform){element.find('.'+prv.classes.header).css({'text-transform':setting.titleTransform});}
            if(setting.titleAlign){element.find('.'+prv.classes.header).css({'text-align':setting.titleAlign});}
            if(setting.titleColor){element.find('.'+prv.classes.header).css({'color':setting.titleColor});}
            if(setting.titlePadding){element.find('.'+prv.classes.header).find('>span').css({'padding':setting.titlePadding});}
            if(setting.titleBg){
              element.find('.'+prv.classes.header).css({'background':setting.titleBg});
              if(setting.modePosition == 'current-link')
              element.find('.'+prv.classes.tringle).css({'border-color':'transparent transparent '+setting.titleBg+' transparent'});
            }
        }
        if(setting.footer){
            if(setting.footerFont){element.find('.'+prv.classes.footer).css({'font':setting.footerFont});}
            if(setting.footerAlign){element.find('.'+prv.classes.footer).css({'text-align':setting.footerAlign});}
            if(setting.footerColor){element.find('.'+prv.classes.footer).css({'color':setting.footerColor});}
            if(setting.footerPadding){element.find('.'+prv.classes.footer).css({'padding':setting.footerPadding});}
            if(setting.footerBg){element.find('.'+prv.classes.footer).css({'background':setting.footerBg});}
        }
        var cssPosition = setting.cssPosition;
        element.css({'z-index': setting.zIndexBox,'position':setting.cssPosition});
   };

   /*метод для расчета размера */
   var _BoxSizer = function(element,newSetting,link){
            var setting = _Settings(newSetting),link = link || {};
            var WinWidth = $(window).width(),WinHeight = $(window).height(),titleH = 0,
            footerH = 0,modHeight = element.height(),modWidth = element.width(),
            modContentHeight = modHeight,maxHcontent,
            maxH = WinHeight-setting.offsetPositionValTop - setting.offsetPositionValBottom,
            maxW = WinWidth-setting.offsetPositionValLeft - setting.offsetPositionValRight;

            if((!$.isEmptyObject(link) && link.attr(prv.attr.title) && link.attr(prv.attr.title) != '') || (element.attr(prv.attr.title) && element.attr(prv.attr.title) != '') || setting.title || element.find('.'+prv.classes.header).length){
                element.find('.'+prv.classes.header).css({'height':'auto'});
                titleH = parseInt(element.find('.'+prv.classes.header).outerHeight());
                element.find('.'+prv.classes.header).css({
                    'height':titleH + 'px'
                });
            }
            if(setting.footer != '' || element.find('.'+prv.classes.footer).length){
                  element.find('.'+prv.classes.footer).css({'height':'auto'});
                  footerH = parseInt(element.find('.'+prv.classes.footer).outerHeight());
                  element.find('.'+prv.classes.footer).css({
                      'height':footerH + 'px'
                  });
            }
            if(setting.fullSize){
                  element.css({'width':maxW+'px','height':maxH+'px'});
                  modHeight = maxH; modWidth = maxW;
            }else if(setting.fullWidth){
                  element.css({'width':maxW+'px'});
                  modWidth = maxW;
            }else if(setting.fullHeight){
                  element.css({'height':maxH+'px'});
                  modHeight = maxH;
            }
            modContentHeight = parseInt(modHeight-(titleH+footerH));
            maxHcontent = parseInt(maxH-(titleH+footerH));

            /* если размера окна не хватает для вывода контента */
            if((modHeight > maxH) || (modWidth > maxW)){
                element.removeClass(prv.classes.autoOff);
                element.addClass(prv.classes.autoOn);
                if(modHeight > maxH && setting.heightLimit) {
                  modHeight = maxH;
                  modContentHeight = maxHcontent;
                }
                if(!setting.heightLimit) element.css({'top':$(window).scrollTop()+'px'});
                if(modWidth > maxW) modWidth = maxW;
            }else{
                element.removeClass(prv.classes.autoOn);
                element.addClass(prv.classes.autoOff);
            }

            element.css({'width':modWidth+'px','height':modHeight+'px'});
            if(setting.heightLimit){
               element.find('.'+prv.classes.wrap).css({'height':modHeight+'px'});
               element.find('.'+prv.classes.content).css({'height':modContentHeight+'px'});
            }
           
            if(setting.fullSize || setting.fullWidth || setting.fullHeight){
                  element.removeClass(prv.classes.autoOff);
                  element.addClass(prv.classes.autoOn);
            }
            return {
               width_window:WinWidth,
               height_window:WinHeight,
               height_title:titleH,
               height_footer:footerH,
               height_modal:modHeight,
               width_modal:modWidth,
               height_modal_content:modContentHeight,
               max_height_modal_content:maxHcontent,
               max_height_modal:maxH,
               max_width_modal:maxW
            };
   };
   /*метод - позиционирования */
   var _BoxPosition = function(element,newSetting,link){
            var setting = _Settings(newSetting),link = link || {};

            var WinWidth = $(window).width(),WinHeight = $(window).height(),
            modHeight = element.height(),modWidth = element.width(),topOrig = element.css('top'),
            scroll = element.hasClass(prv.classes.autoOn);
        var modTop = (WinHeight - modHeight)/2,modLeft = (WinWidth - modWidth)/2;
            if(!setting.heightLimit) modTop += $(window).scrollTop();
            var userPosition = setting.modePosition;
            switch (userPosition) {
                case 'center':
                    element.css({'top':modTop + 'px','left':modLeft + 'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'top':'50%',
                              'left':'50%',
                              'margin-top':'-'+$('.'+prv.classes.preloader).height()/2 +'px',
                              'margin-left':'-'+$('.'+prv.classes.preloader).width()/2 +'px'
                            });
                    }
                    break;
                case 'current-link':
                    /*высота модальной ссылки*/
                    if($.isEmptyObject(link)){
                       $.SV_MegaBox.Closed(setting,element);
                       _MsgShow('Не передана ссылка для позиционирования');
                       return;
                    }
                var modLinkHeight = link.outerHeight(),
                        modLinkWidth = link.outerWidth(),
                        modOffTop = (setting.parent_custom) ? link.position().top : link.offset().top,
                        modOffLeft = (setting.parent_custom) ? link.position().left : link.offset().left,
                        modOffRight = parseInt(WinWidth - (modOffLeft + modLinkWidth)),
                        modTop = parseInt(modOffTop + modLinkHeight);
                    /* ширина видимой области по горизонтали */
                    var rangeVisible = parseInt(WinWidth - modOffLeft);
                    element.removeClass('left');
                    element.removeClass('right');

                    if(rangeVisible < modWidth){
                         element.css({
                           'position':'absolute',
                           'top':modTop + 'px',
                           'right':modOffRight + 'px',
                           'z-index': setting.zIndexBox
                         });
                         element.addClass('right');
                         if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'position':'absolute',
                              'margin':0,
                              'top':modTop + 'px',
                              'right':modOffRight + 'px'
                            });
                         }
                    }else{
                        element.css({
                          'position':'absolute',
                          'top':modTop + 'px',
                          'left':modOffLeft + 'px',
                          'z-index': setting.zIndexBox
                        });
                        element.addClass('left');
                        if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'position':'absolute',
                              'margin':0,
                              'top':modTop + 'px',
                              'left':modOffLeft + 'px'
                            });
                         }
                    }
                    break;
                case 'top middle':
                    element.css({'top':setting.offsetPositionValTop+'px','left':modLeft});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'top':setting.offsetPositionValTop+'px',
                              'left':modLeft
                            });
                         }
                    break;
                case 'top left':
                    element.css({'top':setting.offsetPositionValTop+'px','left':setting.offsetPositionValLeft+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'top':setting.offsetPositionValTop+'px',
                              'left':setting.offsetPositionValLeft+'px'
                            });
                    }
                    break;
                case 'top right':
                    element.css({'top':setting.offsetPositionValTop+'px','right':setting.offsetPositionValRight+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'top':setting.offsetPositionValTop+'px',
                              'right':setting.offsetPositionValRight+'px'
                            });
                    }
                    break;
                case 'middle left':
                    element.css({'left':setting.offsetPositionValLeft+'px','top':modTop+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'left':setting.offsetPositionValLeft+'px',
                              'top':modTop+'px'
                            });
                    }
                    break;
                case 'middle right':
                    element.css({'top':modTop+'px','right':setting.offsetPositionValRight+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'top':modTop+'px',
                              'right':setting.offsetPositionValRight+'px'
                            });
                    }
                    break;
                case 'bottom middle':
                    element.css({'bottom':setting.offsetPositionValBottom+'px','left':modLeft+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'bottom':setting.offsetPositionValBottom+'px',
                              'left':modLeft+'px'
                            });
                    }
                    break;
                case 'bottom left':
                    element.css({'bottom':setting.offsetPositionValBottom+'px','left':setting.offsetPositionValLeft+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'bottom':setting.offsetPositionValBottom+'px',
                              'left':setting.offsetPositionValLeft+'px'
                            });
                    }
                    break;
                case 'bottom right':
                    element.css({'bottom':setting.offsetPositionValBottom+'px','right':setting.offsetPositionValRight+'px'});
                    if(setting.preloader){
                            $('.'+prv.classes.preloader).css({
                              'margin':0,
                              'bottom':setting.offsetPositionValBottom+'px',
                              'right':setting.offsetPositionValRight+'px'
                            });
                    }
                    break;
           }
           if(setting.top) element.css({top:setting.top});
           if(setting.bottom) element.css({bottom:setting.bottom});
           if(setting.left) element.css({left:setting.left});
           if(setting.right) element.css({right:setting.right});
           if(scroll && !setting.heightLimit) {
             element.css({top:topOrig});
             element.removeClass(prv.classes.autoOn);
           }

   };

   /* метод реализации эффекта */
   var _Effect = function(obj,effect,time,callBack){
          prv.effects[effect](obj,time,callBack);
   };

    /* метод определения показано ли хоть одно модальное окно  */
   var _isShowBox = function(){
     return $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]').length;
   };
   /* метод определения новых z-index для верхнего слоя */
   var _TopSheetZIndex = function(){
          var zIndexBox = parseInt($('.'+prv.classes.megabox+'['+prv.attr.power+'=on]').css('z-index'));
          var zIndexMask = parseInt($('.'+prv.classes.mask).css('z-index'));
          var zIndexPreloader = parseInt($('.'+prv.classes.preloader).css('z-index'));

          var neWzIndexMask = zIndexBox + 1;
          var neWzIndexBox = neWzIndexMask + 1;
          var neWzIndexPreloader = neWzIndexMask + 1;
          return {
                oldIn:{box:zIndexBox,mask:zIndexMask,preloader:zIndexPreloader},
                newIn:{box:neWzIndexBox,mask:neWzIndexMask,preloader:neWzIndexPreloader}
          };
   };

   /* метод закрытия закрытия маски, модального окна и прелоадера */
   var _PreClosed = function(){
        var box = $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]');
        var mask = $('.'+prv.classes.mask);
        var preloader = $('.'+prv.classes.preloader);
        if(box.length){
           if(box.attr(prv.attr.dinamic) == 'on') {
                    box.remove();
           }else{
              $.SV_MegaBox.DestructBox(box);
           }
        }
        if(mask.length){
          mask.hide();
          mask.removeClass(prv.classes.maskShow);
        }
        if(preloader.length){preloader.hide();}
        $(document).unbind('keydown.sv_img');
   };

   /* метод для сброса стилей размера megabox */
   var _ModReset = function(box,widthReset){
      var widthReset = widthReset || false;
      if(widthReset){
        box.css({'width':'auto','height':'auto'});
      }else{
        box.css({'height':'auto'});
      }

      box.removeClass(prv.classes.autoOn);
      box.find('.'+prv.classes.wrap).css({'height':'auto'});
      box.find('.'+prv.classes.header).css({'height':'auto'});
      box.find('.'+prv.classes.content).css({'height':'auto'});
      box.find('.'+prv.classes.footer).css({'height':'auto'});
   };
   /* метод для масштабирования megabox */
   var _Scale = function(box,setting,link,widthReset){
      _ModReset(box,widthReset);
      _BoxSizer(box,setting,link);
      _BoxPosition(box,setting,link);

   };

   /* метод для создания динамического бокса */
   var _CreateBox = function(prefixId,container,newSetting){
     var setting = _Settings(newSetting), id = prefixId+'1',prefixIdLength = prefixId.length, colsMod = $('.'+container).length;
     if(colsMod){
           var id_old = $('.'+container).eq(colsMod-1).attr('id');
           var id_old_num = parseInt(id_old.substr(prefixIdLength)) + 1;
           id = prefixId+id_old_num;
     }
     var parent = setting.parent || $('body');

     parent.append('<div id="'+id+'" class="'+container+' '+prv.classes.hide+'" '+prv.attr.dinamic+'="on"></div>');
     return $('#'+id);
  };

  /*
   * Публичные методы плагина
   * ************************
   */

  /* метод показа прелоадера */
  $.SV_MegaBox.PreloaderShow = function(newSetting){
          var setting = _Settings(newSetting);
          if($('.'+prv.classes.preloader).hasClass(prv.classes.preloaderShow))
            return $('.'+prv.classes.preloader);
          if(!$('.'+prv.classes.preloader).length) _PreloaderCreate();
          if(setting.preloader) {
            $('.'+prv.classes.preloader).addClass(prv.classes.preloaderShow);
            $('.'+prv.classes.preloader).show();
          }
          return $('.'+prv.classes.preloader);
  };

  /* метод добавления эффекта */
  $.SV_MegaBox.AddEffect = function(effectsObj){
       for(var key in effectsObj){
          if(!prv.effects.hasOwnProperty(key)){
             prv.effects[key] = effectsObj[key];
          }else{
            console.error('$.SV_MegaBox.Error - эффект с названием - "'+key+'" уже существует');
          }
       }

  };

  /* метод скрытия прелоадера */
  $.SV_MegaBox.PreloaderClose = function(newSetting){
          var setting = _Settings(newSetting);
          if(!$('.'+prv.classes.preloader).length) return;
          if(setting.preloader) {
            $('.'+prv.classes.preloader).removeClass(prv.classes.preloaderShow);
            $('.'+prv.classes.preloader).hide();
          }
  };

  /* метод для показа маски */
  $.SV_MegaBox.MaskShow = function(newSetting){
      var setting = _Settings(newSetting);
      if(!setting.showMask || $('.'+prv.classes.mask).hasClass(prv.classes.maskShow)) return $('.'+prv.classes.mask);

      if(!$('.'+prv.classes.mask).length){
        _MaskCreate();
        _MaskStyle(setting);
      }
      /* стилизуем маску */
      if(setting.newStyleMask){
         _MaskStyle(setting);
      }
      $('.'+prv.classes.mask).addClass(prv.classes.maskShow);
      _Effect(
          $('.'+prv.classes.mask),
          setting.effectShowMask,
          _TimeEffect(setting.timeEffectShowMask,setting),
          setting.onShowMask
      );
      if(setting.clickCloseMask){
          $('.'+prv.classes.mask).on('click.sv',function() {
            $.SV_MegaBox.Closed(setting);
          });
      }
      return $('.'+prv.classes.mask);

  };

  /* метод для скрытия маски */
  $.SV_MegaBox.MaskClose = function(newSetting){
      var setting = _Settings(newSetting);
      /*скрываем маску в зависимости от эффекта*/
      _Effect(
            $('.'+prv.classes.mask),
            setting.effectCloseMask,
            _TimeEffect(setting.timeEffectCloseMask,setting),
            function(){
              setting.onCloseMask();
              $('.'+prv.classes.mask).removeClass(prv.classes.maskShow);
            }

      );
      if(setting.clickCloseMask) $('.'+prv.classes.mask).unbind('click.sv');
  };

  /* метод для показа модального окна */
  $.SV_MegaBox.Show = function(box,newSetting,link){
      var setting = _Settings(newSetting),preloader,mask,ZIndex={};
      if(setting.preClosed && !setting.topsheet) { _PreClosed();}
      if(_isShowBox() && setting.topsheet){
        ZIndex = _TopSheetZIndex();
      }
      preloader = $.SV_MegaBox.PreloaderShow(setting);
      mask = $.SV_MegaBox.MaskShow(setting);


      var link = link || {};

      if(box.attr(prv.attr.modificate) != 'on') { _Modificate(box,setting,link);}

      setting.onBefore(box);

      if(setting.unselect) box.find('.'+prv.classes.header).attr('unselectable', 'on').css('user-select', 'none');

      /* стилизуем megabox */
      _BoxStyle(box,setting,link);

      /* фиксируем body */
      if(setting.fixBody && setting.modePosition != 'current-link'){_FixBody($(window).scrollTop());}

      _BoxSizer(box,setting,link);

      /* позиционируем megabox */
      _BoxPosition(box,setting,link);

      if(!$.isEmptyObject(ZIndex)){
        box.css('z-index',ZIndex.newIn.box);
        mask.css('z-index',ZIndex.newIn.mask);
        preloader.css('z-index',ZIndex.newIn.preloader);
        $('.'+prv.classes.mask).unbind('click.sv');
      }
      if(setting.closeLink){
        /*навешиваем событие на ссылку для закрытия модального окна*/
        box.find('.'+prv.classes.linkClose).on('click.sv',function() {
            if(!$.isEmptyObject(ZIndex)){
                $.SV_MegaBox.Close(setting,box);
                mask.css('z-index',ZIndex.oldIn.mask);
                preloader.css('z-index',ZIndex.oldIn.preloader);
            }else{
               $.SV_MegaBox.Closed(setting,box);
            }

        });
      }

      if(setting.ctrlEsc){
         $(document).on('keydown.svclose',function(e) {
            if(e.which === 27) $.SV_MegaBox.Closed(setting,box);
         });
      }
      /* обработка кликов по кнопкам  - да \ нет*/
      if((!$.isEmptyObject(ZIndex) && box.find('.'+prv.classes.buttonOk).length) || (!$.isEmptyObject(ZIndex) && box.find('.'+prv.classes.buttonNo).length)){
        box.find('.'+prv.classes.buttonOk).unbind('click.sv');
        box.find('.'+prv.classes.buttonNo).unbind('click.sv');
        box.find('.'+prv.classes.buttonOk).on('click.sv',function() {
                $.SV_MegaBox.Close(setting,box);
                mask.css('z-index',ZIndex.oldIn.mask);
                preloader.css('z-index',ZIndex.oldIn.preloader);
                setting.onUserOk($(this));
        });
        box.find('.'+prv.classes.buttonNo).on('click.sv',function() {
                $.SV_MegaBox.Close(setting,box);
                mask.css('z-index',ZIndex.oldIn.mask);
                preloader.css('z-index',ZIndex.oldIn.preloader);
                setting.onUserNo($(this));
        });
      }
      if(box.hasClass(prv.classes.hide)){
        box.removeClass(prv.classes.hide);
      }
      box.hide(); /* прячем megabox для дальнейшего показа */
      _Effect(
          box,
          setting.effectShowBox,
          _TimeEffect(setting.timeEffectShowBox,setting),
          function(){
              $.SV_MegaBox.PreloaderClose(setting);
              box.addClass(prv.classes.show);
              /* обеспечиваем адаптивность megabox */
              if(setting.scale){$(window).resize(function(){ if(box.hasClass(prv.classes.show)) _Scale(box,setting,link);});}
              box.attr(prv.attr.power,'on');
              if(!$.isEmptyObject(link))  link.removeClass(prv.classes.linkLoaded);
              setting.onAfter(box);
          }
      );
      return box;
  };

  /*метод для закрытия модального окна*/
  $.SV_MegaBox.Close = function(newSetting,obj){
      var setting = _Settings(newSetting);
      var obj = obj || $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]');
      _Effect(
          obj,
          setting.effectCloseBox,
          _TimeEffect(setting.timeEffectCloseBox,setting),
          function(){
                 if(obj.attr(prv.attr.dinamic) == 'on') {
                    obj.remove();
                 }else{
                    $.SV_MegaBox.DestructBox(obj,setting);
                 }
                 setting.onBoxClose(obj);
          }
      );
      $(document).unbind('keydown.sv_img');
  };

  /*метод для деинсталяции модального окна*/
  $.SV_MegaBox.DestructBox = function(box,newSetting){
      if(box.length > 0){
        var setting = _Settings(newSetting);
        var box = box || $('.'+prv.classes.megabox);
        box.each(function(){
          var boxContent = $(this).find('.'+prv.classes.content).contents().detach();
          if(boxContent.length && setting.modificate){
            $(this).html(boxContent);
          }
          $(this).removeAttr(prv.attr.modificate)
                 .removeClass(prv.classes.headerOn)
                 .removeClass(prv.classes.headerOff)
                 .removeClass(prv.classes.linkCloseOn)
                 .removeClass(prv.classes.linkCloseOff)
                 .removeClass(prv.classes.footerOn)
                 .removeClass(prv.classes.footerOff)
                 .removeClass(prv.classes.autoOn)
                 .removeClass(prv.classes.autoOff)
                 .removeClass(prv.classes.defaultStyle)
                 .removeClass(prv.classes.show)
                 .removeClass(prv.classes.megabox)
                 .removeAttr(prv.attr.power)
                 .removeAttr('style')
                 .addClass(prv.classes.hide);
        });
      }

  };

  /*метод для деинсталяции маски*/
  $.SV_MegaBox.DestructMask = function(mask){
      var mask = mask || $('.'+prv.classes.mask);
      if(mask.length > 0) mask.remove();
  };

  /*метод для деинсталяции прелоадера*/
  $.SV_MegaBox.DestructPreloader = function(preloader){
      var preloader = preloader || $('.'+prv.classes.preloader);
      if(preloader.length > 0) preloader.remove();

  };

  /*метод для деинсталяции плагина*/
  $.SV_MegaBox.Destruct = function(box,mask,preloader){
       $.SV_MegaBox.DestructBox(box);
       $.SV_MegaBox.DestructMask(mask);
       $.SV_MegaBox.DestructPreloader(preloader);
  };

  /*метод для перезагрузки размеров и позиционирования*/
  $.SV_MegaBox.ReloadSize = function(box,link,newSetting){
      var setting = _Settings(newSetting);
      var box = box || $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]');
      var link = link || {};
      if(box.length > 0) _Scale(box,setting,link);

  };

  /*метод для перезагрузки параметров*/
  $.SV_MegaBox.Reload = function(newSett,obj,link){
    var settings = _Settings(newSett),
    obj = obj || $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]'),
    link = link || {};
    $.SV_MegaBox.DestructBox(obj);
    $.SV_MegaBox.Show(obj,settings,link);
  };

  /*метод для создания сообщения*/
  $.SV_MegaBox.Message = function(newSetting,obj){
        var setting = _Settings(newSetting),obj = obj || {};
        setting = $.extend({},setting,{preClosed:true},newSetting);
        var box = _CreateBox(prv.classes.prefixIdMess,prv.classes.container,setting);
        var content = (setting.text != '') ? setting.text : prv.errorText;
        box.html(content);
        return $.SV_MegaBox.Show(box,setting,obj);
  };

  /*метод для создания alert*/
  $.SV_MegaBox.Alert = function(newSetting,obj){
        var setting = _Settings(newSetting), obj = obj || {};
        var box = _CreateBox(prv.classes.prefixIdBox,prv.classes.container,setting);
        setting = $.extend({},setting,{
            title:'Сообщение',
            preClosed:true,
            footer:'<button class="'+prv.classes.buttonOk+' fr">'+setting.buttonTextOk+'</button>',
            footerFunc:function(box){
                box.find('.'+prv.classes.buttonOk).on('click.sv',function() {
                  setting.onUserOk($(this));
                  if(setting.buttonOkClose) $.SV_MegaBox.Closed(setting,box);
                });
            }
        },newSetting);

        var content = (setting.text != '') ? setting.text : prv.errorText;
        box.addClass(prv.classes.alert).html(content);
        return $.SV_MegaBox.Show(box,setting,obj);
  };

  /*метод для создания confirm*/
  $.SV_MegaBox.Confirm = function(newSetting,obj){
        var setting = _Settings(newSetting), obj = obj || {};
        var box = _CreateBox(prv.classes.prefixIdBox,prv.classes.container,setting);
        setting = $.extend({},setting,{
            title:'Сообщение',
            preClosed:true,
            footer:'<button class="'+prv.classes.buttonOk+'">'+setting.buttonTextOk+'</button><button class="'+prv.classes.buttonNo+'">'+setting.buttonTextNo+'</button>',
              footerFunc:function(box){
                box.find('.'+prv.classes.buttonOk).on('click.sv',function() {
                    setting.onUserOk($(this));
                    if(setting.buttonOkClose) $.SV_MegaBox.Closed(setting,box);
                });
                box.find('.'+prv.classes.buttonNo).on('click.sv',function() {
                    setting.onUserNo($(this));
                    if(setting.buttonNoClose) $.SV_MegaBox.Closed(setting,box);
                });
              }
        },newSetting);

        var content = (setting.text != '') ? setting.text : prv.errorText;
        box.addClass(prv.classes.confirm).html(content);
        return $.SV_MegaBox.Show(box,setting,obj);
  };

  /*метод для создания prompt*/
  $.SV_MegaBox.Prompt = function(newSetting,obj){
        var setting = _Settings(newSetting), obj = obj || {};
        var box = _CreateBox(prv.classes.prefixIdBox,prv.classes.container,setting);
        setting = $.extend({},setting,{
            title:'Сообщение',
            preClosed:true,
            clickCloseMask:false,
            closeLink:false,
            footer:'<div class="field"><div id="promt-otvet"><input type="text"></div><button class="'+prv.classes.buttonOk+' fr">'+setting.buttonTextOk+'</button></div>',
            footerFunc:function(box){
                box.find('.'+prv.classes.buttonOk).on('click.sv',function() {
                    var value = $(this).siblings().find('input').val();
                    $(this).siblings().find('input').removeClass('error');
                    $(this).siblings().find('.error-text').html('');
                    if(value == ''){
                       $(this).siblings().find('input').addClass('error');
                       $(this).siblings().find('input').before('<div class="error-text">Это поле должно быть заполнено!</div>');
                       _Scale(box,setting,{});
                    }else{
                       if(setting.buttonOkClose) $.SV_MegaBox.Closed(setting,box);
                       setting.onUserOk($(this));
                       setting.onAnswer(value);
                    }
                });
            }
        },newSetting);

        var content = (setting.text != '') ? setting.text : prv.errorText;
        box.addClass(prv.classes.prompt).html(content);
        return $.SV_MegaBox.Show(box,setting,obj);
  };

  /*метод для показа изображения*/
  $.SV_MegaBox.Image = function(src,newSetting,obj){
        var setting = _Settings(newSetting),title='',footer='',html='',obj = obj || {};
        /* показываем маску и прелоадер */
        $.SV_MegaBox.PreloaderShow(setting).css({
          'top':'50%',
          'left':'50%',
          'margin-top':'-'+$('.'+prv.classes.preloader).height()/2 +'px',
          'margin-left':'-'+$('.'+prv.classes.preloader).width()/2 +'px'
        });
        $.SV_MegaBox.MaskShow(setting);

        /* создаем разметку, создаем бокс и сбрасываем его ширину */
        html = '<div class="'+prv.classes.imgBox+'">'+
                    '<img class="'+prv.classes.img+'" src="'+src+'"/>'+
               '</div>';
        var box = _CreateBox(prv.classes.prefixIdBox,prv.classes.container,setting);
        box.html(html).css('width','auto');

        /* проверям флаг группы */
        var groupName = (obj.attr(prv.attr.group)) ? obj.attr(prv.attr.group) : false,current_index;
        var footerThis = '',titleThis = '',footerNext = '',titleNext = '',footerPrev = '',titlePrev = '',
        group = {}, index = 0,next_index = 0,prev_index = 0,counter = '';

        /* формируем title и description текущего изображения */
        title = obj.attr(prv.attr.title) || obj.attr('title') || setting.title;
        if(title) titleThis = '<span class="'+prv.classes.imgTitle+'">'+title+'</span>';
        footer = obj.attr(prv.attr.desc) || setting.footer;
        if(footer)  footerThis = '<span class="'+prv.classes.imgDesc+'">'+footer+'</span>';

        if(groupName){
            /* формируем объект элементов группы изображений */
            $('['+prv.attr.group+'='+groupName+']').each(function(){
              if($(this).attr('href') || $(this).attr(prv.attr.content)){
                  index++;
                  group[index] = {};
                  group[index]['title'] = $(this).attr(prv.attr.title) || $(this).attr('title') || setting.title;
                  group[index]['description'] = $(this).attr(prv.attr.desc) || setting.footer;
                  group[index]['src'] = $(this).attr('href') || $(this).attr(prv.attr.content);
                  if(group[index]['src'] == src) current_index = index;
                  /* наполняем временное хранилище изображений для ускорения загрузки */
                  if(!$('.'+prv.classes.imgTmp).find('img[src="'+group[index]['src']+'"]').length){
                    $('.'+prv.classes.imgTmp).append('<img src="'+group[index]["src"]+'" width="10" height="10">');
                  }
              }
            });

            if(index > 1){
                /* циркулярное перелистывание изображений */
                if(setting.circular){
                    box.find('.'+prv.classes.imgBox).append('<div class="'+prv.classes.Next+'"><span></span></div>');
                    box.find('.'+prv.classes.imgBox).append('<div class="'+prv.classes.Prev+'"><span></span></div>');
                }else{
                  if(current_index != 1){
                    box.find('.'+prv.classes.imgBox).append('<div class="'+prv.classes.Prev+'"><span></span></div>');
                  }
                  if(current_index != index){
                    box.find('.'+prv.classes.imgBox).append('<div class="'+prv.classes.Next+'"><span></span></div>');
                  }
                }
                if(setting.title_img_prev && box.find('.'+prv.classes.Prev).length){
                   box.find('.'+prv.classes.Prev+'>span').attr('title',setting.title_img_prev);
                }
                if(setting.title_img_next && box.find('.'+prv.classes.Next).length){
                   box.find('.'+prv.classes.Next+'>span').attr('title',setting.title_img_next);
                }
                /* определяем индексы в группе у предыдущего и последующего изображения */
                next_index = current_index+1;
                if(next_index > index) next_index = 1;
                prev_index = current_index-1;
                if(prev_index < 1) prev_index = index;

                /* формируем title и description у предыдущего и последующего изображения */
                if(group[prev_index]['title']) titlePrev = group[prev_index]['title'];
                if(group[prev_index]['description']) footerPrev = group[prev_index]['description'];

                if(group[next_index]['title']) titleNext = group[next_index]['title'];
                if(group[next_index]['description']) footerNext = group[next_index]['description'];

                /* обработка счетчика изображений */
                if(setting.counter_img){
                    var counter_img_text = setting.counter_img_text.replace(/#CURRENT_INDEX#/g, current_index);
                    counter_img_text = counter_img_text.replace(/#COUNT_IMAGE#/g, index);
                    counter = '<span class="'+prv.classes.imgCounter+'">'+counter_img_text+'</span>';
                    /* определение места вывода счетчика изображений */
                    if(setting.counter_img_position == 'top'){
                       titleThis = counter+titleThis;
                    }else if(setting.counter_img_position == 'bottom'){
                       footerThis = counter+footerThis;
                    }
                }
            }
        }


        /* изменяем настройки */
        setting = $.extend({},setting,{
          typeBox:'image',
          title:titleThis,
          content:html,
          footer: footerThis
        });

        /* формируем настройки у предыдущего и последующего изображения */
        if(index > 1){
            var setting_next = $.extend({},setting,{
              title:titleNext,
              preloader:false,
              effectShowBox:setting.effectShowBoxPrev,
              footer: footerNext
            });
            var setting_prev = $.extend({},setting,{
              title:titlePrev,
              preloader:false,
              effectShowBox:setting.effectShowBoxNext,
              footer: footerPrev
            });
        }
        if(setting.radius != ''){box.find('.'+prv.classes.img).css({'border-radius':setting.radius});}

        /* дожидаемся загрузки изображения */
        box.find('.'+prv.classes.img).load(function(){

              /* модифицируем html */
              if(box.attr(prv.attr.modificate) != 'on') { _Modificate(box,setting,obj);}

              /* обрабока переключений между слайдами группы */
              if(index > 1){
                    /* переключение по клику */
                    if(box.find('.'+prv.classes.Prev).length){
                          box.find('.'+prv.classes.Prev).on('click.sv',function() {
                                 if(!box.is(':animated')){
                                      $.SV_MegaBox.Close({effectCloseBox:setting.effectCloseBoxPrev});
                                      $.SV_MegaBox.Image(group[prev_index]['src'],setting_prev,obj);
                                      return;
                                 }
                          });
                    }
                    /* переключение по клику */
                    if(box.find('.'+prv.classes.Next).length){
                          box.find('.'+prv.classes.Next).on('click.sv',function() {
                                 if(!box.is(':animated')){
                                      $.SV_MegaBox.Close({effectCloseBox:setting.effectCloseBoxNext});
                                      $.SV_MegaBox.Image(group[next_index]['src'],setting_next,obj);
                                      return;
                                 }
                          });
                    }
                    /* переключение по нажатию на клавиши влево/вправо, вверх/вниз */
                    $(document).on('keydown.sv_img',function(e) {
                         if(e.which === setting.keycode_next && !box.is(':animated')) {
                            if(box.find('.'+prv.classes.Next).length){
                               box.find('.'+prv.classes.Next).click();
                            }else{
                               $.SV_MegaBox.Closed(setting,box);
                            }
                         }
                         if(e.which === setting.keycode_prev && !box.is(':animated')) {
                            if(box.find('.'+prv.classes.Prev).length){
                               box.find('.'+prv.classes.Prev).click();
                            }else{
                               $.SV_MegaBox.Closed(setting,box);
                            }
                         }
                    });

              }

              /* callBack */
              setting.onBefore(box);

              /*навешиваем событие на ссылку для закрытия модального окна*/
              if(setting.closeLink){
                box.find('.'+prv.classes.linkClose).on('click.sv',function() {
                       $.SV_MegaBox.Closed(setting,box);
                });
              }
              if(setting.unselect) box.find('.'+prv.classes.header).attr('unselectable', 'on').css('user-select', 'none');

              /* стилизуем megabox */
              _BoxStyle(box,setting,obj);

              /* фиксируем body */
              if(setting.fixBody)_FixBody($(window).scrollTop());

              var pl = parseInt(box.find('.'+prv.classes.content).css('padding-left')),
                  pr = parseInt(box.find('.'+prv.classes.content).css('padding-right')),
                  pt = parseInt(box.find('.'+prv.classes.content).css('padding-top')),
                  pb = parseInt(box.find('.'+prv.classes.content).css('padding-bottom')),
                  OrigWidth =  $(this).width(),OrigHeight = $(this).height(),prop_size = OrigWidth/OrigHeight,
                  minW = setting.minWidthImg,minH = setting.minHeightImg;

              /* рендеринг изображения */
              function Render(){
                /*получаем размеры для вывода*/
                var Sizer = _BoxSizer(box,setting,obj),
                    maxH = Sizer['height_modal_content'] - (pt+pb),
                    maxW = Sizer['width_modal'] - (pl+pr),
                    width = OrigWidth,height = OrigHeight;

                if(width>maxW || height>maxH){
                     if(width>maxW){
                       width = maxW;
                       height = width/prop_size;
                     }
                     if(height>maxH){
                       height = maxH;
                       width = height*prop_size;
                     }
                     if(width<minW){
                       width = minW;
                       height = width/prop_size;

                     }
                     if(width<minH){
                       width = minH;
                       height = width/prop_size;

                     }
                }
                box.find('.'+prv.classes.imgBox).css({
                    'width':width+'px',
                    'height':height+'px'
                });
                if(box.find('.'+prv.classes.footer).length) box.find('.'+prv.classes.footer).css('width',width+pl+pr+'px');
              }
              Render();
              _Scale(box,setting,obj,true);

              if(box.hasClass(prv.classes.hide)){
                box.removeClass(prv.classes.hide);
              }
              box.hide(); /* прячем megabox для дальнейшего показа */

              /* показываем модальное окно в зависимости от эффекта*/
              _Effect(
                  box,
                  setting.effectShowBox,
                  _TimeEffect(setting.timeEffectShowBox,setting),
                  function(){
                      $.SV_MegaBox.PreloaderClose(setting);
                      box.addClass(prv.classes.show);
                      box.attr(prv.attr.power,'on');
                      if(!$.isEmptyObject(obj))  obj.removeClass(prv.classes.linkLoaded);
                      setting.onAfter(box);
                  }
              );

              /* перезагрузка размеров при ресайзе */
              $(window).resize(function(){
                  /* reset */
                  box.find('.'+prv.classes.imgBox).removeAttr('style');
                  if(box.find('.'+prv.classes.footer).length) box.find('.'+prv.classes.footer).css('width','auto');
                  _ModReset(box,true);
                  Render();
                  _Scale(box,setting,obj,true);

              });
              return box;
        });
  };

  $.SV_MegaBox.AjaxContent = function(content,newSetting,link){
        var setting = _Settings(newSetting),link = link || {};
        /*if(setting.preloader){
                $('.'+prv.classes.preloader).css({
                  'top':'50%',
                  'left':'50%',
                  'margin-top':'-'+$('.'+prv.classes.preloader).height()/2 +'px',
                  'margin-left':'-'+$('.'+prv.classes.preloader).width()/2 +'px'
                });
        }*/
        $.SV_MegaBox.PreloaderShow(setting);
        $.SV_MegaBox.MaskShow(setting);
        $.ajax({
          type: setting.typeAjax,
          data: $.extend(true,{SV_MEGABOX_AJAX:'on'},setting.dataAjax),
          url: content,
          error: function (data){
            setting.onAjaxError(data);
            if(link.hasClass(prv.classes.linkLoaded))  link.removeClass(prv.classes.linkLoaded);
            return $.SV_MegaBox.Alert({title:'Ошибка',styleClass:'error',text:'Ошибка при загрузке контента'});
          },
          success: function (data){
            setting.onAjaxSuccessBefore(data);
            var box = _CreateBox(prv.classes.prefixIdBox,prv.classes.container,newSetting);
            box.addClass('ajax-content').html(data);
            setting.onAjaxSuccessAfter(data,box);
            return $.SV_MegaBox.Show(box,setting,link);
          }
        });

  };

  /* метод для закрытия маски и модального окна */
  $.SV_MegaBox.Closed = function(newSetting,obj){
      var setting = _Settings(newSetting),obj = obj || $('.'+prv.classes.megabox+'['+prv.attr.power+'=on]');
      setTimeout(function(){
        $.SV_MegaBox.MaskClose(setting);
      },_TimeEffect(setting.timeEffectCloseBox,setting));

      $.SV_MegaBox.Close(setting,obj);
      if(setting.fixBody) $('body').removeClass(prv.classes.bodyFix);
      if($('.'+prv.classes.preloader).length) $('.'+prv.classes.preloader).removeAttr('style');
      $('.'+prv.classes.imgTmp).html('');
      setting.onClosed();

      $(document).unbind('keydown.svclose');
  };


  $.fn.SV_MegaBox = function(newSetting){

     /* устанавливаем настройки плагина */
     var plugin = this, _setting =  _Settings(newSetting);

     /* запускаем инициализацию */
     $.SV_MegaBox(_setting);

     /* инициализируем плагин */
     plugin.each(function(){
         var UserOption = ($(this).data('options') && typeof($(this).data('options')) === 'object') ? $(this).data('options') : {}, setting  = _setting;
         if(!$.isEmptyObject(UserOption)) {setting = $.extend({},setting,UserOption);}
         $(this).on('click.svmegabox',function(e) {
            e.preventDefault();
            if($(this).hasClass(prv.classes.linkLoaded)) return;
            var link = $(this);
            link.addClass(prv.classes.linkLoaded);
            var content_string = _getContentString(link,setting);

            if(content_string){
                var type = _TypeContent(content_string);
                switch(type){
                    case 'image':
                        setting.onBeforeImageClick(link,content_string);
                        $.SV_MegaBox.Image(content_string,setting,link);
                      break;
                    case 'ajax':
                        setting.onBeforeAjaxClick(link,content_string);
                        $.SV_MegaBox.AjaxContent(content_string,setting,link);
                      break;
                    case 'html':
                         var sv_megabox;
                         if($(content_string).length == 1){
                            sv_megabox = $(content_string);
                         }else if($(content_string).length > 1){
                            sv_megabox = $(content_string).eq(0);
                            _MsgShow('Указан css селектор блока с содержимым - $("'+attrLink+'"), кол-во данных блоков на странице больше одного. Контент взят из первого блока в выборке.',true);
                         }else{
                            sv_megabox = false;
                            _MsgShow(prv.errorText+' Указанный css селектор - $("'+attrLink+'") блока с содержимым на странице не найден');
                         }
                         if(sv_megabox) {
                           setting.onBeforeHtmlClick(link,sv_megabox);
                           $.SV_MegaBox.Show(sv_megabox,setting,link);
                         }
                         break;
                }
             }else{
                 _MsgShow(prv.errorText+' У модальной ссылки должен быть аттрибут "data-content" или "href", если это html ссылка или в параметрах плагина должно быть задано свойство "content", оба параметра должны содержать css селектор блока с содержимым');
             }

           /*
            * Публичные методы для одного экземпляра плагина c типом html
            * ***********************************************************
            */
            if(type == 'html' || type == 'ajax'){
               /* метод для пересчета размера модального окна */
              plugin.ReloadSize = function(){
                $.SV_MegaBox.ReloadSize(sv_megabox,link,setting);
              };

              /* метод для перезагрузки модального окна */
              plugin.Reload = function(newSett){
                var setting = $.extend({},setting,newSett);
                $.SV_MegaBox.Reload(setting,sv_megabox,link)
              };

              /* метод для показа модального окна */
              plugin.Show = function(){
                $.SV_MegaBox.Show(sv_megabox,setting,link);
              };

              /* метод для скрытия модального окна */
              plugin.Close = function(){
                $.SV_MegaBox.Close(setting,sv_megabox);
              };
              /* метод для скрытия модального окна */
              plugin.Closed = function(){
                $.SV_MegaBox.Closed(setting,sv_megabox);
              };
            }

         });
     });

     return plugin;
  };
}(jQuery));

$(document).ready(function() {
    $('#bigSlider').lightSlider({
        auto: true,
        adaptiveHeight:true,
        item:1,
        pager: false,
        slideMargin:0,
        loop:true
    });

    $('#brandsSlider').lightSlider({
        auto: true,
        item:4,
        pager: false,
        slideMargin:60,
        loop:true,
        responsive : [
            {
                breakpoint:992,
                settings: {
                    item:3,
                    slideMove:3,
                    slideMargin:20,
                  }
            },
            {
                breakpoint:768,
                settings: {
                    item:2,
                    slideMove:10
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ]
    });

    $('.projectSlider__slider').lightSlider({
        auto: false,
        adaptiveHeight:true,
        item:1,
        pager: false,
        slideMargin:0,
        loop:true
    });

    // mask for phone inputs

    $('input[data-mask="phone"]').mask("+7(999)999-99-99");
    $('input[data-mask="date"]').mask("99.99.9999");

    // init plugins
    var SV_MegaBox__option = {
        cssPosition:'absolute',
        heightLimit:false,
        fixBody:false,
        preloader:false,
        radius:'0',
        scale: false, 
        width:630    
    };
    $('.awModlink').SV_MegaBox(SV_MegaBox__option);
    $('.awModlinkImg').fancybox();
    // функция очистки полей форм после отправки
    function IsvFormReset(form){
        form[0].reset();
        if(form.find('.fn-isv-file-style').length) form.find('.fn-isv-file-style').change();
        if(form.find('.fn-isv-select-style').length) form.find('.fn-isv-select-style').change();
        if(form.find('.fn-isv-checkbox-style').length) form.find('.fn-isv-checkbox-style').change();
        if(form.find('.fn-isv-radio-style').length) form.find('.fn-isv-radio-style').change();
    }

    var svValidatorOption = {
        mode:{
          defaultSubmit:false,
          localInit:true
        },
        stylerAdapt:{                                                           /* параметр учета использования стилизаторов проверяемого поля*/
          stat:true,                                                            /* флаг включения */
          selector:{                                                            /* селекторы оберток стилизатора */
            checkbox :'label_checkbox',                                           /* селектор обертки стилизатора чекбокса */
            radio    :'sv-radio-box',                                           /* селектор обертки стилизатора радиобаттона */
            select   :'sv-select-box',                                          /* селектор обертки стилизатора селекта */
            file     :'sv-file-box',                                            /* селектор обертки стилизатора файла */
          },
        },
        css:{
          errorField:{
                font:{
                  reduct       :'normal 16px "Open Sans", sans-serif',
                  text_shadow  :'none'
                },
                background     :'#e73331',
                radius         :'0',
                shadow         :'none',
          }
        },
        scrollToErrorField:{
            stat: true,
            indent: 100   
        }      
    }

    // стилизация поля для файла

    $('.awForm__item_file input').SV_MegaStyler({
        button_file_text:'',
        default_file_style: false,
    });

    /* добавление нового типа валидации для поля выбор файла */
    $.SV_MegaValidator.AddTypeField({
        file_user_resume: {
          reg: /\.(?:doc|docx|txt)$/i,
          noreg_text: 'Недопустимое расширение файла!<br/> Допускается: .doc, .docx, .txt'
        }
    });

    // настрйока параметров валидации: выделение поля с ошибкой, вспытие сообщения при успехе
    $('body').on('submit', '.awValidated', function(e) {
        e.preventDefault();
        $.SV_MegaValidator.Validate($(this), $.extend(true, svValidatorOption, {
            callBack:{
              Success:function(form,data) {
                var role = (form.data('role')) ? form.data('role') : (form.attr('data-role')) ? form.attr('data-role') : 'default';
                var modal_option = $.extend(true,SV_MegaBox__option,{
                    align:'center',
                    text: '<div class="isv-form"><div class="section__title">Поздравляем!</div><br><div class="section__subtitle">Ваша заявка отправлена.</div> </div>'
                });
                $.SV_MegaBox.Message(modal_option);
                IsvFormReset(form);
              }
            }
        })
        )
    });


    // tabs for slider


    function getTabIndex(elementForGetIndex) {
        while (elementForGetIndex.parent().hasClass('tab_indexChecker') === false) {
            elementForGetIndex = elementForGetIndex.parent();
            if (elementForGetIndex.tagName === 'BODY') {
                console.log('you forgot tab_indexChecker tag');
            }
        }
        return elementForGetIndex.index();        
    }

    function clearActiveTab(tab) {
        tab.find('.tab__toggle_active').removeClass('tab__toggle_active');
        tab.find('.tab__content_active').removeClass('tab__content_active');       
    }

    function tabWork() {
        $('.tab__toggle').click(function(e) {
            e.preventDefault();

            var link = $(this), 
            parent = link.parents('.tab');
            var index = getTabIndex(link);

            if (!link.hasClass('tab__toggle_active')) {
                clearActiveTab(parent);
                link.addClass('tab__toggle_active');
                parent.find('.tab__content').eq(index).addClass('tab__content_active');
            }
        });
    }
    tabWork();
});
/* **** SV_FormStyler v1.0  **** */
/* **** Libraly Jquery 1.8.3 **** */
/* ** Developer Sergey Vorobyev ** */
/* E-mail workbiznet@gmail.com */
/* **************************** */

(function( $ ) {
  /* Private options end methods */
  var SV_FormStyler = {
    classes:{
      wrap_check:'sv-check-box',
      wrap_radio:'sv-radio-box',
      wrap_select:'sv-select-box',
      select_button:'sv-select-button',
      select_button_icon:'sv-select-icon',
      inner_text_select:'sv-select-inner',
      wrap_file:'sv-file-box',
      wrap_file_button:'sv-file-button',
      wrap_file_field:'sv-file-field',
      checked:'sv-checked'
    },
    Render:function(obj,option){
      obj.each(function(){
            if($(this).is(':checkbox') && $(this).parents('.'+SV_FormStyler.classes.wrap_check).length == 0){
               $(this).wrap('<span class="' + SV_FormStyler.classes.wrap_check + '"></span>');
               $(this).parents('.'+SV_FormStyler.classes.wrap_check).prepend('<span></span>');
               if($(this).is(':disabled')) $(this).parents('.'+SV_FormStyler.classes.wrap_check).addClass('disabled');
               SV_FormStyler.AssayChek($(this),SV_FormStyler.classes.wrap_check,SV_FormStyler.classes.checked);
               option.onCreate($(this));
            }
            else if($(this).is(':radio') && $(this).parents('.'+SV_FormStyler.classes.wrap_radio).length == 0){
               $(this).wrap('<span class="' + SV_FormStyler.classes.wrap_radio + '"></span>');
               $(this).parents('.'+SV_FormStyler.classes.wrap_radio).prepend('<span></span>');
               if($(this).is(':disabled')) $(this).parents('.'+SV_FormStyler.classes.wrap_radio).addClass('disabled');
               SV_FormStyler.AssayRadio($(this),SV_FormStyler.classes.wrap_radio,SV_FormStyler.classes.checked);
               option.onCreate($(this));
            }
            else if($(this).is(':file') && $(this).parents('.'+SV_FormStyler.classes.wrap_file).length == 0){
               var default_file_style = (option.default_file_style) ? ' d-styles': '';
               var file_placeholder = ($(this).attr('placeholder') && $(this).attr('placeholder') != '') ? $(this).attr('placeholder') : option.file_placeholder;
               $(this).wrap('<span class="' + SV_FormStyler.classes.wrap_file + default_file_style + '"></span>');
               if($(this).is(':disabled')) $(this).parents('.'+SV_FormStyler.classes.wrap_file).addClass('disabled');
               var fileBox = $(this).parents('.'+SV_FormStyler.classes.wrap_file);
               if(option.button_file_right)
                    fileBox.addClass('button-right');
               fileBox.prepend('<span class="'+SV_FormStyler.classes.wrap_file_button+'">'+option.button_file_text+'</span>');
               if(!option.split_button)
                    fileBox.append('<span class="'+SV_FormStyler.classes.wrap_file_field+'">'+file_placeholder+'</span>');
               if(option.size_file_field){
                   var w_button = fileBox.find('.'+SV_FormStyler.classes.wrap_file_button).outerWidth();
                   fileBox.find('.'+SV_FormStyler.classes.wrap_file_button).width(w_button);
                   if(option.button_file_right)
                        fileBox.find('.'+SV_FormStyler.classes.wrap_file_field).css('margin-right',w_button+'px');
                   else
                        fileBox.find('.'+SV_FormStyler.classes.wrap_file_field).css('margin-left',w_button+'px');
               }
               if(option.custom_file_class) fileBox.addClass(option.custom_file_class);
               option.onCreate($(this));
            }
            else if($(this).is('select') && $(this).parents('.'+SV_FormStyler.classes.wrap_select).length == 0){
               $(this).wrap('<span class="' + SV_FormStyler.classes.wrap_select + '"></span>');
               if($(this).is(':disabled')) $(this).parents('.'+SV_FormStyler.classes.wrap_select).addClass('disabled');
               $(this).parents('.'+SV_FormStyler.classes.wrap_select).append('<span class="'+SV_FormStyler.classes.inner_text_select+'"></span><span class="'+SV_FormStyler.classes.select_button+'"><span class="'+SV_FormStyler.classes.select_button_icon+'"></span></span>');
               SV_FormStyler.AssaySelect($(this));
               option.onCreate($(this));
            }

      });
      obj.change(function(){
            if($(this).is(':checkbox')) SV_FormStyler.AssayChek($(this),SV_FormStyler.classes.wrap_check,SV_FormStyler.classes.checked);
            if($(this).is(':radio')) SV_FormStyler.AssayRadio($(this),SV_FormStyler.classes.wrap_radio,SV_FormStyler.classes.checked);
            if($(this).is(':file')) SV_FormStyler.AssayFile($(this),option);
            if($(this).is('select')) SV_FormStyler.AssaySelect($(this));
            option.onChange($(this));
      });
    },
    AssayChek:function(obj,parentClass,checkClass){
          if(obj.prop('checked')){
            obj.parents('.'+parentClass).addClass(checkClass);
          }else{
                obj.parents('.'+parentClass).removeClass(checkClass);
          }
    },
    AssayRadio:function(obj,parentClass,checkClass){
         var name = obj.attr('name');
         if(obj.prop('checked')){
                $('[name="'+name+'"]').parents('.'+parentClass).removeClass(checkClass);
            obj.parents('.'+parentClass).addClass(checkClass);
         }else{
                obj.parents('.'+parentClass).removeClass(checkClass);
         }
    },
    AssayFile:function(obj,option){
         var place = option.file_placeholder;
         if(obj.val() != '') place = obj.val().replace(/.+[\\\/]/, '');
         if(option.split_button){
           option.include_name_file(obj,place);
         }else{
            obj
              .parents('.'+SV_FormStyler.classes.wrap_file)
              .find('.'+SV_FormStyler.classes.wrap_file_field)
              .text(place);
         }
    },
    AssaySelect:function(obj){
         obj.siblings('.'+SV_FormStyler.classes.inner_text_select).html(obj.find('option:selected').html());
    },
  };
  /* Private options end methods (end) */

  /* Public default methods */
  var methods = {

    /* метод инициализации стилизатора
    # возвращает текуший обьект (this) */
    Init:function(option){
      if(this.length == 0) return;
      var option = $.extend({},$.fn.SV_MegaStyler.defaults,option);
      SV_FormStyler.Render(this,option);

      return this;
    },

  };
  /* Public default methods (end) */

  /* calls plugin */
  $.fn.SV_MegaStyler = function(method){
     /*логика вызова метода*/
      if ( methods[method] ) {
        return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
      } else if ( typeof method === 'object' || ! method ) {
        return methods.Init.apply( this, arguments );
      } else {
        $.error( 'Метод с именем '+method+' не существует для jQuery.SV_MegaStyler' );
      }
  };
  /* calls plugin (end) */

  /* Public default options */
  $.fn.SV_MegaStyler.defaults = {
    button_file_text:'Обзор...',
    button_file_right:false,
    default_file_style:true,
    custom_file_class:'',
    size_file_field:true,
    split_button:false,
    include_name_file:function(field,name){},
    onCreate:function(){},
    onChange:function(){},
    file_placeholder:'Файл не выбран',
  };
  /* Public default options (end) */
})(jQuery);
/*
  *  Jquery Plugin $.SV_MegaValidator version 3.0
  *  Libraly Jquery 1.8.3+ (recommend 1.8.3)
  *  Developer Sergey Vorobyev
  *  Web site http://frontend-book.ru/sv_megavalidator/
  *  E-mail workbiznet@gmail.com
  *  Commercial License
 **/

;(function($){

  /* включаем режим use strict */
  'use strict';

  $.SV_MegaValidator = function(option){};

  /* Public default options */
  $.SV_MegaValidator.defaults = {
    mode:{
      validate               :'Every',                                      /* глобальный режим валидации - Every | All | Export | Out-Modal */
      defaultSubmit          : true,                                        /* режим валидации при стандартной отправке формы, false отключит стандартную отправку формы по submit */
      checkBlur              : false,                                       /* режим валидации при потере фокуса проверяемого поля*/
      checkChange            : false,                                       /* режим валидации при изменении значения проверяемого поля*/
      checkKeyup             : false,                                       /* режим валидации при вводе значения проверяемого поля*/
      focusFieldDestructOne  : true,                                        /* режим валидации при потере фокуса проверяемого поля*/
      clearField             : true,                                        /* режим валидации с автоматической отчисткой проверяемого поля после отправки */
      addClassesField        : true,                                        /* режим валидации с добавлением статусного класса проверяемого поля*/
      localInit              : false
    },
    stylerAdapt:{                                                           /* параметр учета использования стилизаторов проверяемого поля*/
      stat:true,                                                            /* флаг включения */
      selector:{                                                            /* селекторы оберток стилизатора */
        checkbox :'sv-check-box',                                           /* селектор обертки стилизатора чекбокса */
        radio    :'sv-radio-box',                                           /* селектор обертки стилизатора радиобаттона */
        select   :'sv-select-box',                                          /* селектор обертки стилизатора селекта */
        file     :'sv-file-box',                                            /* селектор обертки стилизатора файла */
      },
    },
    absPosError:{                                                           /* абсолютное позиционирование сообщения об ошибке */
      stat:true,                                                            /* флаг включения */
      posField:'top'                                                        /* позиция сообщения об ошибке */
    },
    text:{                                                                  /* текстовые настройки сообщений, имеются макросы: #NAME# - имя поля(задается через data-name),#MIN# - мин.длина поля(задается через data-min),#MAX# - макс.длина поля(задается через data-max),#UNIT# - единица измерения длины поля(задается через text.unit) */
      empty :'Не заполнено поле #NAME#',                                    /* сообщение о не заполненном поле */
      noreg :'Неккоректно заполнено поле #NAME#',                           /* сообщение о не корректно заполненном поле */
      min   :'Минимальная длина поля #NAME# #MIN# #UNIT#',                  /* сообщение о мин. длине */
      max   :'Максимальная длина поля #NAME# #MAX# #UNIT#',                 /* сообщение о макс. длине */
      unit  :'символ',                                                      /* единица измерения символов */
      suffix:['','а','ов']                                                  /* массив окончаний единицы измерения Пример [1 символ[], 2 символ[a], 5 символ[ов] */
    },
    ajaxSend:{                                                              /* параметр для ajax отправки формы после валидации */
      stat:false,                                                           /* флаг включения */
      type:"POST",                                                          /* тип передачи данных */
      url:'',                                                               /* путь до обработчика формы */
      message:{                                                             /* параметры встроенного сообщения в модальном окне */
        stat:false,                                                         /* показывать ли сообщение после отправки */
        outFile:false,                                                      /* настройка которая говорит о том что данные сообщения берутся из файла */
        mask:{                                                              /* параметры маски */
          stat:true,                                                        /* флаг включения */
          effectShow:'show',                                                /* эффект показа маски */
          effectClose:'hide',                                               /* эффект скрытия маски */
          time:0,                                                           /* эффект показа\скрытия маски */
          preloader:true,                                                   /* флаг показа прелоадера загрузки */
          clickClose:true,                                                  /* закрытие сообщения и маски, по клику на маску */
          css:false,                                                        /* custom - css параметры маски */
          callBackShow:function(mask){},                                    /* callBack при показе маски */
          callBackClose:function(mask){},                                   /* callBack при скрытии маски */
          callBackClick:function(mask){}                                    /* callBack при клике по маске */
        },
        box:{                                                               /* параметры сообщения */
          effectShow:'fadeIn',                                              /* эффект показа сообщения */
          effectClose:'fadeOut',                                            /* эффект скрытия сообщения */
          time:500,                                                         /* эффект показа\скрытия сообщения */
          linkClose:true,                                                   /* флаг показа ссылки закрытия сообщения */
          css:false,                                                        /* custom - css параметры сообщения */
          cssTitle:false,                                                   /* custom - css параметры title сообщения */
          cssText:false,                                                    /* custom - css параметры тестовой области сообщения */
          buttonOk:true,                                                    /* флаг показа кнопки у сообщения */
          buttonOkText:'ок',                                                /* текст кнопки у сообщения */
          buttonClickClose:true,                                            /* флаг закрытия сообщения по кликуна кнопку сообщения */
          styleClass:'info',                                                /* класс стиля сообщения  info\ error \ success */
          callBack:function(box){},                                         /* callback после показа сообщения */
          callBackClick:function(link){}                                    /* callback при клике на ссылку закрытия сообщения */
        },
        errorTitle:'Ошибка',                                                /* заголовок сообщения об ошибке в модальном окне */
        title:'Оповещение',                                                 /* заголовок сообщения */
        text:'Cообщение успешно отправлено!',                               /* текст сообщения */
      }
    },
    submit_button: {},                                                      /* указатель отправки формы по клику, при валидации секции не являющейся html формой */
    fade:{                                                                  /* параметр автоматического скрытия сообщения об ошибке */
        stat     : false,                                                   /* флаг включения */
        timeShow : 1,                                                       /* время эффекта автоматического скрытия сообщения об ошибке, в секундах */
        timeOut  : 4                                                        /* время задержки, через которое произойдет автоматическое скрытие сообщения об ошибке, в секундах */
    },
    scrollToErrorField:{                                                    /* параметр для скролла страницы к первому сообщеню об ошибке */
        stat     : true,                                                    /* флаг включения */
        time     : 300,                                                     /* время эффекта скролла */
        indent   : 50                                                       /* значение верхнего отступа после скролла */
    },
    css:{                                                                   /* custom стили для сообщений выводимых в формах и для самих полей с ошибками */
        errorField:{                                                        /* настройки для сообщений об ошибке */
              font:{                                                        /* настройка шрифта */
                reduct       :'',                                           /* сокращенный вариант записи, например "bold 14px/16px 'Tahoma', sans-serif" */
                family       :'',                                           /* название шрифта сообщений об ошибке*/
                size         :'',                                           /* размер шрифта сообщений об ошибке */
                style        :'',                                           /* стиль шрифта сообщений об ошибке */
                transform    :'',                                           /* text-trasform текста сообщений об ошибке */
                lineHeight   :'',                                           /* межстрочный интервал текста сообщений об ошибке */
                weight       :'',                                           /* жирность текста сообщений об ошибке */
                color        :'',                                           /* цвет текста сообщений об ошибке */
                text_shadow  :''                                            /* тень текста сообщений об ошибке */
              },
              background     :'',                                           /* background сообщений об ошибке */
              radius         :'',                                           /* border-radius сообщений об ошибке */
              shadow         :'',                                           /* внешняя тень сообщений об ошибке */
              padding        :'',                                           /* padding сообщений об ошибке */
              margin:{                                                      /* настройки отступов сообщений об ошибке */
                reduct       :'',                                           /* сокращенный вариант записи */
                left         :'',                                           /* значение левого отступа сообщения об ошибке */
                right        :'',                                           /* значение правого отступа сообщения об ошибке */
                top          :'',                                           /* значение верхнего отступа сообщения об ошибке */
                bottom       :''                                            /* значение нижнего отступа сообщения об ошибке */
            }
        },
        textField:{                                                         /* настройки custom css для валидируемых полей */
           error  : {                                                       /* настройки custom css для полей с ошибками */
             border          :'',                                           /* настройки обводки для полей с ошибками */
             color           :'',                                           /* настройки цвета текста для полей с ошибками */
             background      :'',                                           /* настройки background для полей с ошибками */
             shadow          :''                                            /* настройки тени для полей с ошибками */
           },
           success: {                                                       /* настройки custom css для полей прошедших валидацию */
             border          :'',                                           /* настройки обводки для полей прошедших валидацию */
             color           :'',                                           /* настройки цвета текста для полей прошедших валидацию */
             background      :'',                                           /* настройки background для полей прошедших валидацию */
             shadow          :''                                            /* настройки тени для полей прошедших валидацию */
           }
        }
    },
    typeField:{                                                             /* Зарегистрированные типы полей */
      name:{
          reg:/^[а-яА-ЯёЁa-zA-Z0-9]+$/,
          noreg_text:'Неккоректное имя!'
      },
      login:{
          reg:/^[a-zA-Z0-9]+$/,
          noreg_text:'Неккоректный логин!'
      },
      phone:{
          reg:/^\+?\s*[^0]+\d+\s*([\-\s\d\(\)]+)?$/,
          noreg_text:'Неккоректный номер телефона!'
      },
      email:{
          reg:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/,
          noreg_text:'Неккоректный email!'
      },
      password:{
          reg:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/,
          noreg_text:'Неккоректный пароль!'
      },
      numceil:{
          reg:/^(0)$|^([1-9][0-9]*)$/,
          noreg_text:'Неккоректное число!'
      },
      url:{
          reg:/^((https?|ftp)\:\/\/)?([a-zA-Z0-9]{1})((\.[a-zA-Z0-9-])|([a-zA-Z0-9-]))*\.([a-zA-Z]{2,6})(\/?)$/,
          noreg_text:'Неккоректный url!'
      },
      link:{
          reg:/^(https?:\/\/)?([\da-zA-Z0\.-]+)\.([a-zA-Z\.]{2,6})([\/\w \.-]*)*\/?$/,
          noreg_text:'Неккоректная ссылка!'
      }
    },
    callBack:{                                                              /* callbacks */
      ajaxSendBefore  :function(form,data){},                               /* callback после встроенного ajax и перед показом сообщения */
      ajaxSendAfter   :function(form,data){},                               /* callback после встроенного ajax и после показом сообщения */
      Success         :function(form,data){},                               /* callback успешой валидации */
      Error           :function(form,data,string,object){}                  /* callback не успешой валидации */
    }

  };
  /* Public default options (end) */

  /* Private options end methods */
  var prv = {
    atr:{
      req:'data-req',
      name:'data-name',
      name_radio:'data-radio-name',
      type:'data-type',
      reg:'data-reg',
      min:'data-min',
      max:'data-max',
      empty_text:'data-empty-text',
      noreg_text:'data-noreg-text',
      min_text:'data-min-text',
      max_text:'data-max-text',
      form_valid:'data-form-valid',
      error_position:'data-position'
    },
    cls:{
      form_validate:'sv-validate-section',
      error:'sv-error',
      error_box:'sv-error-box',
      field_wrap:'sv-field-wrap',
      field_wrap_rel:'sv-field-wrap-rel',
      error_field:'sv-error-field',
      success_field:'sv-success-field'
    }
  };
  /* Private options end methods (end) */

  /* Public default methods */

    /* метод инициализации валидатора
    # возвращает текуший обьект формы */
    var _Init = function(form,option){

      /* если валидатор формы инициализирован или стоит запрет на валидацию, возвращаем текущий обьект формы */
      if(form.attr(prv.atr.form_valid) == 'on' || form.attr(prv.atr.form_valid) == 'off') return form;

      /* в режиме потоковой проверки или в режиме экспорта ошибок настраиваем валидацию при потере фокуса и при вводе с клавиатуры */
      if(option.mode.validate == 'Every' || option.mode.validate == 'Export'){
          /* валидация поля при потере фокуса */
          if(option.mode.checkBlur){
             form.find('input,textarea,select').on('focusout',function(){
                  $.SV_MegaValidator.Render($(this),option);
             });
          }
          /* валидация поля при изменении значения */
          if(option.mode.checkChange){
             form.find('input,textarea,select').on('change',function(){
                  var field = ($(this).is(':radio') && _IssetAttr($(this),'name')) ? $('[name="'+$(this).attr('name')+'"]') : $(this);
                  $.SV_MegaValidator.Render(field,option);
             });
          }
          /* валидация поля при вводе с клавиатуры */
          if(option.mode.checkKeyup){
             form.find('input,textarea,select').on('keyup',function(){
                  $.SV_MegaValidator.Render($(this),option);
             });
          }
          
          /* Преинициализация. Заключается в обертки полей, для избежания потери фокуса при обертке полей динамически!! */
          form.find('input,select,textarea').each(function(){
            if(!$(this).is(':submit,:hidden,:disabled') && _IssetAttr($(this),prv.atr.req) || _IssetAttr($(this),prv.atr.type) || _IssetAttr($(this),prv.atr.reg) || _IssetAttr($(this),prv.atr.min) || _IssetAttr($(this),prv.atr.max)){
                var wrapBox;

                if(option.stylerAdapt.stat){
                  if($(this).is(':checkbox') && $(this).parent().hasClass(option.stylerAdapt.selector.checkbox)){
                    wrapBox = _ErrorWrapField($(this).parents('.'+option.stylerAdapt.selector.checkbox));
                    wrapBox.addClass('i-b');
                  }else if($(this).is(':radio') && $(this).parent().hasClass(option.stylerAdapt.selector.radio)) {
                    wrapBox = _ErrorWrapField($(this).parents('.'+option.stylerAdapt.selector.radio));
                    wrapBox.addClass('i-b');
                  }else if($(this).is(':file') && $(this).parent().hasClass(option.stylerAdapt.selector.file)) {
                    wrapBox = _ErrorWrapField($(this).parents('.'+option.stylerAdapt.selector.file));
                  }else if($(this).is('select') && $(this).parent().hasClass(option.stylerAdapt.selector.select)) {
                    wrapBox = _ErrorWrapField($(this).parents('.'+option.stylerAdapt.selector.select));
                  }else{

                    wrapBox = _ErrorWrapField($(this));
                    if($(this).is(':checkbox') || $(this).is(':radio')){
                      wrapBox.addClass('i-b');
                    }
                  }
                }else{
                    wrapBox = _ErrorWrapField($(this));
                    if($(this).is(':checkbox') || $(this).is(':radio')){
                      wrapBox.addClass('i-b');
                    }
                }


            }
          });
          if(option.absPosError.stat) form.find('.'+prv.cls.field_wrap).addClass(prv.cls.field_wrap_rel);
      }

      /* валидация формы */
      if(form.is('form')){
        _ValidForm(form,option);
      }else {
        _ValidSection(form,option.submit_button,option);
      }
      /* устанавливаем флаг валидации формы */
      form.attr(prv.atr.form_valid,'on').addClass(prv.cls.form_validate);

      /* возвращаем текущий обьект формы */
      return form;
    };

    /* метод для проверки содержимого на регулярное выражение
    # возвращает true, если вхождение есть, иначе возвращает false */
    var _ValidReg = function(reg,value){return reg.test(value);};

    /* метод для проверки содержимого на пустоту
    # возвращает true, если содержимое пусто, иначе возвращает false */
    var _ValidEmpty = function(value){return value == '';};

    /* метод для проверки на минимальную длину
    # возвращает true, если длина содержимого больше или равна минимальному значению, иначе возвращает false */
    var _ValidMinLength = function(minLength,value){return value.length >= minLength;};

    /* метод для проверки на максимальную длину
    # возвращает true, если длина содержимого меньше или равна максимальному значению, иначе возвращает false */
    var _ValidMaxLength = function(maxLength,value){return value.length <= maxLength;};

    /* метод для проверки существования аттрибута
    # возвращает true, если аттрибут существует, иначе возвращает false */
    var _IssetAttr = function(field,atr){return field.attr(atr);};

    /* метод для определения позиции поля
    # возвращает true, если аттрибут существует, иначе возвращает false */
    var _CheckPosition = function(field,optionPosition){
        var position;
        if(_IssetAttr(field,prv.atr.error_position) && !_ValidEmpty(field.attr(prv.atr.error_position))){
            position = field.attr(prv.atr.error_position);
        }else {
            position = optionPosition;
        }
        return position;
    };

    /* метод для проверки значения аттрибута на целочисленность и отличие от нуля
    # возвращает true, если аттрибут имеет целочисленное значение и не равен нулю, иначе возвращает false */
    var _IssetAttrNum = function(field,atr){
        if(_IssetAttr(field,atr) && !_ValidEmpty(field.attr(atr))){
          if(field.attr(atr) == 0) return false;
          return _ValidReg($.SV_MegaValidator.defaults.typeField.numceil.reg,field.attr(atr));
        }else{
          return false;
        }
    };

    /* метод для определения окончания слова
    # возвращает окончание */
    var _suffixOf = function ($number, $suffix) {
        var $keys = [2, 0, 1, 1, 1, 2];
        var $mod = $number % 100;
        var $suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[Math.min($mod % 10, 5)];
        return $suffix[$suffix_key];
    };



    /* метод для построения html конструкции ошибки при режиме валидации 'all'
    # ничего не возвращает */
    var _ErrorWriteHtmlOneField = function(obj,text){
      obj.wrap('<div class="'+prv.cls.field_wrap+'"/>');
      obj.parents('.'+prv.cls.field_wrap).prepend('<div class="'+prv.cls.error_box+'"></div>');
      obj.parents('.'+prv.cls.field_wrap).find(('.'+prv.cls.error_box)).prepend('<div class="'+prv.cls.error+'">'+text+'</div><span class="tringle"></span>');
    };

    /* метод обработки строки ошибки
    # возвращает обработанную строку */
    var _ErrorString = function(text){
      return '<div class="'+prv.cls.error+'">'+text+'</div>';
    };

    /* метод для обработки нескольких ошибок
    # возвращает обработанную строку */
    var _ErrorWrapData = function(error){
      return '<div class="'+prv.cls.error_box+'">'+error+'<div class="tringle"></div></div>';
    };

    /* метод для обработки нескольких ошибок
    # ничего не возвращает */
    var _ErrorWrapDataOne = function(field,error,option){
      var obj = _ErrorWrapField(field);
      var position = _CheckPosition(field,option.absPosError.posField);
      if(position == 'bottom'){
        obj.append(_ErrorWrapData(error));
      }else{
        obj.prepend(_ErrorWrapData(error));
      }

    };

    /* метод для стилизации ошибок
    # ничего не возвращает */
    var _ErrorStyle = function(box,option){
      if(!_ValidEmpty(option.css.errorField.font.reduct)) {
        box.css({'font':option.css.errorField.font.reduct});
      }
      if(!_ValidEmpty(option.css.errorField.font.family)) {
        box.css({'font-family':option.css.errorField.font.family});
      }
      if(!_ValidEmpty(option.css.errorField.font.size)) {
        box.css({'font-size':option.css.errorField.font.size});
      }
      if(!_ValidEmpty(option.css.errorField.font.style)) {
        box.css({'font-style':option.css.errorField.font.style});
      }
      if(!_ValidEmpty(option.css.errorField.font.weight)) {
        box.css({'font-weight':option.css.errorField.font.weight});
      }
      if(!_ValidEmpty(option.css.errorField.font.transform)) {
        box.css({'text-transform':option.css.errorField.font.transform});
      }
      if(!_ValidEmpty(option.css.errorField.font.lineHeight)) {
        box.css({'line-height':option.css.errorField.font.lineHeight});
      }
      if(!_ValidEmpty(option.css.errorField.font.color)) {
        box.css({'color':option.css.errorField.font.color});
      }

      if(!_ValidEmpty(option.css.errorField.font.text_shadow)) {
        box.css({'text-shadow':option.css.errorField.font.text_shadow});
      }
      if(!_ValidEmpty(option.css.errorField.background)) {
        if(option.mode.validate == 'Every'){
           box.css({'background':option.css.errorField.background});
           if(option.absPosError.posField == 'top'){
             box.find('.tringle').css({'border-top-color':option.css.errorField.background});
           }else if(option.absPosError.posField == 'bottom'){
             box.find('.tringle').css({'border-bottom-color':option.css.errorField.background});
           }else if(option.absPosError.posField == 'left'){
             box.find('.tringle').css({'border-left-color':option.css.errorField.background});
           }else if(option.absPosError.posField == 'right'){
             box.find('.tringle').css({'border-right-color':option.css.errorField.background});
           }
        }
      }
      if(!_ValidEmpty(option.css.errorField.radius)) {box.css({'border-radius':option.css.errorField.radius});}
      if(!_ValidEmpty(option.css.errorField.shadow)) {box.css({'box-shadow':option.css.errorField.shadow});}
      if(!_ValidEmpty(option.css.errorField.padding)) {box.css({'padding':option.css.errorField.padding});}
      if(!_ValidEmpty(option.css.errorField.margin.reduct)) {box.css({'margin':option.css.errorField.margin.reduct});}
      if(!_ValidEmpty(option.css.errorField.margin.left)) {box.css({'margin-left':option.css.errorField.margin.left});}
      if(!_ValidEmpty(option.css.errorField.margin.right)) {box.css({'margin-right':option.css.errorField.margin.right});}
      if(!_ValidEmpty(option.css.errorField.margin.top)) {box.css({'margin-top':option.css.errorField.margin.top});}
      if(!_ValidEmpty(option.css.errorField.margin.bottom)) {box.css({'margin-bottom':option.css.errorField.margin.bottom});}

    };

    /* метод для стилизации полей ошибок
    # ничего не возвращает */
    var _TextFieldStyle = function(field,option,mode){
      if(mode == 'error'){
          if(!_ValidEmpty(option.css.textField.error.border)) {field.css({'border':option.css.textField.error.border});}
          if(!_ValidEmpty(option.css.textField.error.color)) {field.css({'color':option.css.textField.error.color});}
          if(!_ValidEmpty(option.css.textField.error.background)) {field.css({'background':option.css.textField.error.background});}
          if(!_ValidEmpty(option.css.textField.error.shadow)) {field.css({'box-shadow':option.css.textField.error.shadow});}
      }else if(mode == 'success'){
          if(!_ValidEmpty(option.css.textField.success.border)) {field.css({'border':option.css.textField.success.border});}
          if(!_ValidEmpty(option.css.textField.success.color)) {field.css({'color':option.css.textField.success.color});}
          if(!_ValidEmpty(option.css.textField.success.background)) {field.css({'background':option.css.textField.success.background});}
          if(!_ValidEmpty(option.css.textField.success.shadow)) {field.css({'box-shadow':option.css.textField.success.shadow});}
      }
    };


    /* метод добавления типа поля */
    $.SV_MegaValidator.AddTypeField = function(typeObj){
         for(var key in typeObj){
            if(!$.SV_MegaValidator.defaults.typeField.hasOwnProperty(key)){
               if(!typeObj[key].hasOwnProperty('reg') || _ValidEmpty(typeObj[key]['reg'])){
                 console.error('$.SV_MegaValidator.Error - ОШИБКА у переданного типа поля - '+key+' отсутствует свойство reg, либо оно пустое');
               }else if(!typeObj[key].hasOwnProperty('noreg_text') || _ValidEmpty(typeObj[key]['noreg_text'])){
                 console.error('$.SV_MegaValidator.Error - ОШИБКА у переданного типа поля - '+key+' отсутствует свойство noreg_text, либо оно пустое');
               }else{
                 $.SV_MegaValidator.defaults.typeField[key] = typeObj[key];
               }
            }else{
               console.error('$.SV_MegaValidator.Error - ОШИБКА переданный тип поля - '+key+' уже существует');
            }
         }
         return $.SV_MegaValidator.defaults.typeField;
    };


    $.SV_MegaValidator.MaskShow = function(options){
        var _default = {
            effectShow:'show',
            preloader:true,
            time:0,
            timeMessage:500,
            effectClose:'hide',
            effectMessageClose:'fadeOut',
            clickClose:true,
            css:false,
            callBack:function(mask){},
            callBackClick:function(mask){}
        },
        setting = $.extend(true,{},_default,options);

        if(!$('.sv-valid-message-mask').length){
            $('body').append('<div class="sv-valid-message-mask"></div>');
            if(setting.clickClose){
                $('.sv-valid-message-mask').click(function() {
                    setting.callBackClick($(this))
                    if($('.sv-valid-message-box').length){
                       $.SV_MegaValidator.MessageClose({
                          effect:setting.effectMessageClose,
                          time:setting.timeMessage,
                          callBack:function(box){
                              $.SV_MegaValidator.MaskClose({effect:setting.effectClose,time:setting.time});
                          }
                       });
                    }else{
                      $.SV_MegaValidator.MaskClose({effect:setting.effectClose,time:setting.time});
                    }

                });
            }
        }

        if(setting.preloader) $('.sv-valid-message-mask').addClass('loading');
        if(setting.css && typeof(setting.css) === 'object' && !$.isEmptyObject(setting.css)) $('.sv-valid-message-mask').css(setting.css);
        if(setting.effectShow == 'fadeIn') {
          $('.sv-valid-message-mask').fadeIn(setting.time,function(){setting.callBack($(this)); });
        }else if(setting.effectShow == 'show') {
          $('.sv-valid-message-mask').show(setting.time,function(){setting.callBack($(this));});
        }
    };

    $.SV_MegaValidator.MaskClose = function(options){
        var _default = {
            effect:'hide',
            time:0,
            callBack:function(mask){}
        },
        setting = $.extend(true,{},_default,options);

        if(!$('.sv-valid-message-mask').length) return;

        if(setting.effect == 'fadeOut') {
          $('.sv-valid-message-mask').fadeOut(setting.time,function(){setting.callBack($(this));});
        }else if(setting.effect == 'hide') {
          $('.sv-valid-message-mask').hide(setting.time,function(){setting.callBack($(this));});
        }
    };

    $.SV_MegaValidator.MessageShow = function(options){
        var _default = {
          title:'Сообщение',
          text:'',
          round:true,
          linkClose:true,
          effect:'fadeIn',
          time:500,
          timeMaskClose:0,
          effectMaskClose:'hide',
          effectMessageClose:'fadeOut',
          buttonOk:true,
          buttonOkText:'ок',
          buttonClickClose:true,
          styleClass:'info',
          css:false,
          cssTitle:false,
          cssText:false,
          callBack:function(box){},
          callBackClick:function(link){}
        },
        setting = $.extend(true,{},_default,options),
        html = '<div class="sv-valid-message-box">';
        if(setting.title) html += '<div class="sv-valid-message-title">'+setting.title+'</div>';
        if(setting.linkClose) html += '<div class="sv-valid-message-close"></div>';
        if(setting.text) html += '<div class="sv-valid-message-text">'+setting.text+'</div>';
        if(setting.buttonOk) html += '<div class="sv-valid-message-button-box"><button class="sv-valid-message-button">'+setting.buttonOkText+'</button></div>';
        else {
          console.error('$.SV_MegaValidator.Error :: Не найден контент для вывода сообщения!');
          return false;
        }
        html += '</div>';
        var $class = '';
        $('body').append(html);
        MaxContent();
        $(window).resize(function(){
            $('.sv-valid-message-box').css({'top':'50%'});
            $('.sv-valid-message-button-box').removeClass('a-off');
            $('.sv-valid-message-box,.sv-valid-message-text').css({'height':'auto'});
            MaxContent();
        });
        function MaxContent(){
          var w_box = $('.sv-valid-message-box').width(),
            h_box = $('.sv-valid-message-box').height(),
            h_box_content = h_box - $('.sv-valid-message-title').height(),
            ml = w_box/2, mt = h_box/2;
          $('.sv-valid-message-box').css({'margin-left':'-'+ml+'px','margin-top':'-'+mt+'px'});
          if(h_box > $(window).height()) {
            $('.sv-valid-message-box').css({'top':'10px','margin-top':0,'height':$(window).height - 20});
            var max_content = $(window).height() - 60 - $('.sv-valid-message-title').height() - $('.sv-valid-message-button-box').height();
            $('.sv-valid-message-text').css({'overflow':'auto','height':max_content+'px'});
            $('.sv-valid-message-button-box').addClass('a-off');
          }
        }
        if(setting.css && typeof(setting.css) === 'object' && !$.isEmptyObject(setting.css)) $('.sv-valid-message-box').css(setting.css);
        if(setting.cssTitle && typeof(setting.cssTitle) === 'object' && !$.isEmptyObject(setting.cssTitle)) $('.sv-valid-message-box').css(setting.cssTitle);
        if(setting.cssText && typeof(setting.cssText) === 'object' && !$.isEmptyObject(setting.cssText)) $('.sv-valid-message-box').css(setting.cssText);
        $('.sv-valid-message-box').hide();
        if(setting.linkClose){
            $('.sv-valid-message-close').click(function() {
                    setting.callBackClick($(this));
                    if($('.sv-valid-message-mask').length){
                      $.SV_MegaValidator.MessageClose({
                        effect:setting.effectMessageClose,
                        time:setting.timeMessageClose,
                        callBack:function(box){
                            $.SV_MegaValidator.MaskClose({effect:setting.effectMaskClose,time:setting.timeMaskClose});
                        }
                      });
                    }else{
                      $.SV_MegaValidator.MessageClose({effect:setting.effectMessageClose,time:setting.time});
                    }
            });
        }
        if(setting.buttonClickClose){
            $('.sv-valid-message-button').click(function() {
                  if($('.sv-valid-message-mask').length){
                    $.SV_MegaValidator.MessageClose({
                      effect:setting.effectMessageClose,
                      time:setting.timeMessageClose,
                      callBack:function(box){
                          $.SV_MegaValidator.MaskClose({effect:setting.effectMaskClose,time:setting.timeMaskClose});
                      }
                    });
                  }else{
                    $.SV_MegaValidator.MessageClose({effect:setting.effectMessageClose,time:setting.time});
                  }
            });
        }
        switch(setting.styleClass){
          case 'info':
            $class = 'info';
            break;
          case 'error':
            $class = 'error';
            break;
          case 'success':
            $class = 'success';
            break;
          default:
            $class = 'default';
        }
        $('.sv-valid-message-box').addClass($class);
        if(setting.round) $('.sv-valid-message-box').addClass('round');
        if(setting.effect == 'fadeIn') {
          $('.sv-valid-message-box').fadeIn(setting.time,function(){
            setting.callBack($(this));
            if($('.sv-valid-message-mask').hasClass('loading')) $('.sv-valid-message-mask').removeClass('loading');
          });
        }else if(setting.effect == 'show') {
          $('.sv-valid-message-box').show(setting.time,function(){
            setting.callBack($(this));
            if($('.sv-valid-message-mask').hasClass('loading')) $('.sv-valid-message-mask').removeClass('loading');
          });
        }
    };

    $.SV_MegaValidator.MessageClose = function(options){
        var _default = {
          effect:'fadeOut',
          callBack:function(box){}
        },
        setting = $.extend(true,{},_default,options);
        if(setting.effect == 'fadeOut') {
          $('.sv-valid-message-box').fadeOut(setting.time,function(){setting.callBack($(this));$(this).remove();});
        }else if(setting.effect == 'hide') {
          $('.sv-valid-message-box').hide(setting.time,function(){setting.callBack($(this));$(this).remove();});
        }
    };


    /* метод встроенного ajax запроса
    # ничего не возвращает */
    var _AjaxSend = function(form,data,option){

        if(_ValidEmpty(option.ajaxSend.url)){
            console.error('$.SV_MegaValidator.Error :: Не указан путь до обработчика формы!');
            return false;
        }
        if(option.ajaxSend.message.stat && option.ajaxSend.message.mask.stat){
          $.SV_MegaValidator.MaskShow({
              effectShow:option.ajaxSend.message.mask.effectShow,
              preloader:option.ajaxSend.message.mask.preloader,
              time:option.ajaxSend.message.mask.time,
              timeMessage:option.ajaxSend.message.box.time,
              effectMessageClose:option.ajaxSend.message.box.effectClose,
              effectClose:option.ajaxSend.message.mask.effectClose,
              clickClose:option.ajaxSend.message.mask.clickClose,
              css:option.ajaxSend.message.mask.css,
              callBack:function(mask){option.ajaxSend.message.mask.callBackShow();},
              callBackClick:function(mask){option.ajaxSend.message.mask.callBackClick();}
          });
        }
        var formdata, processData = true, contentType = true;
        /*if(window.FormData) {
           formdata = new FormData(form[0]);
           processData = false,contentType = false;
        }else{*/
           formdata = form.serializeArray();
           console.log(formdata);
        /*}*/
        /*if (!Array.indexOf) { //поддержка indexOf обособливо для ие, нужно будет для проверки расширения
            Array.prototype.indexOf = function (obj, start) {
                for (var i = (start || 0); i < this.length; i++) {
                    if (this[i] == obj) {
                        return i;
                    }
                }
                return -1;
            }
        }
        $(':file').each(function(x){
              var i = $(this).children('input'); //это импут
              var d = $('.indicator', this); //это индикатор
              var a = ['jpg', 'png', 'zip']; //массив разрешенных расширений для клиентской проверки
              var form = $('<form action="async-upload" method="post" enctype="multipart/form-data" target="iframe-name' + x + '"></form>');

              i.before('<iframe name="iframe-name' + x + '" src="#"></iframe>').delay(1500).wrap(form).parent().append(d);
              var $s = function(){ //проверка данных и сабмит формы
              var ext = i.val().split('.').pop();
              if (a.indexOf(ext) == -1){ //сама проверка расшерения
                  i.parent().each(
                      function(){
                            this.reset();
                      }
                  );
                  return alert('недопустимое расширение файла!');
              }
              i.parent().addClass('progress');
              $(this).parent().submit().prev().one('load',
                  function(){
                      i.parent().removeClass('progress');
                      $(this).next()[0].reset(); //очищает инпут для того что бы не сабмитить файл в родительской форме
                      alert($(this).contents().find('body').html()); //вывод алертом сообщения от сервера, загруженного во фрейм
                  }
              );
              }
              i.change($s);//обработчик на изменения файл инпута
        });*/
        $.ajax({
              type:option.ajaxSend.type,
              url:option.ajaxSend.url,
              processData: processData,
              contentType: contentType,
              data:formdata,
              success:function(data){
                option.callBack.ajaxSendBefore(form,data);
                if(option.mode.clearField) {
                  form.find('input,textarea').not(':submit,:hidden,:disabled').val('');
                  if(option.mode.validate == 'Every'){
                        form.find('.'+prv.cls.error_box).remove();
                  }
                  form.find('.'+prv.cls.error_field).removeAttr('style').removeClass(prv.cls.error_field);
                  form.find('.'+prv.cls.success_field).removeAttr('style').removeClass(prv.cls.success_field);
                }
                /* если выбран показ сообщения после отправки */
                if(option.ajaxSend.message.stat){
                     var message = '',title='',$class = '';
                     if(option.ajaxSend.message.outFile){
                       if(data.status){
                          title = data.message.success.title;
                          message = data.message.success.text;
                          $class = 'success';
                       }else{
                          title = data.message.error.title;
                          message = data.message.error.text;
                          $class = 'error';
                       }
                     }else{
                        title = option.ajaxSend.message.title;
                        message = option.ajaxSend.message.text;
                        $class = option.ajaxSend.message.box.styleClass;
                     }

                     $.SV_MegaValidator.MessageShow({
                          title:title,
                          text:message,
                          round:option.ajaxSend.message.box.round,
                          linkClose:option.ajaxSend.message.box.linkClose,
                          effect:option.ajaxSend.message.box.effectShow,
                          time:option.ajaxSend.message.box.time,
                          timeMaskClose:option.ajaxSend.message.mask.time,
                          timeMessageClose:option.ajaxSend.message.box.time,
                          effectMaskClose:option.ajaxSend.message.mask.effectClose,
                          effectMessageClose:option.ajaxSend.message.box.effectClose,
                          buttonOk:option.ajaxSend.message.box.buttonOk,
                          buttonOkText:option.ajaxSend.message.box.buttonOkText,
                          buttonClickClose:option.ajaxSend.message.box.buttonClickClose,
                          styleClass:$class,
                          callBack:function(box){option.ajaxSend.message.box.callBack(box);},
                          callBackClick:function(link){option.ajaxSend.message.box.callBackClick(link);}
                     });

                }
                option.callBack.ajaxSendAfter(form,data);
              },
              error:function(data){
                console.error('$.SV_MegaValidator.Error :: Не найден обработчик формы, возможно не верно указан путь до обработчика формы!');
              }
           });

    };

    /* метод для добавления списка ошибок
    # ничего не возвращает */
    var _ErrorWrapDataAll = function(form,error){
      form.prepend(_ErrorWrapData(error));
      form.find('.'+prv.cls.error_box).addClass('sv-position-top').addClass('sv-error-all');
    };

    /* метод обертки поля с ошибкой
    # возвращает блок(обертку) c ошибкой */
    var _ErrorWrapField = function(field){
      if(!field.parents('.'+prv.cls.field_wrap).length){
        field.wrap('<div class="'+prv.cls.field_wrap+'"/>');
      }
      return field.parent();
    };


    /* метод для деинсталяции поля
    # ничего не возвращает */
    $.SV_MegaValidator.DestructField = function(field,option){
      var option = $.extend(true,{},$.SV_MegaValidator.defaults,option),ItogField;
      if(option.stylerAdapt.stat){
          if(field.is(':checkbox') && field.parent().hasClass(option.stylerAdapt.selector.checkbox)){
            ItogField = field.parents('.'+option.stylerAdapt.selector.checkbox);
          }else if(field.is(':radio') && field.parent().hasClass(option.stylerAdapt.selector.radio)) {
           ItogField = field.parents('.'+option.stylerAdapt.selector.radio);
          }else if(field.is(':file') && field.parent().hasClass(option.stylerAdapt.selector.file)) {
           ItogField = field.parents('.'+option.stylerAdapt.selector.file);
          }else if(field.is('select') && field.parent().hasClass(option.stylerAdapt.selector.select)) {
            ItogField = field.parents('.'+option.stylerAdapt.selector.select);
          }else{
            ItogField = field;
          }
      }else{
          ItogField = field;
      }
      if(option.mode.validate == 'Every' && ItogField.siblings('.'+prv.cls.error_box).length){
            ItogField.siblings('.'+prv.cls.error_box).remove();
      }
      if(ItogField.hasClass(prv.cls.error_field)){
         ItogField.removeAttr('style').removeClass(prv.cls.error_field);
      }
      if(ItogField.hasClass(prv.cls.success_field)){
         ItogField.removeAttr('style').removeClass(prv.cls.success_field);
      }
    };




    /* метод валидации формы
    # возвращает true, если форма валидна, иначе возвращает false */
    var _ValidForm = function(form,option){
       form.on('submit',function(e){
            var rezult = $.SV_MegaValidator.Validate($(this),option);
            /* отключаем стандартную отправку формы */
            if(!option.mode.defaultSubmit){e.preventDefault();}
            if(rezult['status']){
              /* если включен режим встроенной отправки данных */
              if(option.ajaxSend.stat){
                 e.preventDefault();
                _AjaxSend(form,rezult['values'],option);
              }else if(!option.mode.localInit){
                 option.callBack.Success(form,rezult['values']);
              }
            }else{
              option.callBack.Error(form,rezult['values'],rezult['error_string'],rezult['error_object']);
            }
            return rezult['status'];
       });
    };

    /* метод валидации секции(блока)
    # возвращает true, если секция валидна, иначе возвращает false */
    var _ValidSection = function(form,submitButton,option){
       if($.isEmptyObject(submitButton)){
            var formName = '';
            if(form.attr('id')){
               formName = ' - $(\'#'+form.attr('id')+'\')';
            }else if(form.attr('class')){
               formName = ' - $(\'.'+form.attr('class')+'\')';
            }
         console.error('$.SV_MegaValidator.Error :: Ошибка в секции'+formName+' : Для валидации необходимо задать опцию - submit_button ( объект, по клику на который должна происходить валидация ) !');
         return;
       }
       submitButton.on('click',function(e){
            e.preventDefault();
            var rezult = $.SV_MegaValidator.Validate(form,option);
            if(rezult['status']){
              option.callBack.Success(form,rezult['values']);
            }else{
              option.callBack.Error(form,rezult['values'],rezult['error_string'],rezult['error_object']);
            }
            return rezult['status'];
       });
    };

    /* метод валидации одного поля
    # возвращает объект ошибок */
    $.SV_MegaValidator.Render = function(field,option){
      var option = $.extend(true,{},$.SV_MegaValidator.defaults,option),
          ArrParam = {},
          value = field.val(),
          nameField = (_IssetAttr(field,prv.atr.name) && !_ValidEmpty(field.attr(prv.atr.name))) ? field.attr(prv.atr.name) : '',
          unit = option.text.unit;

      ArrParam['status'] = true;
      ArrParam['error_text'] = '',
      ArrParam['error_text_wrap']='';

      $.SV_MegaValidator.DestructField(field,option);

      /* если чекбокс */
      if(field.is(':checkbox')){
            if(field.attr(prv.atr.req) == 'on' && !field.prop('checked')){
                /* если у поля задан аттрибут prv.atr.empty_text, то берем текст ошибки из его значения */
                if(_IssetAttr(field,prv.atr.empty_text) && !_ValidEmpty(field.attr(prv.atr.empty_text))){
                   ArrParam['error_text'] = field.attr(prv.atr.empty_text);
                /* если не задан, то берем текст ошибки из опций option.empty_text*/
                }else{
                   ArrParam['error_text'] = option.text.empty;
                }
                /* заменяем переменную имени поля #NAME# если есть */
                ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);
                ArrParam['status'] = false;
            }
      }
      /* если радиобокс */
      else if(field.is(':radio')){
                /* в разработке */
         var RadioName = _IssetAttr(field,'name') ? field.attr('name') : false;
         if(field.attr(prv.atr.req) == 'on' && RadioName && !_IssetAttr(field,'data-radio-valid') && !$('[name="'+RadioName+'"]:checked').length){
                $('[name="'+RadioName+'"]').attr('data-radio-valid','on');
                /* если у поля задан аттрибут prv.atr.empty_text, то берем текст ошибки из его значения */
                if(_IssetAttr(field,prv.atr.empty_text) && !_ValidEmpty(field.attr(prv.atr.empty_text))){
                   ArrParam['error_text'] = field.attr(prv.atr.empty_text);
                /* если не задан, то берем текст ошибки из опций option.empty_text*/
                }else{
                   ArrParam['error_text'] = option.text.empty;
                }
                /* заменяем переменную имени поля #NAME# если есть */
                ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);
                ArrParam['status'] = false;
            }
      }
      /* иначе */
      else {
            /* проверяем на пустоту */
            if(field.attr(prv.atr.req) == 'on' && _ValidEmpty(value)){
                /* если у поля задан аттрибут prv.atr.empty_text, то берем текст ошибки из его значения */
                if(_IssetAttr(field,prv.atr.empty_text) && !_ValidEmpty(field.attr(prv.atr.empty_text))){
                   ArrParam['error_text'] = field.attr(prv.atr.empty_text);
                /* если не задан, то берем текст ошибки из опций option.empty_text*/
                }else{
                   ArrParam['error_text'] = option.text.empty;
                }
                /* заменяем переменную имени поля #NAME# если есть */
                ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);

                ArrParam['status'] = false;
            }else if(!_ValidEmpty(value)){
                /* проверка на минимальную длину */
                if(_IssetAttrNum(field,prv.atr.min) && !_ValidMinLength(field.attr(prv.atr.min),value)){
                      if(_IssetAttr(field,prv.atr.min_text) && !_ValidEmpty(field.attr(prv.atr.min_text))){
                        ArrParam['error_text'] = field.attr(prv.atr.min_text);
                      }else{
                        ArrParam['error_text'] = option.text.min;
                      }

                      /* заменяем переменную имени поля #NAME# если есть */
                      if(ArrParam['error_text'].indexOf('#NAME#') != -1){
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);
                      }
                      /* заменяем переменную миним. кол-ва символов #MIN# если есть */
                      if(ArrParam['error_text'].indexOf('#MIN#') != -1){
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#MIN#/g,field.attr(prv.atr.min));
                      }
                      /* заменяем переменную миним. кол-ва символов #UNIT# если есть */
                      if(ArrParam['error_text'].indexOf('#UNIT#') != -1){
                        unit = unit + _suffixOf(parseInt(field.attr(prv.atr.min)), option.text.suffix);
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#UNIT#/g,unit);
                      }

                      ArrParam['status'] = false;
                }/* проверка на максимальную длину */
                else if(_IssetAttrNum(field,prv.atr.max) && !_ValidMaxLength(field.attr(prv.atr.max),value)){
                      if(_IssetAttr(field,prv.atr.max_text) && !_ValidEmpty(field.attr(prv.atr.max_text))){
                         ArrParam['error_text'] = field.attr(prv.atr.max_text);
                      }else{
                         ArrParam['error_text'] = option.text.max;
                      }

                      /* заменяем переменную имени поля #NAME# если есть */
                      if(ArrParam['error_text'].indexOf('#NAME#') != -1){
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);
                      }
                      /* заменяем переменную миним. кол-ва символов #MAX# если есть */
                      if(ArrParam['error_text'].indexOf('#MAX#') != -1){
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#MAX#/g,field.attr(prv.atr.max));
                      }
                      /* заменяем переменную миним. кол-ва символов #UNIT# если есть */
                      if(ArrParam['error_text'].indexOf('#UNIT#') != -1){
                        unit = unit + _suffixOf(parseInt(field.attr(prv.atr.max)), option.text.suffix);
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#UNIT#/g,unit);
                      }

                      ArrParam['status'] = false;

                }/* проверка по пользовательскому регулярному выражению */
                else if(_IssetAttr(field,prv.atr.reg) && !_ValidEmpty(field.attr(prv.atr.reg))){
                     var new_reg = new RegExp(field.attr(prv.atr.reg));
                     if(!_ValidReg(new_reg,value)){
                        /* если у поля задан аттрибут prv.atr.noreg_text, то берем текст ошибки из его значения */
                        if(_IssetAttr(field,prv.atr.noreg_text) && !_ValidEmpty(field.attr(prv.atr.noreg_text))){
                           ArrParam['error_text'] = field.attr(prv.atr.noreg_text);
                        /* если не задан, то берем текст ошибки из опций option.noreg_text*/
                        }else{
                           ArrParam['error_text'] = option.text.noreg;
                        }
                        /* заменяем переменную имени поля #NAME# если есть */
                        ArrParam['error_text'] = ArrParam['error_text'].replace(/#NAME#/g,nameField);
                        ArrParam['status'] = false;

                     }
                }/* проверка по системным типам данных (системным регулярным выражениям) */
                else if(!_IssetAttr(field,prv.atr.reg) && _IssetAttr(field,prv.atr.type) && !_ValidEmpty($(this).attr(prv.atr.type))){
                    /* проверяем есть ли у нас переданный тип поля */
                    if(option.typeField.hasOwnProperty(field.attr(prv.atr.type))){
                      if(!_ValidReg(option.typeField[field.attr(prv.atr.type)]['reg'],value)){
                        var noreg_text_type = 'noreg_text_'+field.attr(prv.atr.type);
                        /* если у поля задан аттрибут prv.atr.noreg_text, то берем текст ошибки из его значения */
                        if(_IssetAttr(field,prv.atr.noreg_text) && !_ValidEmpty(field.attr(prv.atr.noreg_text))){
                           ArrParam['error_text'] = field.attr(prv.atr.noreg_text);
                        /* если не задан, то берем текст ошибки из опций option.text.noreg*/
                        }else{
                           ArrParam['error_text'] = option.typeField[field.attr(prv.atr.type)]['noreg_text'];
                        }
                        ArrParam['status'] = false;
                      }
                    }else{
                       console.error('$.SV_MegaValidator.Error - ОШИБКА переданный тип поля - '+field.attr(prv.atr.type)+' не найден');
                    }
                }
           }
      }
      var ItogField;
      if(option.stylerAdapt.stat){
          if(field.is(':checkbox') && field.parent().hasClass(option.stylerAdapt.selector.checkbox)){
            ItogField = field.parents('.'+option.stylerAdapt.selector.checkbox);
          }else if(field.is(':radio') && field.parent().hasClass(option.stylerAdapt.selector.radio)) {
           ItogField = field.parents('.'+option.stylerAdapt.selector.radio);
          }else if(field.is(':file') && field.parent().hasClass(option.stylerAdapt.selector.file)) {
           ItogField = field.parents('.'+option.stylerAdapt.selector.file);
          }else if(field.is('select') && field.parent().hasClass(option.stylerAdapt.selector.select)) {
            ItogField = field.parents('.'+option.stylerAdapt.selector.select);
          }else{
            ItogField = field;
          }
      }else{
          ItogField = field;
      }
      if(!ArrParam['status']){
          ArrParam['error_text_wrap'] = _ErrorString(ArrParam['error_text']);

          if(option.mode.validate =='Every'){
            _ErrorWrapDataOne(ItogField,ArrParam['error_text_wrap'],option);
          }
          if(option.mode.focusFieldDestructOne){
              field.on('focusin',function() {
                  $.SV_MegaValidator.DestructField($(this),option);
              });
          }
          if(option.fade.stat){
          setTimeout(function(){
                  ItogField.siblings().fadeOut(option.fade.timeShow*1000,function(){
                          $.SV_MegaValidator.DestructField(field,option);
                    });
          },option.fade.timeOut*1000);
        }
          if(option.mode.addClassesField) ItogField.addClass(prv.cls.error_field);
          /* стилизация сообщений об ошибке */
          _ErrorStyle(ItogField.siblings('.'+prv.cls.error_box),option);
          /* стилизация полей с ошибками */
          _TextFieldStyle(ItogField,option,'error');
          /* определение позиции сообщений об ошибке */
          var position = _CheckPosition(field,option.absPosError.posField);
          ItogField.siblings('.'+prv.cls.error_box).addClass('sv-position-'+position);
      }else if(option.mode.addClassesField) {
        if(!_ValidEmpty(field.val()) && (_IssetAttr(field,prv.atr.req) || _IssetAttr(field,prv.atr.type) || _IssetAttr(field,prv.atr.reg) || _IssetAttr(field,prv.atr.min) || _IssetAttr(field,prv.atr.max))){
               ItogField.addClass(prv.cls.success_field);
               if(option.fade.stat){
              setTimeout(function(){
                        $.SV_MegaValidator.DestructField(ItogField,option);
              },option.fade.timeOut*1000);
             }
               /* стилизация полей прошедших валидацию */
               _TextFieldStyle(ItogField,option,'success');
        }

      }
      return ArrParam;
    };

    /* метод непосредственной валидации
    # возвращает объект ошибок и значений */
    $.SV_MegaValidator.Validate = function(form,options){

       var option = $.extend(true,{},$.SV_MegaValidator.defaults,options),ArrParam = {},i = 1;


       ArrParam['status'] = true;
       ArrParam['error_string'] = '';
       ArrParam['error_object'] = {};
       ArrParam['values'] = {};

       if(form.find('.sv-error-all').length){
           form.find('.sv-error-all').remove();
       }

       form.find('input,select,textarea').not(':submit,:hidden,:disabled').each(function(){
           var render = {}, value = $(this).val();
           render = $.SV_MegaValidator.Render($(this),option);
           if(!_ValidEmpty(render['error_text'])) ArrParam['status'] = false;

           /* записываем строку и объект ошибок в параметры  */
           if(!_ValidEmpty(render['error_text'])){
                ArrParam['error_string'] += render['error_text_wrap'];
                ArrParam['error_object']['error'+i] = render['error_text'];
           }
           i++;
       });
       /* вывод ошибок при режиме валидации 'all' */
       if(option.mode.validate =='All' && !ArrParam['status']){
            _ErrorWrapDataAll(form,ArrParam['error_string']);
            if(form.find('.sv-error-all').length){
               if(option.fade.stat){
              setTimeout(function(){
                      form.find('.sv-error-all').fadeOut(option.fade.timeShow*1000,function(){
                              $(this).remove();
                              $.SV_MegaValidator.DestructField(form.find('.sv-error-field'),option);
                        });
              },option.fade.timeOut*1000);
            }
           }
       }
       /* вывод ошибок при режиме валидации 'Out-Modal' */
       if(option.mode.validate =='Out-Modal' && !ArrParam['status']){
           $.SV_MegaValidator.MaskShow({
                effectShow:option.ajaxSend.message.mask.effectShow,
                preloader:option.ajaxSend.message.mask.preloader,
                time:option.ajaxSend.message.mask.time,
                timeMessage:option.ajaxSend.message.box.time,
                effectMessageClose:option.ajaxSend.message.box.effectClose,
                effectClose:option.ajaxSend.message.mask.effectClose,
                clickClose:option.ajaxSend.message.mask.clickClose,
                css:option.ajaxSend.message.mask.css,
                callBack:function(mask){option.ajaxSend.message.mask.callBackShow();},
                callBackClick:function(mask){option.ajaxSend.message.mask.callBackClick();}
           });
      
           $.SV_MegaValidator.MessageShow({
                title:option.ajaxSend.message.box.errorTitle,
                text:ArrParam['error_string'],
                round:option.ajaxSend.message.box.round,
                linkClose:option.ajaxSend.message.box.linkClose,
                effect:option.ajaxSend.message.box.effectShow,
                time:option.ajaxSend.message.box.time,
                timeMaskClose:option.ajaxSend.message.mask.time,
                timeMessageClose:option.ajaxSend.message.box.time,
                effectMaskClose:option.ajaxSend.message.mask.effectClose,
                effectMessageClose:option.ajaxSend.message.box.effectClose,
                buttonOk:option.ajaxSend.message.box.buttonOk,
                buttonOkText:option.ajaxSend.message.box.buttonOkText,
                buttonClickClose:option.ajaxSend.message.box.buttonClickClose,
                styleClass:'error',
                callBack:function(box){option.ajaxSend.message.box.callBack(box);},
                callBackClick:function(link){option.ajaxSend.message.box.callBackClick(link);}
           });
       }

       /* сериализация формы */
       ArrParam['values'] = /*(window.FormData) ? new FormData(form[0]) :*/ form.serializeArray();
       if(option.scrollToErrorField.stat && !ArrParam['status'] && (option.mode.validate =='Every' || option.mode.validate =='All') && form.attr('data-scrolltofielderror') != "no"){
            var offs = form.find('.'+prv.cls.error_box).eq(0).offset().top - option.scrollToErrorField.indent;
            $('html, body').animate({scrollTop: offs}, option.scrollToErrorField.time);
       }


        if(option.mode.localInit){
            if(option.absPosError.stat) form.find('.'+prv.cls.field_wrap).addClass(prv.cls.field_wrap_rel);
            if(ArrParam['status']) option.callBack.Success(form);
        }
        return ArrParam;
    };
  /* Public default methods (end) */


  /* calls plugin */
  $.fn.SV_MegaValidator = function(option){
    if(this.length == 0) return;
    var option = $.extend(true,{},$.SV_MegaValidator.defaults,option);
    if(this.length > 1) return this.each(function(){$(this).SV_MegaValidator(option);});
    return _Init(this,option);
  };
  /* calls plugin (end) */
})(jQuery);
/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2013 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
	Version: 1.3.1
*/
(function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery);
//# sourceMappingURL=bundle.js.map
