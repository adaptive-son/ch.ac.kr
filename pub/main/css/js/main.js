/* main slider */
var MainVisualSlider = {
	init: function() {
		MainVisualSlider.carousel();
	},
	carousel: function() {
		var mainVisualSlider;
		$(document).ready(function() {
			mainVisualSlider = $('#big01').owlCarousel({
				transitionStyle: 'fade',
				animateIn: 'fadeIn',
				animateOut: 'fadeOut',
				items : 1,
				nav: false,
				dots: true,
				loop: true,
				autoHeight: true,
				autoHeight: true,
				autoplay: true,
				autoplayTimeout: 10000,
				slideSpeed: 10000,
				margin: 0,
				dotsContainer: '#thumbs01',
			});

			$('.main-slider-btns-wrapper .btn-play').on('click',function(){
				mainVisualSlider.trigger('play.owl.autoplay',[10000]);
				$('.main-slider-btns-wrapper .btn-play').hide();
				$('.main-slider-btns-wrapper .btn-stop').show();
			})
			$('.main-slider-btns-wrapper .btn-stop').on('click',function(){
				mainVisualSlider.trigger('stop.owl.autoplay');
				$('.main-slider-btns-wrapper .btn-play').show();
				$('.main-slider-btns-wrapper .btn-stop').hide();
			});

			$(".main-word-slogan-area:eq(0)").addClass('active');

			mainVisualSlider.on('changed.owl.carousel', function(event) {
				var currentItem = event.item.index;
				console.log(currentItem);
				$(".main-word-slogan-area:eq(0)").addClass('active');
				if(currentItem == 2) {
					$(".main-word-slogan-area").removeClass('active');
					$(".main-word-slogan-area:eq(0)").addClass('active');
				} else if (currentItem == 3 ) {
					$(".main-word-slogan-area").removeClass('active');
					$(".main-word-slogan-area:eq(1)").addClass('active');
				} else {
					$(".main-word-slogan-area").removeClass('active');
					$(".main-word-slogan-area:eq(2)").addClass('active');
				}
			});

		});
	}
};

$(function() {

	MainVisualSlider.init();

	/* 입학안내01 */
	var mainBoardSlider = $('#main-board-slider');
	mainBoardSlider.owlCarousel({
		items: 1,
		loop: true,
		nav: false,
		dots: true,
		autoplay: false,
		margin: 10,
		autoHeight: true,
		responsiveClass: true
	});

	/* 탭메뉴 01 */
   $(".main-type-menu-wrapper > ul > li > button").on("click", function() {
	   $(".main-type-menu-wrapper > ul > li > button").removeClass('active');
	   $(this).addClass('active');
   });

	/* 탭메뉴 02 (게시판) */
   $(".main-tabmenu > li > button").on("click", function() {
	   var tempIdx = $(this).attr('id');
	   var thidIdx = tempIdx.replace(/[^0-9]/g,"");

		$(".main-tabmenu > li > button").removeClass('active');
		$(this).addClass('active');

		$(".main-board-box01").removeClass('active');
		$("#main-board-box" + thidIdx).addClass('active');
   });

	/* 메인베너01 */
	var mainBanner = $('#main-banner');
	mainBanner.owlCarousel({
		items: 1,
		loop: true,
		nav: false,
		dots: false,
		autoplay:true,
		autoplayTimeout: 15000,
		slideSpeed: 15000,
		margin: 0,
		responsiveClass:true
	});

	$('.banner-btns-wrapper .btn-next').click(function() {
		mainBanner.trigger('next.owl.carousel');
	});
	$('.banner-btns-wrapper .btn-previous').click(function() {
		mainBanner.trigger('prev.owl.carousel');
	});

	$('.banner-btns-wrapper .btn-play').on('click',function(){
		mainBanner.trigger('play.owl.autoplay',[15000]);
		$('.banner-btns-wrapper .btn-play').hide();
		$('.banner-btns-wrapper .btn-stop').show();
	})
	$('.banner-btns-wrapper .btn-stop').on('click',function(){
		mainBanner.trigger('stop.owl.autoplay');
		$('.banner-btns-wrapper .btn-play').show();
		$('.banner-btns-wrapper .btn-stop').hide();
	});

	/* 입학안내01 */
	var mainIpsiSlider = $('#main-ipsi-slider');
	mainIpsiSlider.owlCarousel({
		items: 1,
		loop: true,
		nav: false,
		dots: false,
		autoplay: false,
		autoplayTimeout: 15000,
		slideSpeed: 15000,
		margin: 0,
		responsiveClass: true
	});

	$('.ipsi-btns-wrapper .btn-next').click(function() {
		mainIpsiSlider.trigger('next.owl.carousel');
	});
	$('.ipsi-btns-wrapper .btn-previous').click(function() {
		mainIpsiSlider.trigger('prev.owl.carousel');
	});

	$('.ipsi-btns-wrapper .btn-play').on('click',function(){
		mainIpsiSlider.trigger('play.owl.autoplay',[15000]);
		$('.ipsi-btns-wrapper .btn-play').hide();
		$('.ipsi-btns-wrapper .btn-stop').show();
	})
	$('.ipsi-btns-wrapper .btn-stop').on('click',function(){
		mainIpsiSlider.trigger('stop.owl.autoplay');
		$('.ipsi-btns-wrapper .btn-play').show();
		$('.ipsi-btns-wrapper .btn-stop').hide();
	});

});