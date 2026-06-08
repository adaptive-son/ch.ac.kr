/* menu on */
function menuOn(depth1, depth2, depth3) {
	var topmenu = $(".topmenu" + depth1);
	topmenu.addClass("active");

	var totalmenuDepth1 = $(".topmenu" + depth1);
	totalmenuDepth1.addClass("active");

	var totalmenuDepth2 = $(".topmenu" + depth1 + "-" + depth2);
	totalmenuDepth2.addClass("active");

	var totalmenuDepth3 = $(".topmenu" + depth1 + "-" + depth2 + "-" + depth3);
	totalmenuDepth3.addClass("active");
}

/* 화면 확대/축소 */
var nowZoom = 100;

function zoomIn() {
	nowZoom = nowZoom - 5;
	if(nowZoom <= 80) nowZoom = 80;
	zooms();
}

function zoomOut() {
		nowZoom = nowZoom + 5;
		if(nowZoom >= 1200) nowZoom = 120;
		zooms();
}

function zoomReset(){
	nowZoom = 100; 
	zooms();
}

function zooms(){
	document.body.style.zoom = nowZoom + '%';

	if(nowZoom==80){
		alert ("20%축소 되었습니다. 더 이상 축소할 수 없습니다.");
	}

	if(nowZoom==120){
		alert ("20%확대 되었습니다. 더 이상 확대할 수 없습니다.");
	}
}

/* 상단 메뉴 */
function chk(){
	if(cc == 1){
		$(".top-menu-wrapper > ul > li > .top-submenu").slideDown(100);
		$(".header-wrapper > .bg").slideDown(100);
		$(".menu").addClass('active');
		if($(window).width() > 1023) {
			$(".mask-totalmenu").show();
		}
	}else{
		$(".top-menu-wrapper > ul > li > .top-submenu").slideUp(150);
		$(".header-wrapper > .bg").slideUp(250);
		$(".menu").removeClass('active');
		if($(window).width() > 1023) {
			$(".mask-totalmenu").hide();
		}
	}
}

/* 스크롤 */
$(window).scroll(function(e){
	if ($(window).width() >= 1024) {
		if ($(this).scrollTop() > 38) {
			$(".wrapper").addClass("fixed");
		} else {
			$(".wrapper").removeClass('fixed');
		}
	} else {
		if ($(this).scrollTop() > 0) {
			$(".wrapper").addClass("fixed");
		} else {
			$(".wrapper").removeClass('fixed');
		}
	}

	/* 부드럽게 위로 이 동*/
	if ( $( this ).scrollTop() > 200 ) {
		$( '.btn-top-go, .btn-mobile-back' ).fadeIn(150);
	} else {
		$( '.btn-top-go, .btn-mobile-back' ).fadeOut(150);
	}
});

$(function() {
	/*
	$("a, input, select, button, textarea, label").keyup(function() {
		$(this).css({'outline': 'none', 'box-shadow': '0 0 0 2px #ff00e4, 0 0 0 4px #ff00e4', "z-index": "10000"});
	});
	
	$("a, input, select, button, textarea, label").keydown(function() {
		$(this).css({'outline': 'none', 'box-shadow': 'none'});
	});
	*/



	/* 전체메뉴 비율 지정 */
	var menuLength = $(".top-menu-wrapper > ul > li").length;
	var counter = 'counter' + menuLength;

	$(".top-menu-wrapper > ul > li").addClass(counter);	

	/* 전체메뉴 높이 지정 */
	var heightArray = $(".top-menu-wrapper > ul > li > .top-submenu").map( function() {
		return $(this).height();	
	}).get();

	var maxHeight = Math.max.apply(Math, heightArray);
	$(".header-wrapper > .bg, .top-menu-wrapper > ul > li > .top-submenu").height(maxHeight);

	/* 상단 2차메뉴 */
	if(	navigator.userAgent.indexOf("Android")>0 || 
		navigator.userAgent.indexOf("iPhone") > 0|| 
		navigator.userAgent.indexOf("iPod") > 0|| 
		navigator.userAgent.indexOf("BlackBerry") > 0) {

		$(function() {
			$('.top-menu-wrapper > ul > li > a').click(function(){
				event.preventDefault();
				setTimeout(chk, 100);
				cc = 1;
				$('.top-menu-wrapper > ul > li > a').removeClass('point');
				$(this).addClass('point');
			});

			$('.header').mouseleave(function(){
				setTimeout(chk, 400);
				cc = 0;
				$('.top-menu-wrapper > ul > li > a').removeClass('point');
			});
		});
	} else {
		$('.top-menu-wrapper > ul > li > a').mouseover(function(){
			setTimeout(chk, 100);
			cc = 1;
			$('.top-menu-wrapper > ul > li > a').removeClass('point');
			$(this).addClass('point');
		});

		$('.header').mouseleave(function(){
			if($(window).width() > 1023) {
				setTimeout(chk, 400);
				cc = 0;
				$('.top-menu-wrapper > ul > li > a').removeClass('point');
			}
		});

		$('.top-menu-wrapper > ul > li > a').focus(function(){
			setTimeout(chk, 100);
			cc = 1;
			$(this).addClass('point');
		});

		$('.top-menu-wrapper > ul > li > .top-submenu > ul > li:last-child > a').blur(function(){
			setTimeout(chk, 100);
			cc = 0;
			$('.top-menu-wrapper > ul > li > a').removeClass('point');
		});
	}

	/* 전체 메뉴 */
	$(".btn-totalmenu").click(function() {
		$(".totalmenu-area > ul > li > .top-submenu").show();
		var thisWidth = $(window).width();
		if(thisWidth < 1024) {
			$("body").addClass("fixed");
			$('.totalmenu-wrapper').show();
			$(".totalmenu-area > ul > li > .top-submenu").hide();
			$(".totalmenu-area > ul > li a.active + .top-submenu").show();
			$(".mask-totalmenu").fadeIn(150, function() {
				$(".totalmenu-wrapper").addClass('active');
			});

			$(".contents-title").removeClass('active');
			$(".lnb-wrapper").hide();
		} else {
			if( $(".mask-totalmenu").css("display") == "none" ) {
				setTimeout(chk, 100);
				cc = 1;
			} else {
				setTimeout(chk, 100);
				cc = 0;
			}
		}
	});

	$(".mask-totalmenu, .btn-mobile-close").click(function() {
		var thisWidth = $(window).width();
		if(thisWidth < 1024) {
			$("body").removeClass("fixed");
			$(".btn-totalmenu").removeClass('on');
			$('.totalmenu-wrapper').removeClass('active');
			$(".mask-totalmenu").hide();
			$(".totalmenu-area > ul > li").removeClass('on');
			$(".totalmenu-area > ul > li > .top-submenu").hide();
		} else {
			$("body").removeClass("fixed");
			$(".btn-totalmenu").removeClass('on');
			$('.totalmenu-wrapper').slideUp(150);
			$(".mask-totalmenu").hide();
			$(".totalmenu-area > ul > li").removeClass('on');
			$(".totalmenu-area > ul > li > .top-submenu").show();
		}
	});

	$(".totalmenu-area > ul > li > a").click(function() {
		var thisWidth = $(window).width();
		if(thisWidth < 1024) {
			event.preventDefault();
			if( $(this).parent().find(".top-submenu").css("display") != "none" ) {
				$(".totalmenu-area > ul > li").removeClass('on');
				$(".totalmenu-area > ul > li > .top-submenu").slideUp(75);
			} else {
				$(".totalmenu-area > ul > li").removeClass('on');
				$(".totalmenu-area > ul > li > .top-submenu").slideUp(75);
				$(this).parent().addClass('on');
				$(this).parent().find(".top-submenu").slideDown(75);
			}
		}
	});


	/* mobile contents title - lnb menu */
	$(".contents-title").on("click", function() {
		$(".lnb-area > ul > li > ul").hide();
		$(".lnb-area > ul > li > ul.active").show();

		if($(window).width() < 1024) {
			if($(".lnb-wrapper").css("display") != "none" ) {
				$("body").removeClass('fixed');
				$(this).removeClass('active');
				$(".lnb-wrapper").hide();
			} else {
				$("body").addClass('fixed');
				$(this).addClass('active');
				$(".lnb-wrapper").show();
			}
		}
	});

	$(".lnb-area > ul > li > a").on("click", function() {
		if($(this).children().hasClass('arrow') == true ) {
			event.preventDefault();

			if($(this).next(".lnb-area > ul > li > ul").css("display") != "none" ) {
				$(".lnb-area > ul > li > a").removeClass('point');
				$(".lnb-area > ul > li > ul").slideUp(75);
			} else {
				$(".lnb-area > ul > li > a").removeClass('point');
				$(".lnb-area > ul > li > ul").slideUp(75);
				$(this).addClass('point');
				$(this).next(".lnb-area > ul > li > ul").slideDown(75);
			}
		} else {
			event.stopPropagation();
		}
	});

	$(".footer-select-wrapper > dl > dt > button").on("click", function() {
		if($(this).parent().next(".footer-select-wrapper > dl > dd").css("display") == "none" ) {
			$(".footer-select-wrapper > dl > dt > button").removeClass('active');
			$(".footer-select-wrapper > dl > dd").slideUp(150);
			$(this).addClass('active');
			$(this).parent().next(".footer-select-wrapper > dl > dd").slideDown(150);
		} else {
			$(".footer-select-wrapper > dl > dt > button").removeClass('active');
			$(".footer-select-wrapper > dl > dd").slideUp(150);
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
			$("body").removeClass('fixed');
			$(".totalmenu-wrapper").removeClass('active');
			$(".mask-totalmenu").hide();
			$(".header-wrapper > .bg").hide();
			$(".top-menu-wrapper > ul > li > .top-submenu").hide();
			$(".totalmenu-area > ul > li, .btn-totalmenu").removeClass('on');
			$(".totalmenu-area > ul > li > .top-submenu").show();
			$(".totalmenu-wrapper").hide().removeClass('active');
			$("body").removeClass('fixed');
			$(".contents-title").removeClass('active');
		}
	}

	/* 아코디언 메뉴 */
	$(".accordion-menu-wrapper dl dt a").click(function() {
		if($(this).parent().next(".accordion-menu-wrapper dl dd").css("display") == "none") {
			$(".accordion-menu-wrapper dl dt a").removeClass('active');
			$(".accordion-menu-wrapper dl dd").slideUp(75);
			$(this).addClass('active');
			$(this).parent().next(".accordion-menu-wrapper dl dd").slideDown(75);
		} else {
			$(".accordion-menu-wrapper dl dt a").removeClass('active');
			$(".accordion-menu-wrapper dl dd").slideUp(75);
		}
	});

	$(".accordion-menu-area02 > h4 > button").click(function() {
		if($(this).parent().next(".accordion-menu-box02").css("display") == "none") {
			$(".accordion-menu-area02 > h4 > button").removeClass('active');
			$(".accordion-menu-box02").slideUp(75);
			$(this).addClass('active');
			$(this).parent().next(".accordion-menu-box02").slideDown(75);
		} else {
			$(".accordion-menu-area02 > h4 > button").removeClass('active');
			$(".accordion-menu-box02").slideUp(75);
		}
	});

	/* main tab board */
	$(".main-board-menu > li > a").on("click", function() {
		var tempIdx = $(this).attr('id');
		var thisIdx = tempIdx.replace(/[^0-9]/g,"");

		$(".main-board-menu > li > a").removeClass('active');
		$(".main-board-box").removeClass('active');
		$(this).addClass('active');
		$("#main-board-box" + thisIdx).addClass('active');
	});

});

/* resize */
$( window ).resize(function() {
	$(".totalmenu-wrapper").removeClass('active');
	$(".header-wrapper > .bg").hide();
	if($(window).width() >= 1024) {
			
		$(".lnb-wrapper").show();
		$(".lnb-area > ul > li > ul").hide();
		$(".lnb-area > ul > li > ul.active").show();
		$("body").removeClass('fixed');
		$(".contents-title").removeClass('active');
	} else {
		$(".lnb-wrapper").hide();
		$(".lnb-area > ul > li > ul").hide();
		$(".lnb-area > ul > li > ul.active").show();
	}

});


// -----------------------------------------------------------
// 화면 가운데에 새창 열기
// -----------------------------------------------------------
/** 캠퍼스맵 오픈 **/
function WindowOpen(page,w,h,s,r) { 
	var win=null; // 프레임이 존재 할 경우 
	// parent.window.screenLeft 식으로 
	// document.body.offsetWidth, document.body.offsetHeight 도 창의 크기에 맞게 변경 가능 
	var x=window.screenLeft; 
	var y=window.screenTop; 
	var l=x+((document.body.offsetWidth-w)/2); 
	var t=y+((document.body.offsetHeight-h)/2); 
	var settings=''; 
	
	settings ='width='+w+'px,'; 
	settings +='height='+h+'px,'; 
	settings +='top='+t+'px,'; 
	settings +='left='+l+'px,'; 
	settings +='scrollbars='+s+','; 
	settings +='resizable='+r+','; 
	settings +='status=0'; 
	
	var windows=window.open(page,win,settings); 
	windows.focus(); 
} 

/**졸업생 진로현황**/
function showYear(t,year){
    $('.year-tab-area li').removeClass('active');
    $(t).parent('li').addClass('active');
    $('.tabmenu-wrapper').nextAll('.contents-area').addClass('hide');
    $('.year'+year).removeClass('hide');

}