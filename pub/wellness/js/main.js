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
});