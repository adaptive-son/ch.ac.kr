$(function(){
	setTimeout(function() { 
		$(".main-visual-slider-wrapper").addClass('active');
	}, 300);

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
});