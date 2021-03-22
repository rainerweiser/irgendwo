(function($) {
    "use strict";
    /*==============================
        Mobile Check
    ==============================*/
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    }

    var is_safari = navigator.userAgent.indexOf("Safari") > -1;

    /*==============================
        Image cover
    ==============================*/
    $.fn.imageCover = function() {
        $(this).each(function() {
            var self = $(this),
                image = self.find('img'),
                heightWrap = self.outerHeight(),
                widthImage = image.outerWidth(),
                heightImage = image.outerHeight();
            if (heightImage < heightWrap) {
                image.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width' : 'initial'
                });
            }
        });
    }

    function RoseLoader() {
        $('.preloader')
            .prepend('<div class="progressFull"></div>');
          setTimeout(function() {
            $('.preloader').fadeOut(1000);
          }, 780);
    }

    // MENU
    function menuArrow() {
        if( $('#header .nav-menu > ul').length ) {
            $('#header .nav-menu > ul .sub-menu').parent('li').find('> a').append('<i class="fa fa-angle-down">');
        }
    }

    function menuMobile() {
        if($('#header .nav-menu > ul').length) {
            var $this = $('#header .nav-menu > ul'),
                $parent = $this.closest('#header'),
                pointbreak = $parent.data('$pointbreak'),
                window_width = window.innerWidth;

            if(typeof pointbreak == 'undefined') {
                pointbreak = 991;
            }

            if(pointbreak >= window_width) {
                $this.addClass('menu-mobile').removeClass('menu');
                $('#header .nav-menu .toggle-menu').css('display', 'block');
            } else {
                $this.addClass('menu').removeClass('menu-mobile').css('display', '');
                $this.find('.sub-menu').css('display', '');
                $('#header .nav-menu .toggle-menu').css('display','');
            }

        }
    }

    function toggleMenumobile() {

        $('#header').on('click', '.toggle-menu', function(event) {
            var $this = $('#header .nav-menu > .menu-mobile');
            if( $this.css('display') == 'block' ) {
                $this.slideUp('300');
            } else {
                $this.slideDown('300');
            }
        });

        $('#header .nav-menu ').on('click', '.menu-mobile a i', function(event) {
            event.preventDefault();
            var $this = $(this),
                $parent = $this.closest('li'),
                $sub_menu = $parent.find('> .sub-menu');
            if( $sub_menu.css('display') == 'none' ) {
                $sub_menu.slideDown('300');
                $this.addClass('active');
            } else {
                $sub_menu.slideUp('300');
                $this.removeClass('active');
            }

            return false;
        });

    }

    // OPACITY
    function setOpacity() {
        $('[data-opacity]').each(function(index, el) {
            var $this= $(this),
                opacity = $this.data('opacity');
            $this.css('opacity', opacity);
        });
    }

    // SLIDER
    function slider() {
        if( $('.slider').length && $('.slider').children().length > 1) {
            $('.slider').owlCarousel({
                loop:true,
                items: 1,
                nav:true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            })
        }
    }

    // SLIDER
    function gallerySlide() {
        if( $('.wiloke-slider-gallery').length && $('.wiloke-slider-gallery').children().length > 1 ) {
            $('.wiloke-slider-gallery').owlCarousel({
                loop:true,
                items: 1,
                nav:true,
                autoHeight: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            })
        }
    }

    // BLOG MASONRY
    function blogMasonry() {
        $('.blog-masonry').each(function(index, el) {
            var $container = $(this);

            $container.imagesLoaded( function() { 
                $container.isotope({
                    itemSelector: '.grid-item',
                });
            });
        });
    }

    // CLIENT
    function client() {
        if( $('.client').length && $('.client').children().length > 1 ) {
            $('.client').owlCarousel({
                loop: true,
                items: 4,
                nav:true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            })
        }
    }

    // SHOW SEARCH and SOCIAL
    function popupSearchSocial() {
        $('.icon-search').on('click', function(event) {
            $('body').toggleClass('search-active');
            setTimeout( function () {
                var el = $('.popup-search .form-search .input-search').get(0);
                var elemLen = el.value.length;
                el.selectionStart = elemLen;
                el.selectionEnd = elemLen;
                el.focus();    
            }, 50);
        });

        $('.icon-share').on('click', function(event) {
            $('body').toggleClass('social-active');
        });

        $('.close-popup').on('click', function(event) {
            $('body').removeClass('search-active social-active');
        });
    }

    function slideTestimonial() {
        if( $('.testimonial-slide').length && $('.testimonial-slide').children().length > 1 ) {
            $('.testimonial-slide').owlCarousel({
                loop: true,
                items: 1,
                nav:true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            })
        }
    }

    function Accordion() {

        if( $('.accordion').length ) {
            $( ".accordion" ).accordion({
                icons: {
                  header: "fa fa-angle-down",
                  activeHeader: "fa fa-angle-up"
                }
            });
        }
    }

    function Tabs() {
        if( $('.tabs').length ) {
            $( ".tabs" ).tabs();
        }
    }

    function hoverInstagram() {
        var $instagram = $('.footer-instagram');

        $('>a', $instagram).hover( function () {
            $('>a', $instagram).not(this).addClass('blurred');
        }, function () {
            $('>a', $instagram).not(this).removeClass('blurred');
        });
    }

    function justifiedGallery() {

        if( $('.wiloke-tiled-gallery').length ) {
            $('.wiloke-tiled-gallery').justifiedGallery({
                margins : 20,
                rowHeight : 200,
                captions: false,
                lastRow : 'justify',
            });

        }
    }

    function parallax() {
        if(isMobile.any() == null) {
            $('.bg-parallax').each(function(index, el) {
                $(this).parallax();
            });
        }
    }

    function footerHeight() {
        if( $('#footer .widget_footer_left').length && $('#footer .widget_footer_right').length ) {
            var window_w = window.innerWidth,
                h_right = $('#footer .widget_footer_right').innerHeight(),
                h_left = $('#footer .widget_footer_left').innerHeight();
            if(window_w > 767) {

                if( h_right > h_left ) {
                    $('#footer .widget_footer_left').height(h_right);
                } else {
                    $('#footer .widget_footer_left').css('height', '');
                }
            } else {
                $('#footer .widget_footer_left').css('height', '');
            }
        }
    }

    if ( !isMobile.any() && !is_safari )
    {
        $(document).on("click", "a", function () {
            var $this = $(this),
                target = $this.attr('target');

            if( $this.closest('.pi-magnific-popup').length <= 0 ) 
            {
                if(typeof target == 'undefined' || target != '_blank') 
                {
                    event.preventDefault();
                    // get the href attribute
                    var newUrl = $(this).attr("href");
                    // veryfy if the new url exists or is a hash
                    if (!newUrl || newUrl[0] === "#") {
                        // set that hash
                        // location.hash = newUrl;
                        return;
                    }

                    // now, fadeout the html (whole page)
                    $("html").fadeOut(function () {
                        // when the animation is complete, set the new location
                        location = newUrl;
                    });

                    // prevent the default browser behavior.
                }
            }
        }); 
    }


    function scrollTop() {
        var height = $(window).innerHeight() / 2,
            scroll = $(window).scrollTop();

        if(scroll > height) {
            $('.scroll-top').addClass('active');
        } else {
            $('.scroll-top').removeClass('active');
        }

         $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('body').stop().animate({scrollTop: 0}, 600);
        });
    }

    function RoseWow() {
        var wow = new WOW({
            mobile:       false, 
        });
        
        wow.init();
    }

    if(typeof pi_post_format_ui_magnific_popup !== "function") {
        if( $(".pi-magnific-popup").length > 0 ) {

            $('.pi-magnific-popup').each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function(item) {
                            return item.el.attr('data-caption');
                        }
                    }
                });
            })
        }
    }

    $(document).ready(function() {
        parallax();
        menuArrow();
        setOpacity();
        popupSearchSocial();
        Accordion();
        Tabs();
        toggleMenumobile();
        hoverInstagram();
        scrollTop();
        RoseWow();
       
    });

    $(window).load(function() {
        RoseLoader();
        slider();
        slideTestimonial();
        client();
        gallerySlide();
        blogMasonry();
        justifiedGallery();
        $('.blog-related .related-post .img, .footer-instagram a').imageCover();
        
    });

    $(window).resize(function(event) {
       menuMobile();
       footerHeight();
    }).trigger('resize');
    
})(jQuery);