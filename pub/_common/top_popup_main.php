	<link rel="stylesheet" href="/_common/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/_common/css/popup.css">

	<script>
		$( document ).ready( function () {
			if($("body").hasClass('main') == true) {
				$('#top-popupzone-wrapper').show();
				$(".aside-quickmenu-wrapper").addClass('on');
				$("#popupzone-toggle-button").addClass('active');
			} else {
				$('#top-popupzone-wrapper').show().slideUp(75);
				$(".aside-quickmenu-wrapper").removeClass('on');
				$("#popupzone-toggle-button").removeClass('active');
			}

			$('.btn-popup-close' ).click( function () {
				if ( $( "input:checkbox[id='checkbox-top-popupzone']" ).is( ":checked" ) ) {
					setCookie( "popname", "done", 1 );
				}
				$( '#top-popupzone-wrapper' ).slideUp( 75 );
				if($('#top-popupzone-wrapper').hasClass('checked') == true) {
					$('.btn-popup').focus();
				} 
			});
			if ( getCookie( "popname" ) == "done" ) {
				$( '#top-popupzone-wrapper' ).css( "display", "none" );
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

	<!-- popup zone -->
	<div class="popupzone-wrapper" id="top-popupzone-wrapper" style="display:none;">
		<div class="popupzone-area">
		<?php
		$today_date = date("Y-m-d");
		// 배너 정보 조회
		$toppopupQuery = " select * from ".TABLE_TOPPOPUP." where site_id='".site_id."' AND useyn='Y' AND '".$today_date."' between gigan1 and gigan2 ORDER BY sort ASC ";

		$result = DBquery($toppopupQuery);
		$count = mysql_num_rows($result);

		?>
			<div <?php if($count>1){?>class="owl-carousel" <?php } ?>id="top-popupzone-slider">
				<?php


					for($i=0; $row=@mysql_fetch_array($result); $i++) {
				?>
				<div <?php if($count > 1){?>class="item"<?php } ?>  data-dot="<button>배너 <?= $i + 1 ?> </button>">
					<a href="<?= $row[link_url]?> <?php if($row['imgYN']=="Y"){?>&no=<?php echo $row['no']?><?php } ?>" target="<?= $row[target] ?>" title="새창 열림">
						<img src="<?=TOPPOPUP_LOAD_PATH?>/<?= $row[toppopup_name] ?>" alt="<?= $row['toppopup_text'] ?>" />
					</a>
				</div>
				<? } ?>
			</div>

			<div class="popupzone-footer-wrapper">
				<div class="popupzone-btns-wrapper">
					<div class="owl-dots" id="popup-thumbs01"></div>

					<button type="button" class="btn-popupzone-play">
						상단팝업 자동 이동
					</button>

					<button type="button" class="btn-popupzone-stop">
						상단팝업 멈춤
					</button>
				</div>
				<div class="today-checked-close">
					<input type="checkbox" id="checkbox-top-popupzone" name="" value=""/>
					<label for="checkbox-top-popupzone">
						오늘하루 열지않기
					</label>
				</div>

				<button type="button" class="btn-popup-close">
					팝업존 창닫기
				</button>

			</div>
		</div>
	</div>
	<!-- popup zone -->


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
				dotsData: true,
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
				if($("#top-popupzone-wrapper").css("display") != "none") {
					$("#top-popupzone-wrapper").slideUp(75).removeClass('checked');
					$(this).removeClass('active');
					$(".aside-quickmenu-wrapper").removeClass('on');
				} else {
					$("#top-popupzone-wrapper").slideDown(75).addClass('checked');
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
