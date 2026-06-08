/* menu on */
function menuOn(depth1, depth2) {
	var topmenu = $(".topmenu" + depth1);
	topmenu.addClass("selected");

	var totalmenuDepth1 = $(".topmenu" + depth1);
	totalmenuDepth1.addClass("selected point");

	var totalmenuDepth2 = $(".topmenu" + depth1 + "-" + depth2);
	totalmenuDepth2.addClass("selected");
}

/* 스크롤 */
$(window).scroll(function(e){
	var windowWidth = $(window).width();

	if (windowWidth >= 1024) {
		/*
		if ($(this).scrollTop() > 68) {
			$(".top-menu-wrapper").addClass("fixed");
		} else {
			$(".top-menu-wrapper").removeClass('fixed');
		}
		*/
	} else {
		var mobileHeaderHeight = $('.header').outerHeight();

		if ($(this).scrollTop() > mobileHeaderHeight) {
			$(".header, .contents").addClass("fixed");
		} else {
			$(".header, .contents").removeClass("fixed");
		}
	}

	/* 부드럽게 위로 이 동*/
	if ( $( this ).scrollTop() > 200 ) {
		$( '.btn-top-go, .btn-mobile-back' ).fadeIn();
	} else {
		$( '.btn-top-go, .btn-mobile-back' ).fadeOut();
	}

});



$(function() {
	/* 상단 2차메뉴 */
	$(".top-menu-area > ul > li > a").hover(function() {
		$(this).parent().find(".top-submenu").slideDown(150).show();
		$(this).parent().hover(function() {  
		}, function(){  
			$(this).parent().find(".top-submenu").slideUp(150);
		});  
	});  

	/* 전체 메뉴 */
	$(".btn-totalmenu-mobile").click(function() {
		if($(".mask-totalmenu-mobile").css("display") == "none") {
			$(".mobile-sub-menu-wrapper").hide();
			$(".wrapper").addClass("fixed-body");
			$(".mask-totalmenu-mobile").fadeIn(150, function() {
				$(".totalmenu-mobile-area").animate({marginRight: "0", opacity: '1'}, '150');
			});
		} else {
			$(".wrapper").removeClass("fixed-body");
			$(".totalmenu-mobile-area").animate({marginRight: "-24.039rem", opacity: '0'}, '450');
			$(".mask-totalmenu-mobile").fadeOut(150);
			$(".totalmenu-mobile-area > ul > li").removeClass('on point');
			$(".top-submenu").slideUp();
			$(".totalmenu-mobile-area > ul > li.selected .top-submenu").slideDown();
		}
	});

	/* 모바일 전체 메뉴 서브메뉴 */
	$(".totalmenu-mobile-area > ul > li > a").click(function() {
		if($(this).next(".top-submenu").css("display") == "none") {
			event.preventDefault();
			$(".totalmenu-mobile-area > ul > li").removeClass('on point');
			$(".top-submenu").slideUp();
			$(this).parent().addClass('on');
			$(this).next(".top-submenu").slideDown();
		} else {
			$(".totalmenu-mobile-area > ul > li").removeClass('on point');
			$(".top-submenu").slideUp();
		}
	});

	/* 전체 메뉴 창닫기 */
	$(".btn-totalenu-mobile-close, .mask-totalmenu-mobile").click(function() {
		var thisWidth = $(window).width();
		if(thisWidth < 1024) {
			$(".wrapper").removeClass("fixed-body");
			$(".totalmenu-mobile-area").animate({marginRight: "-24.039rem", opacity: '0'}, '450');
			$(".mask-totalmenu-mobile").fadeOut(150);
			$(".totalmenu-mobile-area > ul > li").removeClass('on point');
			$(".top-submenu").slideUp();
			$(".totalmenu-mobile-area > ul > li.selected .top-submenu").slideDown();
		}
	});


	/*
	$(".contents-title").click(function() {
		var wrapperWidth02 = $(window).width();	
		if(wrapperWidth02 < 1024) {
			if($(".mobile-sub-menu-wrapper").css("display") != "none") {
				$(this).removeClass('on');
				$(".mobile-sub-menu-wrapper").hide();
			} else {
				$(this).addClass('on');
				$(".mobile-sub-menu-wrapper").show();
			}
		} 
	});
	*/


	$(".footer-selected-wrapper > dl > dt > button").click(function() {
		if($(this).parent().next(".footer-selected-wrapper > dl > dd").css("display") == "none") {
			$(".footer-selected-wrapper > dl > dt > button").removeClass('on');
			$(".footer-selected-wrapper > dl > dd").slideUp(150);
			$(this).addClass('on');
			$(this).parent().next(".footer-selected-wrapper > dl > dd").slideDown(150);
		} else {
			$(".footer-selected-wrapper > dl > dt > button").removeClass('on');
			$(".footer-selected-wrapper > dl > dd").slideUp(150);
		}
	});

	/* 부드럽게 상단으로 이동 */
	$( '.btn-top-go' ).click( function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 400 );
		return false;
	});

	/* 최대화 최소화 */
	window.onresize = function() {
		if (window.innerHeight <= 1024) {
			$('.top-submenu-wrapper').hide();
			$(".totalmenu-mobile-area").animate({marginRight: "-24.039rem", opacity: '0'}, '450');
			$(".top-submenu").hide();
			$(".totalmenu-mobile-area > ul > li").removeClass('on point');
			$(".totalmenu-mobile-area > ul > li.selected .top-submenu").show();
			$(".mask-totalmenu-mobile").hide();
			$(".wrapper").removeClass("fixed-body");
			$(".top-menu-wrapper").removeClass('fixed');
			$(".header").addClass("fixed");
			$(".mobile-sub-menu-wrapper").hide();
			$(".contents-title").removeClass('on');
			$(".footer-selected-wrapper > dl > dt > button").removeClass('on');
			$(".footer-selected-wrapper > dl > dd").hide();
		}
	}
});



/* 모바일 접속 시 상단 depth1 메뉴 링크 disable */
if(	navigator.userAgent.indexOf("Android")>0 || 
	navigator.userAgent.indexOf("iPhone") > 0|| 
	navigator.userAgent.indexOf("iPod") > 0|| 
	navigator.userAgent.indexOf("BlackBerry") > 0) {

	$(function() {
		$(".top-menu-area > ul > li > a").click(function(event) {
			event.preventDefault();
		});
	});
} else {
	$(function() {
		$(".top-menu-area > ul > li > a").click(function(event) {
			event.stopPropagation();
		});
	});
}
