/*--------------------- Copyright (c) 2018 -----------------------
[Master Javascript]
Project: Miraculous - Online Music Store Html Template
Version: 1.0.0
Assigned to: Theme Forest
-------------------------------------------------------------------*/
(function($) {
    "use strict";
    var music = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- Music Functions Calling ---------------------------------------------------
            ------------------------------------------------------------------------------------------------*/
            
            this.music_center_Slider();
            this.RTL();
            this.Menu();
            this.Player_close();
            this.Popup();
            this.Slider();
            this.More();
            this.Nice_select();
            this.showPlayList();
            this.volume();
            this.dropdown_toggle();
            this.alsolike_Slider();
            this.alsolike_Slider2();
            this.Topalbums_Slider();
            this.top_slider();
            this.feat_slider();
            this.trend_slider();
            
        },
        /*-------------- Music Functions definition ---------------------------------------------------
        ---------------------------------------------------------------------------------------------------*/
        RTL: function() {
            var rtl_attr = $("html").attr('dir');
            if (rtl_attr) {
                $('html').find('body').addClass("rtl");
            }
        },
        
        // Trending Album  Slider
        Topalbums_Slider: function() {
            $('.top_album_slider .swiper-container').each(function(index, element){
                var swiper = new Swiper($(this), {
                slidesPerView: 6,
                spaceBetween: 26,
                loop: true,
                
                autoplay: {
                        delay: 3000,
                      },
                speed: 1500,
                navigation: {
                    nextEl: '.swiper-button-next1',
                    prevEl: '.swiper-button-prev1',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 5,
                        spaceBetween: 30,
                    },
                    1600: {
                        slidesPerView: 5,
                        spaceBetween: 30,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                });
            });
        },
        // New Demo Slider Album, Artist, Radio, Podcasts, Music
        top_slider: function() {
            $('.top_slider .swiper-container').each(function(index, element){
                var swiper = new Swiper($(this), {
                slidesPerView: 6,
                spaceBetween: 26,
                loop: true,
                speed: 1500,
                navigation: {
                    nextEl: '.n-top',
                    prevEl: '.p-top',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 5,
                         spaceBetween:30,
                    },
                    1600: {
                        slidesPerView: 5,
                    },
                    1400: {
                        slidesPerView: 4,
                    }, 
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                });
            });
        },
        feat_slider: function() {
            $('.feat_slider .swiper-container').each(function(index, element){
                var swiper = new Swiper($(this), {
                slidesPerView: 6,
                spaceBetween: 26,
                loop: true,
                speed: 1500,
                navigation: {
                    nextEl: '.n-feat',
                    prevEl: '.p-feat',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 5,
                    },
                    1600: {
                        slidesPerView: 5,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                });
            });
        },
        trend_slider: function() {
            $('.trend_slider .swiper-container').each(function(index, element){
                var swiper = new Swiper($(this), {
                slidesPerView: 6,
                spaceBetween: 26,
                loop: true,
                speed: 1500,
                navigation: {
                    nextEl: '.n-trend',
                    prevEl: '.p-trend',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 5,
                    },
                    1600: {
                        slidesPerView: 5,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
                });
            });
        },
        /* Toggle Menu */
        Menu: function() {
            
            $('.sub-menu').parent().hover(function() {
                var menu = $(this).find("ul");
                var menupos = $(menu).offset();
                if (menupos.left + menu.width() > $(window).width()) {
                    var newpos = -$(menu).width();
                    menu.css({
                        left: newpos
                    });
                }
            });
            $(".ms_modal").on('click', function(e) {
				e.preventDefault();
				$("#myModal").modal("hide");
				$(this).closest('.modal-content').find('.form_close').trigger('click');
            });
			$(".ms_modal1").on('click', function(e) {
				e.preventDefault();
				$("#myModal1").modal("hide");
				$(this).closest('.modal-content').find('.form_close').trigger('click');
			});
            $(".ms_nav_close").on('click', function() {
                $(".ms_sidemenu_wrapper").toggleClass('open_menu');
                $('body').toggleClass('slide_menu');
            });
            
            $(".play-left-arrow").on('click', function() {
                $(".player_left").toggleClass('open_list');
            });
            
            $(".ms_admin_name").on('click', function() {
                $(".pro_dropdown_menu").toggleClass("open_dropdown");
            });
            
            $(document).on('click', function() {
                $('.pro_dropdown_menu').removeClass("open_dropdown");
            });
            $('.ms_admin_name').on('click', function(event) {
                event.stopPropagation();
            });
            
            $('.ms_nav_wrapper ul li.menu-item-has-children').children('a').append(function() {
                return '<div class="dropdown-expander"><i class="fa fa-plus" aria-hidden="true"></i></div>';
            });
            $(".ms_nav_wrapper ul > li:has(ul) > a").on('click', function(e) {
                var w = window.innerWidth;
                if (w <= 991) {
                    e.preventDefault();
                    $(this).parent('.ms_nav_wrapper ul li').children('ul.sub-menu').slideToggle();
                }
            });
            
            $('.ms_menu_bar').on('click', function() {
                $('.ms_basic_header').toggleClass('menu_open');
            })
            $('.ms_basic_menu ul li.menu-item-has-children').children('a').append(function() {
                return '<div class="dropdown-expander"><i class="fa fa-plus" aria-hidden="true"></i></div>';
            });
            $(".ms_basic_menu ul > li:has(ul) > a").on('click', function(e) {
                var w = window.innerWidth;
                if (w <= 991) {
                    e.preventDefault();
                    $(this).parent('.ms_basic_menu ul li').children('ul.sub-menu').slideToggle();
                }
            });
        },
        
        Player_close: function() {
            $(".ms_player_close").on('click', function() {
                $(".ms_player_wrapper").toggleClass("close_player");
                $("body").toggleClass("main_class")
            })
        },
        
        Popup: function() {
            $('.clr_modal_btn a').on('click', function() {
                $('#clear_modal').hide();
                $('.modal-backdrop').hide();
                $('body').removeClass("modal-open").css("padding-right", "0px");
            })
           
            
            $('.lang_list').find("input[type=checkbox]").on('change', function() {
                if ($('.lang_list').find("input[type=checkbox]:checked").length) {
                    $('.ms_lang_popup .modal-content').addClass('add_lang');
                } else {
                    $('.ms_lang_popup .modal-content').removeClass('add_lang');
                }
            });
        },
        
        Slider: function() {
			
			$('.swiper-container').each(function(i, n) {
					var tt = $(this).attr('data-type');
					var meta = $(this).attr('data-blogmeta'); 
				    var data = meta != undefined ? JSON.parse(meta) : '';
				    var number = parseInt(data.per_view);
					var swiper = new Swiper('.ms_slider'+tt+'.swiper-container', {
					slidesPerView: number,
					spaceBetween: 30,
					speed: 1500,
				    autoplay: {
                        delay: 3000,
                      },
					navigation: {
					    nextEl: $(this).parent().find('.swiper-button-next'),
						prevEl: $(this).parent().find('.swiper-button-prev')
					},
					breakpoints: {
						1800: {
							slidesPerView: 4,
							spaceBetween: 30
						},
							1600: {
							slidesPerView: 4,
							spaceBetween: 30,
						},
						1400: {
							slidesPerView: 3,
							spaceBetween: 30,
						},
						992: {
							slidesPerView: 2,
							spaceBetween: 30,
						},
						768: {
							slidesPerView: 2,
							spaceBetween: 30,
						},
						640: {
							slidesPerView: 2,
							spaceBetween: 30,
						},
						480: {
							slidesPerView: 1,
							spaceBetween: 0,
						},
						375: {
							slidesPerView: 1,
							spaceBetween: 0,
						}
					},
				});
			});
			$('.swiper-container').each(function(i, n) {
					var tt = $(this).attr('data-type');
					var meta = $(this).attr('data-blogmeta'); 
				    var data = meta != undefined ? JSON.parse(meta) : '';
				    var number = parseInt(data.per_view); 
					var swiper = new Swiper('.ms-slider .ms_slider'+tt+'.swiper-container', {
					slidesPerView: number,
					spaceBetween: 30,
					speed: 1500,
					autoplay: {
                        delay: 3000,
                      },
				    loop: true,
					navigation: {
					    nextEl: '.swiper-button-next-'+tt,
                        prevEl: '.swiper-button-prev-'+tt,
					},
					
					  breakpoints: {
						1800: {
							slidesPerView: 4, 
							spaceBetween: 30,
						},
						1400: {
							slidesPerView: 3,
							spaceBetween: 30,
						},
						992: { 
							slidesPerView: 2,
							spaceBetween: 30,
						},
						768: {
							slidesPerView: 2,
							spaceBetween: 30,
						},
						640: {
							slidesPerView: 2,
							spaceBetween: 30,
						},
						480: {
							slidesPerView: 1,
							spaceBetween: 30,
						},
						375: {
							slidesPerView: 1,
							spaceBetween: 30,
						}
					},
				});
			});
            var swiper = new Swiper('.ms_rcnt_slider .swiper-container', {
                slidesPerView: 6,
                spaceBetween: 30,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next5',
                    prevEl: '.swiper-button-prev5',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView:1,
                        spaceBetween: 0,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                },
            });
            
            var swiper = new Swiper('.ms_feature_slider.swiper-container', {
                slidesPerView: 6,
                spaceBetween: 30,
                speed: 1500,
				loop:true,
				autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                },
            });
            
            var swiper = new Swiper('.ms_release_slider.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next2',
                    prevEl: '.swiper-button-prev2',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                },
            });
            
            var swiper = new Swiper('.ms_album_slider.swiper-container', {
                slidesPerView: 6,
                spaceBetween: 30,
                loop: false,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next3',
                    prevEl: '.swiper-button-prev3',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                },
            });
            
            var swiper = new Swiper('.ms_radio_slider.swiper-container', {
                slidesPerView: 6,
                spaceBetween: 30,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next4',
                    prevEl: '.swiper-button-prev4',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                },
            });
            /* Testimonial Slider */
            var swiper = new Swiper('.ms_test_slider.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                slidesPerColumn: 1,
                loop: false,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next1',
                    prevEl: '.swiper-button-prev1',
                },
                breakpoints: {
                    1400: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                },
            });
            
            var swiper = new Swiper('.ms_woocommerce_slider.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                slidesPerColumn: 1,
                loop: false,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1400: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                },
            });
            
            var swiper = new Swiper('.ms_product_slides_slider.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                slidesPerColumn: 1,
                loop: false,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1400: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                },
            }); 
        },
        /* Music Tab*/
         dropdown_toggle: function(){
			if($('.songslist_moreicon').length > 0){
            $(document).on('click', '.songslist_moreicon', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $('.songslist_moreicon').not($(this)).closest('li').find('.ms_common_dropdown').removeClass('open');
                $(this).closest('li').find('.ms_common_dropdown').toggleClass('open');
            });

            $(document).on('click','body', function(){
                 $('.ms_common_dropdown').removeClass('open');
            });
            }
        },
        // Music Center  Slider
        music_center_Slider: function() {
            var swiper = new Swiper('.music_center_slider .swiper-container', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: false,
                slidesPerView: 'auto',
                loop:true,
                speed:600,
                autoplay:false, 
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                grabCursor: true,
                effect: 'coverflow',
                coverflowEffect: {
                    rotate: 0,
                    stretch: 450,
                    depth: 300,
                },
                navigation: {
                    nextEl: '.swiper-music-next',
                    prevEl: '.swiper-music-prev',
                },
                breakpoints: {
                    
                    575: {
                        coverflowEffect: {
                            stretch: 300,
                        },
                    },
                    600: {
                        coverflowEffect: {
                            stretch: 400,
                        },
                    },
                    700: {
                        coverflowEffect: {
                            stretch: 450,
                        },
                    },
                    800: {
                        coverflowEffect: {
                            stretch: 500,
                        },
                    },
                    992: {
                        coverflowEffect: {
                            stretch: 600,
                        },
                    },
                    1200: {
                        coverflowEffect: {
                            stretch: 500,
                        },
                    }, 
                    1399: {
                        coverflowEffect: {
                            stretch: 700,
                        },
                    }, 
                }
                
            });
        },
        More: function() {
            $(".ms_more_icon").on('click', function() {
                if (typeof $(this).attr('data-other') != 'undefined') {
                    var target = $(this).parent().parent();
                } else {
                    var target = $(this).parent();
                }
                if (target.find("ul.more_option").hasClass('open_option')) {
                    target.find("ul.more_option").removeClass('open_option');
                } else {
                    $("ul.more_option.open_option").removeClass('open_option');
                    target.find("ul.more_option").addClass('open_option');
                }
					
            });
			
            $(document).on('click', '#playlist-wrap ul li .action .que_more', function() {
                // e.preventDefault();
                // e.stopImmediatePropagation();
                $('#playlist-wrap ul li .action .que_more').not($(this)).closest('li').find('.more_option').removeClass('open_option');
                $(this).closest('li').find('.more_option').toggleClass('open_option');
            });
            $(document).on('click', '#playlist-wrap ul li .action .que_more', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $('#playlist-wrap ul li .action .que_more').not($(this)).closest('li').find('.more_option').removeClass('open_option');
                $(this).closest('li').find('.more_option').toggleClass('open_option');
            });
            
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.more_option').length && !$(e.target).closest('.action').length) {
                    $('#playlist-wrap .more_option').removeClass('open_option');
                }
                if (!$(e.target).closest('#playlist-wrap').length && !$(e.target).closest('.jp_queue_wrapper').length && !$(e.target).closest('.player_left').length) {
                    $('#playlist-wrap').hide();
                }
            });
            
            $('.jp_queue_cls').on('click', function(e) {
                $('#playlist-wrap').hide();
            });
        },
        /* Nice Select */
        Nice_select: function() {
            if ($('.custom_select').length > 0) {
                $('.custom_select select').niceSelect();
            }
        },
        showPlayList: function() {
            $(document).on('click', '#myPlaylistQueue', function() {
                $('#playlist-wrap').fadeToggle();
            });
            $('#playlist-wrap').on('click', '#myPlaylistQueue', function(event) {
                event.stopPropagation();
            });
        },
        /* Volume */
        volume: function() {
            $(".knob-mask .knob").css("transform", "rotateZ(270deg)");
            $(".knob-mask .handle").css("transform", "rotateZ(270deg)");
        },
        // You may also like  Slider
        alsolike_Slider: function() {
            var swiper = new Swiper('.also_like_slider .swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                loop: true,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next1',
                    prevEl: '.swiper-button-prev1',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 3,
                    },
                    1600: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1500: {
                        slidesPerView: 2,
                    },
                    1399: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    800: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    700: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                    },
                    480: {
                        slidesPerView: 1,
                    }
                },
            });
        },
        // You may also like  Slider
        alsolike_Slider2: function() {
            var swiper = new Swiper('.also_like_slider2 .swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                loop: true,
                speed: 1500,
                autoplay: {
                        delay: 3000,
                      },
                navigation: {
                    nextEl: '.swiper-button-next2',
                    prevEl: '.swiper-button-prev2',
                },
                breakpoints: {
                    1800: {
                        slidesPerView: 3,
                    },
                    1600: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1500: {
                        slidesPerView: 2,
                    },
                    1399: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    992: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    800: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    700: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                    },
                    480: {
                        slidesPerView: 1,
                    }
                },
            });
        },
        
    };
    $(document).ready(function() {
        music.init();
        /* Scrollbar */
        $(".ms_nav_wrapper").mCustomScrollbar({
            theme: "minimal",
            scrollEasing: "easeInOut",
            scrollInertia: 400
        });
        /* Queue Scrollbar */
        $(".jp_queue_list_inner").mCustomScrollbar({
            theme: "minimal",
            setHeight: 200
        });
		/* Last ul find */
		$( ".album_list_wrapper > ul:last-child" ).addClass( "last_albm_list" );
    });
    /* Preloader Js */
    jQuery(window).on('load', function() {
        setTimeout(function() {
            $('body').addClass('loaded');
        }, 500);
        /* Li Length */
        if ($('.jp-playlist ul li').length > 3) {
            $('.jp-playlist').addClass('find_li');
        }
    });
    /* Window Scroll */
    $(window).on('scroll',function() {
        var wh = window.innerWidth;
        /* Go to top */
        if ($(this).scrollTop() > 100) {
            $('.gotop').addClass('goto');
            $('body').addClass('ms_admin_bar');
        } else {
            $('.gotop').removeClass('goto');
			$('body').removeClass('ms_admin_bar');   
        }
        /* Add Fixed Class */
        if (wh > 767) {
            var h = window.innerHeight;
            var window_top = $(window).scrollTop() + 1;
            if (window_top > 100) {
                $('.ms_basic_header').addClass('ms_fixed');
            } else {
                $('.ms_basic_header').removeClass('ms_fixed');
            }
        }
    });
    
    /**
     * woocommerce tabs
     */ 
    $('.woocommerce-tabs .panel.entry-content' ).hide();
    $('.woocommerce-tabs ul.tabs li a' ).on('click',function() {
    var $tab = $( this ),
    $tabs_wrapper = $tab.closest( '.woocommerce-tabs' );
        $( 'ul.tabs li', $tabs_wrapper ).removeClass( 'active' );
        $( 'div.panel.entry-content', $tabs_wrapper ).hide();
        $( 'div' + $tab.attr( 'href' ), $tabs_wrapper).show();
        $tab.parent().addClass( 'active' );
        return false;
    });
    
//     $('.showcoupon').on('click',function() {
//         $('.checkout_coupon').toggle();
//     });
    
    $(window).on('load',function() {
      if ($(window).width() <= 991) {
             $('.ms_sidemenu_wrapper').removeClass('open_menu');
      } 
    });
    
    $(".style-two .menu-menu-one-container").prepend("<h4 class='nav_heading'>Browse Music</h4>");
    $(".style-two .menu-menu-two-container").prepend("<h4 class='nav_heading'>YOUR MUSIC</h4>");
    
    
    // Preloader Js
    jQuery(window).on('load', function() {
        setTimeout(function() {
            $('body').addClass('loaded');
        }, 500);
        // Li Lenght
        if ($('.jp-playlist ul li').length > 3) {
            $('.jp-playlist').addClass('find_li');
        }
    });
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop()
        if (scroll >= 5) {
            $(".ms_header").addClass("dark_header");
        } else {
            $(".ms_header").removeClass("dark_header");
        }
    }); 
    $(document).ready( function () {
        $('#artist-list').DataTable({
			responsive: true
		});
    } );
    
    $(document).ready( function () {
        $('#myearning').DataTable({
			responsive: true
		});
    } );
    
    $(document).ready( function () {
        $('#musci_earnings').DataTable({
			responsive: true
		});
    } );
    $(document).ready( function () {
        $('#transaction_earnings').DataTable({
			responsive: true
		});
    } );
    


window.addEventListener('load', function() {
    
    $('audio').each(function(index,val){
        //alert(index);
        var minutes = parseInt(this.duration / 60, 10);
        var seconds = parseInt(this.duration % 60);
        $(this).next('p').html(minutes+":"+seconds);
    });
})


$(document).ready(function(){
    $("#track_types").change(function(){
        var artists = $(this).children("option:selected").val();
         if(artists == 'premium'){
            $("#track_price_hideshow").show();
        } else {
             $("#track_price_hideshow").hide();
        }
    });
    
    $("#album_types").change(function(){
        var album = $(this).children("option:selected").val();
         if(album == 'premium'){
            $("#wev_album_price_showhide").show();
        } else {
             $("#wev_album_price_showhide").hide();
        }
    });
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})
	
});
    //razorpay payment for plans
    $(document).on('submit','#form_data_razorpay',function(e){
        var payer_id = $('#payer_id').val();
    	var payer_email = $('#payer_email').val();
    	var plan_id = $('#plan_id').val();
    	var plan_price = $('#plan_price').val();
    	var razorpay = $('#razorpay').val();
    	var razorpay_url = $('#razorpay_url').val();
    	var currency = $('#currency').val();
    	var options = {
    	    "key": razorpay,
		    "amount": plan_price, 
		    "name": "Payment", 
		    "event": "Payment",
		    "currency": currency,
		    "description": 'totalAmount',
		    "image": "",
		    "handler": function (response){
    			$.ajax({
    				url: razorpay_url,
    				type: 'post',
    				dataType: 'json',
    				data: {			
    				    razorpay_payment_id: response.razorpay_payment_id, payer_id : payer_id, plan_id : plan_id, plan_price : plan_price, 
    				},
    				success: function (result) {
    				    if(result.status == 'true'){
    				        location.replace(result.url);
    				    } else {
    				        location.replace(result.url);
    				    }	
			        }
    				});
			    }, 
			    "theme": {
				    "color": "#528FF0"
			    }
    		};
		    var rzp1 = new Razorpay(options);
		    rzp1.open();
		    e.preventDefault();
        });
        
        //razorpay payment for single song
    $(document).on('submit','#form_data_razorpay_single_song',function(e){
        var payer_id = $('#payer_id').val();
    	var payer_email = $('#payer_email').val();
    	var plan_id = $('#plan_id').val();
    	var plan_price = $('#plan_price').val();
    	var razorpay = $('#razorpay').val();
    	var razorpay_url = $('#razorpay_url').val();
    	var currency = $('#currency').val();
    	var options = {
    	    "key": razorpay,
		    "amount": plan_price, 
		    "name": "Payment", 
		    "event": "Payment",
		    //"currency": currency,
		    "description": 'totalAmount',
		    "image": "",
		    "handler": function (response){
    			$.ajax({
    				url: razorpay_url,
    				type: 'post',
    				dataType: 'json',
    				data: {			
    				    razorpay_payment_id: response.razorpay_payment_id, payer_id : payer_id, plan_id : plan_id, plan_price : plan_price, 
    				},
    				success: function (result) {
    				     if(result.status == 'true'){
    				         location.replace(result.url);
    				     } else {
    				         location.replace(result.url);
    				     }	
			       }
    				});
			    }, 
			    "theme": {
				    "color": "#528FF0"
			    }
    		};
		    var rzp1 = new Razorpay(options);
		    rzp1.open();
		    e.preventDefault();
        });
        
    
})(jQuery);