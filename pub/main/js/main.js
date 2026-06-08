$(function() {
	var mainVisualSlider01 = new Swiper('#main-visual-slider', {
		loop: true, 
		autoplay: {
			delay: 10000, /* 10000 */
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 0,
//		effect: 'fade',
		pagination: {
			el: '#main-visual-pagination',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<button class="' + className + '">메인비주얼 이미지 ' + (index + 1) + "</button>";
			},
		},    
	});
	$('.swiper-button-play').on('click', function() {
		mainVisualSlider01.autoplay.start(200);
		return false;
	});
	
	$('.swiper-button-pause').on('click', function() {
		mainVisualSlider01.autoplay.stop(200);
		return false;
	});

	$("#public-quickmenu .quickmenu-wrapper > ul > li:last-child > button + .quickmenu-area > ul > li:last-child > a").blur(function() {
		mainVisualSlider01.autoplay.stop(200);
		mainVisualSlider01.slideToLoop(0, 1000, false);
		return false;
	});

	
	/* main board */
	var mainBoardSlider01 = new Swiper('#main-board-slider', {
		loop: false, 
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		initialSlide: 0,
		slidesPerView: 'auto',
		spaceBetween: 50,
		centeredSlides: false,
		pagination: {
			el: '#main-board-pagination01',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.main-board-next01',
			prevEl: '.main-board-prev01',
		}
	});

	swiperThumbs(mainBoardSlider01, {
		element: 'swiper-thumbnails',
		activeClass: 'active'
	});

	$('.swiper-button-pause').blur(function() {
		mainBoardSlider01.autoplay.stop(200);
		mainBoardSlider01.slideToLoop(0, 1000, false);
		return false;
	});


	var mainBoardMobileSlider01 = new Swiper('#main-board-mobile-slider', {
		loop: true, 
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		initialSlide: 0,
		slidesPerView: 1,
		spaceBetween: 10,
		centeredSlides: false,
		pagination: {
			el: '#main-board-mobile-pagination01',
			clickable: true,
		},
		navigation: {
			nextEl: '.main-board-next02',
			prevEl: '.main-board-prev02',
		}
	});



	/* main press */
	var mainPressSlider01 = new Swiper('#main-press-slider', {
		loop: false, 
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		initialSlide: 0,
		slidesPerView: 'auto',
		spaceBetween: 49,
		centeredSlides: false,
		navigation: {
			nextEl: '.main-press-next01',
			prevEl: '.main-press-prev01',
		},
	});


	$('.main-schdule-area > .btn-more').blur(function() {
		mainPressSlider01.autoplay.stop(200);
		mainPressSlider01.slideToLoop(0, 1000, false);
		return false;
	});

	
	var mainPressMobileSlider01 = new Swiper('#main-press-mobile-slider', {
		loop: true, 
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		initialSlide: 0,
		slidesPerView: 1,
		spaceBetween: 0,
		centeredSlides: false,
		navigation: {
			nextEl: '.main-press-next02',
			prevEl: '.main-press-prev02',
		}
	});

	var mainBannerSlider01 = new Swiper('#main-banner-slider01', {
		loop: false, 
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '#main-banner-pagination',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<button class="' + className + '">배너 ' + (index + 1) + "</button>";
			},
		},
		slidesPerView: 4,
		spaceBetween: 37,
		breakpoints: {
			475: {
			  slidesPerView: 1,
			  spaceBetween: 20,
			  autoHeight: true
			},
			1024: {
			  slidesPerView: 2,
			  spaceBetween: 20,
			  autoHeight: true
			}
		}
	});


	$('#main-quickmenu .quickmenu-wrapper > ul > li:last-child > button + .quickmenu-area > ul > li:last-child > a').blur(function() {
		mainBannerSlider01.autoplay.stop(200);
		mainBannerSlider01.slideToLoop(0, 1000, false);
		return false;
	});

	$(".main-board-box02 > ul > li > button").on("click", function() {
		$(".main-board-box02 > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});

	$("#main-quickmenu .quickmenu-wrapper > ul > li > button").on("click", function() {
		$("#main-quickmenu .quickmenu-wrapper > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});
});


