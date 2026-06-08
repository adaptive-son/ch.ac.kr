	<link rel="stylesheet" href="/_common/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/_common/css/popup.css">

	<script>
		$( document ).ready( function () {
			if($("body").hasClass('main') == true) {
				$('.popupzone-wrapper').show();
				$(".aside-quickmenu-wrapper").addClass('on');
				$("#popupzone-toggle-button").addClass('active');
			} else {
				$('.popupzone-wrapper').show().slideUp(75);
				$(".aside-quickmenu-wrapper").removeClass('on');
				$("#popupzone-toggle-button").removeClass('active');
			}

			$('.btn-popup-close' ).click( function () {
				if ( $( "input:checkbox[id='checkbox-top-popupzone']" ).is( ":checked" ) ) {
					setCookie( "popname", "done", 1 );
				}
				$( '.popupzone-wrapper' ).slideUp( 75 );
				if($('.popupzone-wrapper').hasClass('checked') == true) {
					$('.btn-popup').focus();
				} 
			});
			if ( getCookie( "popname" ) == "done" ) {
				$( '.popupzone-wrapper' ).css( "display", "none" );
			}
		
		});

		<?php
			if($_GET['popup']){
				//cyhwang 2022-07-28 춘해대 소스취약점 패치
				$popup_w = $_GET['popupw'] == "" ? "500": urlencode($_GET['popupw']);
				$popup_h = $_GET['popuph'] == "" ? "500": urlencode($_GET['popuph']);
				echo "
		      window.open('/popup/20220210.html', 'popup_20220210', 'width=".$popup_w.", height=".$popup_h.", left=0, top=0, resizable = no');
		    ";
			}
		?>

		function setCookie( name, value, expiredays ) {
			var todayDate = new Date();
			todayDate.setDate( todayDate.getDate() + expiredays );
			document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
		}

		function getCookie( name ) {
			var nameOfCookie = name + "=";
			var x = 0;
			while ( x <= document.cookie.length ) {
				var y = ( x + nameOfCookie.length );
				if ( document.cookie.substring( x, y ) == nameOfCookie ) {
					if ( ( endOfCookie = document.cookie.indexOf( ";", y ) ) == -1 ) {
						endOfCookie = document.cookie.length;
					}
					return unescape( document.cookie.substring( y, endOfCookie ) );
				}
				x = document.cookie.indexOf( " ", x ) + 1;
				if ( x == 0 ) break;
			}
			return "";
		}
	</script>

	


	<script src="/_common/js/owl.carousel.min.js"></script>
	<script>
		$(function() {
			var topPopupzoneSlider = $('#top-popupzone-slider');
			topPopupzoneSlider.owlCarousel({
				items: 2,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: false,
				loop: false, //true -> false로 수정함
				nav: true,
				dots: true,
				slideSpeed: 10000,
				dotsContainer: '#popup-thumbs01',
				margin: 10,
				responsiveClass:true,
				responsive:{
					0:{
						items: 1,
					},
					1024:{
						items:2,
					}
				}
			});
			$('.btn-popupzone-play').click(function() {
				topPopupzoneSlider.trigger('play.owl.autoplay',[5000]);
			});
			
			$('.btn-popupzone-stop').click(function() {
				topPopupzoneSlider.trigger('stop.owl.autoplay');
			});


			
			/* 2021.01.20 추가작업 포커스링 */
			$("#popupzone-toggle-button").on("click", function() {
				if($(".popupzone-wrapper").css("display") != "none") {
					$(".popupzone-wrapper").slideUp(75).removeClass('checked');
					$(this).removeClass('active');
					$(".aside-quickmenu-wrapper").removeClass('on');
				} else {
					$(".popupzone-wrapper").slideDown(75).addClass('checked');
					$(this).addClass('active');
					$(".aside-quickmenu-wrapper").addClass('on');
					$("#top-popupzone-slider .owl-item:first-child a").focus();
					topPopupzoneSlider.trigger('stop.owl.autoplay');
					topPopupzoneSlider.trigger('to.owl.carousel', 0);
					$("#top-popupzone-slider .owl-item:eq(0) a").focus();
				}
			});
		
		});
		
			
	</script>
