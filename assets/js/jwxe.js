/*************************************************************
 // 팝업코드 처리
 *************************************************************/

$(function() {
	
	// 복사된 팝업의 아이디 정리
	if(typeof(_siteId) !== 'undefined') {
		$('a[class^=jwxe_popup_close_]').each(function() {
			var name = $(this).attr('name');
			name = _siteId + '_' + name.substring( name.indexOf('1') );
			$(this).attr('name',name);
		});
	}

	var popups = $(".jwxe_popup");

	if(popups.length > 0) {

		popups.css({'z-index':1001});

		var w = 0;
		var left = 0;
		/*
        var divs = $("div[class^=lo_]");
        if(divs.length > 0) {
            w = parseInt($(divs[0]).css("width"));
            left = $(divs[0]).position().left;
        } else {
            w = 1000;
        }*/


		if ($.browser.safari) {
			el =  document.body;
		} else {
			el =  document.documentElement;
		}
		w = el.offsetWidth;

		var sw = 0;
		for (var i = 0; i < popups.length; i++) {
			popups[i] = $(popups[i]);
			sw += popups[i].width()+20;
		}


		left = (parseInt((w-sw)/2) );
		if(left < 0) left = 0;

		// 팝업의 초기 위치 user.js
		left = typeof(user_popup_left) == 'undefined' ? left: user_popup_left;
		var top = typeof(user_popup_top) == 'undefined' ? 150: user_popup_top;

		for(var i=0;i<popups.length;i++) {
			var p = popups[i];
			var wrap = p.parent();
			// 새창 팝업은 스킵
			if(wrap.hasClass('popup-window')) {
				continue;
			}


			if(wrap.hasClass('popup-wrap')) {
				left = wrap.css('left').toInt();
				top = wrap.css('top').toInt();
				p.unwrap();
			} else
			if(i!=0) {
				left += (popups[i-1].width())+20;
			}

			p.css("left", left + "px");
			p.css("top", top+"px");
		}

		// 그림자
		for(var i=0; i<popups.length; i++) {
			if(popups.get(i).parent().hasClass('popup-window')) {
				popups.get(i).css('visibility','visible');
				continue;
			}

			if(popups.get(i).draggable) {
				popups.get(i).draggable();
			}

			popups.get(i).css('visibility','visible');
		}
	}



	var cookiedata = document.cookie;
	var cookie_max_count = 10;
	for ( var i = 0 ; i < cookie_max_count ; i++ ) {
		if ( cookiedata.indexOf("pop"+i+"=done") < 0 ){
			$("#pop"+i).show();
		}else{
			$("#pop"+i).hide();
		}
	}


	$("a[class=jwxe_popup_close] , .adbank_popup_close").click(
		function() {
			if($(this).parents('.jwxe_popup').parent().hasClass('popup-window')) {
				// 새창
				self.close();
			} else {
				// 레이어
				var parent = $(this).parents('.jwxe_popup');
				parent.remove();
			}
			return false;
		}
	);

	$("a[class=jwxe_popup_close_7]").click(
		function() {
			var nm = $(this).attr("name");

			$.setCookie( nm, 'true', {
				duration : 7, // In days
				path : '/',
				domain : '',
				secure : false
			});

			if($(this).parent('.jwxe_popup').parent().hasClass('popup-window')) {
				// 새창
				self.close();
			} else {
				// 레이어
				var parent = $(this).parent('.jwxe_popup');
				parent.remove();

			}

			return false;
			//console.log($.readCookie(nm));
		}
	);

	$("a[class=jwxe_popup_close_1], .adbank_popup_close_1").click(
		function() {

			var nm = $(this).attr("name");

			setCookie(nm, "done", 1);

			if($(this).parents('.jwxe_popup').parent().hasClass('popup-window')) {
				// 새창
				self.close();
			} else {
				// 레이어
				var parent = $(this).parents('.jwxe_popup');
				parent.remove();
			}

			return false;
			//console.log($.readCookie(nm));
		}
	);


	$(".jwxe_popup").css({'z-index':1001});
});

