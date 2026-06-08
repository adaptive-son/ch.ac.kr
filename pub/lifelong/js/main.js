/* 탭메뉴 공지사항, 신입학, 편입학, 재외국민/외국인 */
$(function() {
	/* 퀵메뉴 */
	$(".aside-quickmenu-wrapper > button").on("click", function() {
		if ($(".aside-quickmenu-wrapper").hasClass('active') != true) {
			$(".aside-quickmenu-wrapper").addClass('active');
			$(".aside-quickmenu-wrapper > .quickmenu-wrapper > ul > li:first-child > button").addClass('active');

		} else {
			$(".aside-quickmenu-wrapper").removeClass('active');
		}	
	});

	/*
	$(".aside-quickmenu-wrapper > button").focus(function() {
		$(".aside-quickmenu-wrapper").addClass('active');
	});
	*/

	$("#public-quickmenu .quickmenu-wrapper > ul > li > button").focus(function() {
		$("#public-quickmenu .quickmenu-wrapper > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});

	$(".quickmenu-wrapper > ul > li:last-child > button + .quickmenu-area > ul > li:last-child > a").blur(function() {
		$(".aside-quickmenu-wrapper, #public-quickmenu .quickmenu-wrapper > ul > li > button").removeClass('active');
	});


	var mainVisualSlider = new Swiper('#main-visual-slider', {
		loop: true,
		autoHeight: true, // 슬라이드 반복
		slidesPerView: 1,
		spaceBetween: 0,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.main-visual-swiper-pagination',
			type: "fraction",
		},
		navigation: {
			nextEl: '.main-visual-button-next',
			prevEl: '.main-visual-button-prev',
		},
	});

	$(".main-visual-button-play").hide();

	$(".main-visual-button-pause").click(function() {
		$(".main-visual-button-pause").hide();
		$(".main-visual-button-play").show();
		mainVisualSlider.autoplay.stop();
	});

	$(".main-visual-button-play").click(function() {
		$(".main-visual-button-pause").show();
		$(".main-visual-button-play").hide();
		mainVisualSlider.autoplay.start();
	});

	var mainMobileNewsSlider = new Swiper('#main-mobile-news-slider', {
		loop: true,
		autoHeight: true, // 슬라이드 반복
		slidesPerView: 1,
		spaceBetween: 0,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		}
	});

	$(".main-board-area > ul > li > button").on("click", function() {
		$(".main-board-area > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});
});