/* menu on */
// tttttttttttttttttttttttttttttt
function menuOn(depth1, depth2, depth3, depth4) {
    var topmenu = $(".topmenu" + depth1);
    topmenu.addClass("active");

    var totalmenuDepth1 = $(".topmenu" + depth1);
    totalmenuDepth1.addClass("active");

    var totalmenuDepth2 = $(".topmenu" + depth1 + "-" + depth2);
    totalmenuDepth2.addClass("active");

    var totalmenuDepth3 = $(".topmenu" + depth1 + "-" + depth2 + "-" + depth3);
    totalmenuDepth3.addClass("active");

	var totalmenuDepth4 = $(".topmenu" + depth1 + "-" + depth2 + "-" + depth3 + "-" + depth4);
    totalmenuDepth4.addClass("active");

    /*
    if ($(".totalmenu-depth2-group").hasClass('active') && $(".totalmenu-depth3-group").hasClass('active') == true) {
        $(".totalmenu-depth2-area").addClass('active');
    }
    */

    if ($(".totalmenu-depth2-group").hasClass('active') && $(".totalmenu-depth3-group").hasClass('active') == true) {
        $(".totalmenu-depth2-area").addClass('active');
        $(".totalmenu-depth2-area").animate({
            left: "-" + ($(window).width() - $(".totalmenu-depth1").width()) + "px"
        }, 150); // 해당 뎁스가 3차일경우 이동
    }
}


/* 화면 확대/축소 */
var nowZoom = 100;

function zoomIn() {
    nowZoom = nowZoom - 5;
    if (nowZoom <= 80) nowZoom = 80;
    zooms();
}

function zoomOut() {
    nowZoom = nowZoom + 5;
    if (nowZoom >= 1200) nowZoom = 120;
    zooms();
}

function zoomReset() {
    nowZoom = 100;
    zooms();
}

function zooms() {
    document.body.style.zoom = nowZoom + '%';

    if (nowZoom == 80) {
        alert("20%축소 되었습니다. 더 이상 축소할 수 없습니다.");
    }

    if (nowZoom == 120) {
        alert("20%확대 되었습니다. 더 이상 확대할 수 없습니다.");
    }
}


function printWin() {
    window.open('../include/print.php', '', 'width=960,height=600,scrollbars=yes');
}


/* 스크롤 */
$(window).scroll(function(e) {
    if ($(window).width() >= 1024) {
        if ($(this).scrollTop() > 40) {
            $(".wrapper").addClass("fixed focus");
        } else {
            $(".wrapper").removeClass('fixed focus');
        }
    } else {
        if ($(this).scrollTop() > 0) {
            $(".wrapper").addClass("fixed focus");
        } else {
            $(".wrapper").removeClass('fixe focusd');
        }
    }
});

$(function() {
    $(".sub-visual > img").addClass('active');

    /* 상단 2차메뉴 */
    if (navigator.userAgent.indexOf("Android") > 0 ||
        navigator.userAgent.indexOf("iPhone") > 0 ||
        navigator.userAgent.indexOf("iPod") > 0 ||
        navigator.userAgent.indexOf("BlackBerry") > 0) {

        $(".additional-function-wrapper > li:eq(3)").hide();

        $(".top-menu-wrapper > ul > li > a").click(function(event) {
            event.preventDefault();
            $(".wrapper").addClass("focus");
            $(".mask-totalmenu").show();
            $(".top-menu-wrapper > ul > li .top-submenu").hide();
            $(".top-menu-wrapper > ul > li > a").removeClass('point');
            $(this).addClass('point');

            if ($(".header").hasClass('top-submenu-open') == true) {
                $(this).next(".top-submenu").show();
            } else {
                $(this).next(".top-submenu").slideDown(150);
                $(".header").addClass('top-submenu-open');
            }

            if ($(window).width() <= 1439) {
                $(".side-menu-area01").slideUp(75);
                $(".total-search-area").slideUp(75);
            } else {
                $(".side-menu-area01").show();
                $(".total-search-area").slideUp(75);
            }

            $('.btn-totalmenu-close, .mask-totalmenu').on("click", function() {
                $(".wrapper").removeClass("focus");
                $(".mask-totalmenu").hide();
                $('.top-menu-wrapper > ul > li > a').removeClass('point');
                $(".top-menu-wrapper > ul > li .top-submenu").slideUp();
                $(".header").removeClass('top-submenu-open');
            });
        });
    } else {
        $(".top-menu-wrapper > ul > li  > a").mouseover(function() {
            $(".wrapper").addClass("focus");
            $(".mask-totalmenu").show();
            $(".top-menu-wrapper > ul > li .top-submenu, .contents-navigation-area .contents-navigation>ul>li>ul").hide();
            $(".top-menu-wrapper > ul > li > a").removeClass('point');
            $(this).addClass('point');

            $(".contents-navigation-area .contents-navigation>ul>li button").removeClass('active');

            if ($(".header").hasClass('top-submenu-open') == true) {
                $(this).next(".top-submenu").show();
            } else {
                $(this).next(".top-submenu").slideDown(150);
                $(".header").addClass('top-submenu-open');
            }

            if ($(window).width() <= 1439) {
                $(".side-menu-area01").slideUp(75);
                $(".total-search-area").slideUp(75);
            } else {
                $(".side-menu-area01").show();
                $(".total-search-area").slideUp(75);
            }
        });

        $('.btn-totalmenu-close, .mask-totalmenu').on("click", function() {
            $(".wrapper").removeClass("focus");
            $(".mask-totalmenu").hide();
            $('.top-menu-wrapper > ul > li > a').removeClass('point');
            $(".top-menu-wrapper > ul > li .top-submenu").slideUp();
            $(".header").removeClass('top-submenu-open');
        });

        $('.mask-totalmenu').mouseover(function() {
            $(".wrapper").removeClass("focus");
            $(".mask-totalmenu").hide();
            $('.top-menu-wrapper > ul > li > a').removeClass('point');
            $(".top-menu-wrapper > ul > li .top-submenu").slideUp();
            $(".header").removeClass('top-submenu-open');
        });

        $('.top-menu-wrapper > ul > li > a').focus(function() {
            $(".mask-totalmenu").show();
            $('.top-menu-wrapper > ul > li > a').removeClass('point');
            $(this).addClass('point');

            if ($(".header").hasClass('top-submenu-open') == true) {
                $(this).next(".top-submenu").show();
            } else {
                $(this).next(".top-submenu").slideDown(150);
                $(".header").addClass('top-submenu-open');
            }
        });

        $('.btn-totalmenu-close').blur(function() {
            $(".wrapper").removeClass("focus");
            $(".mask-totalmenu").hide();
            $('.top-menu-wrapper > ul > li > a').removeClass('point');
            $(".top-menu-wrapper > ul > li .top-submenu").slideUp();
        });
    }

    /* 로그인, 대학메인, 사이트맵 1024 이상 1700 이하 */
    $(".btn-option").click(function() {
        $(".top-menu-wrapper > ul > li > a").removeClass('point');
        $(".mask-totalmenu").hide();
        $(".top-menu-wrapper > ul > li .top-submenu").slideUp(75);

        if ($(window).width() <= 1439) {
            if ($(".side-menu-area01").css("display") == "none") {
                $(".side-menu-area01").slideDown(75);
                $(".total-search-area").slideUp(75);
            } else {
                $(".side-menu-area01").slideUp(75);
                $(".total-search-area").slideUp(75)
            }
        }
    });

    $(".side-menu-area01 .btn-clsoe").click(function() {
        $(".side-menu-area01").slideUp(75);
    });


    /* 통합검색 */
    $(".btn-total-search").click(function() {
        $(".mask-totalmenu").hide();
        $(".top-menu-wrapper > ul > li .top-submenu").slideUp(75);
        $(".top-menu-wrapper > ul > li > a").removeClass('point');

        if ($(window).width() <= 1439) {
            $(".side-menu-area01").slideUp(75);

            if ($(".total-search-area").css("display") == "none") {
                $(".total-search-area").slideDown(75);
            } else {
                $(".total-search-area").slideUp(75);
            }
        } else {
            if ($(".total-search-area").css("display") == "none") {
                $(".total-search-area").slideDown(75);
            } else {
                $(".total-search-area").slideUp(75);
            }
        }
    });

    $(".total-search-area .btn-close").click(function() {
        $(".total-search-area").slideUp(75);
    });

    $(".contents-navigation ul > li > button").on("click", function() {
        if ($(this).next(".contents-navigation ul > li > ul").css("display") == "none") {
            $(".contents-navigation ul > li > button").removeClass('active');
            $(".contents-navigation ul > li > ul").slideUp(75);
            $(this).next().slideDown(75);
            $(this).addClass('active');
        } else {
            $(".contents-navigation ul > li > ul").slideUp(75);
            $(".contents-navigation ul > li > button").removeClass('active');
        }
    });

    $(".footer-select-wrapper > dl > dt > button").on("click", function() {
        if ($(this).parent().next().css("display") != "none") {
            $(".footer-select-wrapper > dl > dt > button").removeClass('active');
            $(".footer-select-wrapper > dl > dd").slideUp(75);
        } else {
            $(".footer-select-wrapper > dl > dt > button").removeClass('active');
            $(".footer-select-wrapper > dl > dd").slideUp(75);
            $(this).addClass('active');
            $(this).parent().next().slideDown(75);
        }
    });

    /* 전체 메뉴 */
    var thisWidth = $(".totalmenu-wrapper").width();
    var totalmenuDepth2BoxWidth = thisWidth - $(".totalmenu-depth1").width();

    $(".btn-totalmenu").click(function() {
		if($(window).width() < 1024) {
			event.preventDefault();
			var totalmenuDepth2BoxWidth = thisWidth - $(".totalmenu-depth1").width();

			if ($(window).width() < 1024) {
				$(".totalmenu-depth2-area").css("width", totalmenuDepth2BoxWidth * 2);
				$(".totalmenu-depth2-box, .totalmenu-depth2-group").css("width", totalmenuDepth2BoxWidth);


				$("body").addClass("fixed");
				$('.totalmenu-wrapper').show();
				$(".totalmenu-depth1 > ul > li > button").removeClass('point');
				$(".totalmenu-depth2-group, .totalmenu-depth3-group").removeClass('point');
				$(".totalmenu-depth2-area").removeClass('dpeth2-moving');
				$(".totalmenu-depth2-area").removeClass('dpeth3-moving');

				$(".mask-totalmenu").fadeIn(150, function() {
					$(".totalmenu-wrapper").addClass('active');
				});

				$(".contents-title").removeClass('active');
				$(".lnb-wrapper").hide();
			}
		} else {
			event.stopPropagation();

			location.replace('../sitemap/sitemap.php'); 
		}

    });

    $(".mask-totalmenu, .btn-mobile-close").click(function() {
        $(".totalmenu-depth1 > ul > li > button").each(function(i) {
            if ($(this).hasClass("active2")) {
                $(this).removeClass("active2").addClass("active");
            }
        });


        $("body").removeClass("fixed");
        $('.totalmenu-wrapper').removeClass('active');
        $(".mask-totalmenu").hide();
        /*
        $(".totalmenu-depth2-area").animate({
            left: 0
        }, 0);
        */
    });

    // mobile total menu control
    /*
    $(".totalmenu-depth1 > ul > li > button").on("click", function() {
    	var currentClass = $(this).attr('class');
    	var thisClass = currentClass.replace(" active", "")

    	$(".totalmenu-depth1 > ul > li > button").removeClass('point');
    	$(".totalmenu-depth2-group").removeClass('point');
    	$(".totalmenu-depth2-area").removeClass('dpeth3-moving');
    	$(".totalmenu-depth2-area").addClass('dpeth2-moving')

    	$(this).addClass('point');
    	$(".totalmenu-depth2-group." + thisClass).addClass('point');
    });
    */
    $(".totalmenu-depth1 > ul > li > button").on("click", function() {
        var currentClass = $(this).attr('class');
        var thisClass = currentClass.replace(" active", "");
        $(".totalmenu-depth1 > ul > li > button").each(function(i) {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active").addClass("active2");
            }
        });

        var index = $(".totalmenu-depth1 > ul > li > button").index(this);

        $(".totalmenu-depth1 > ul > li > button").removeClass('point');
        $(".totalmenu-depth2-group").removeClass('point');
        $(".totalmenu-depth2-area").removeClass('dpeth3-moving');
        $(".totalmenu-depth2-area").addClass('dpeth2-moving')

        $(this).addClass('point');
        //$(".totalmenu-depth2-group." + thisClass + ":eq()").addClass('point');
        $(".totalmenu-depth2-group:eq(" + index + ")").addClass('point');
    });

    $(".totalmenu-depth2-group > ul > li > a").on("click", function() {
        if ($(this).children().hasClass('arrow') == true) {

            $(".totalmenu-depth2-area").animate({
                left: "-" + totalmenuDepth2BoxWidth + "px"
            }, 150);

            var currentClass02 = $(this).attr('class');
            var currentClass02 = currentClass02.replace(" active", "");

            $(".totalmenu-depth3-group").removeClass('point');
            $(".totalmenu-depth3-group." + currentClass02).addClass('point');

            event.preventDefault();
            $(".totalmenu-depth2-area").removeClass('dpeth2-moving')
            $(".totalmenu-depth2-area").addClass('dpeth3-moving');
        } else {
            event.stopPropagation();
        }
    });

    $(".totalmenu-depth3-group > h3 > button").on("click", function() {
        $(".totalmenu-depth2-area").removeClass('dpeth3-moving');
        $(".totalmenu-depth2-area").addClass('dpeth2-moving')
    });
    // mobile total menu control

    /* mobile contents title - lnb menu */
    $(".contents-title").on("click", function() {
        $(".lnb-area > ul > li > ul").hide();
        $(".lnb-area > ul > li > ul.active").show();

        if ($(window).width() < 1024) {
            if ($(".lnb-wrapper").css("display") != "none") {
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
        if ($(this).children().hasClass('arrow') == true) {
            event.preventDefault();

            if ($(this).next(".lnb-area > ul > li > ul").css("display") != "none") {
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

    /* 부드럽게 상단으로 이동 */
    $('.btn-top-go, .btn-footer-top-go').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

    /* 최대화 최소화 */
    window.onresize = function() {
        if (window.innerHeight <= 1024) {
            $("body").removeClass('fixed');
            $(".mask-totalmenu").hide();
            $(".wrapper").removeClass('focus');
            $(".contents-title").removeClass('active');
        }
    }


    /* 아코디언 메뉴 */
    $(".accordion-menu-wrapper dl dt a").click(function() {
        if ($(this).parent().next(".accordion-menu-wrapper dl dd").css("display") == "none") {
            $(".accordion-menu-wrapper dl dt a").removeClass('active');
            $(".accordion-menu-wrapper dl dd").slideUp(75);
            $(this).addClass('active');
            $(this).parent().next(".accordion-menu-wrapper dl dd").slideDown(75);
        } else {
            $(".accordion-menu-wrapper dl dt a").removeClass('active');
            $(".accordion-menu-wrapper dl dd").slideUp(75);
        }
    });

    /* 탬메뉴 01 */
    charterTextMenu = $(".tabmenu-wrapper > ul > li.active").text().trim();
    $(".mobile-title").text(charterTextMenu);

    $(".mobile-title").on("click", function() {
        if ($(this).next().css('display') == 'none') {
            $(".mobile-title").removeClass('active');
            $(".tabmenu-wrapper > ul").slideUp(75);
            $(this).addClass('active');
            $(this).next().slideDown(75);
        } else {
            $(".mobile-title").removeClass('active');
            $(".tabmenu-wrapper > ul").slideUp(75);
            $(this).removeClass('active');
            $(this).next().slideUp(75);
        }
    });


    $(".tabmenu-wrapper > ul > li > a").on("click", function() {
        var tempIdx = $(this).attr('id');
        var thisIdx = tempIdx.replace(/[^0-9]/g, "");

        currentText = $("#tabmenu" + thisIdx).text().trim();
        $(".mobile-title").text(currentText);

        $(".tabmenu-wrapper > ul > li").removeClass('active');
        $(this).parent().addClass('active');
    });
});

/* resize */
$(window).resize(function() {
    $(".totalmenu-wrapper").removeClass('active');
    if ($(window).width() >= 1024) {
//        $(".totalmenu-wrapper").removeClass('active');
        $(".lnb-wrapper").hide();
        $(".lnb-area > ul > li > ul").hide();
        $(".lnb-area > ul > li > ul.active").show();
        $("body").removeClass('fixed');
        $(".contents-title").removeClass('active');
        $(".tabmenu-wrapper > ul").show();
    } else {
        $(".lnb-wrapper").hide();
        $(".lnb-area > ul > li > ul").hide();
        $(".lnb-area > ul > li > ul.active").show();
        $(".tabmenu-wrapper > ul").hide();
    }

    if ($(window).width() >= 1439) {
        $(".side-menu-area01").show();
    } else {
        $(".side-menu-area01").hide();
    }

});