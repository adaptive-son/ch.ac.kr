<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	
	<title>
		오시는 길 &lt; 국제교류처 &lt; 국제교류처 - 춘해보건대학교
	</title>
</head>

<body> 
	<!-- wrapper -->
	<div class="wrapper" id="wrapper">	
		<!-- header -->
		<header>
			<? include "../include/header.php" ?>
		</header>
		<!-- //header -->

		<!-- sub visual -->
		<? include "./sub_visual.php" ?>
		<!-- //sub visual -->

		<!-- container -->
		<section>
			<div class="container" id="container">

				<div class="contents-navigation-wrapper">
					<div class="contents-navigation">
						<span class="icon-home">
							Home
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							국제교류처
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							오시는 길 
						</span>
						<!-- 3차뎁스 있을 시 아래 코드 사용 -->
						<!-- <span class="icon-gt">
							&gt;
						</span>
						<strong>
							인사말
						</strong> -->
					</div>
				</div>	

				<div class="container-wrapper">

					<div class="lnb-wrapper">
						<div class="lnb-area">
							<? include "../include/lnb01.php" ?>
						</div>
					</div>				
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
	
							
							<h3 class="contents-title">
							오시는 길
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<!-- CMS 시작 -->

								<div class="map-wrapper">

									<!-- * 카카오맵 - 지도퍼가기 -->
									<!-- 1. 지도 노드 -->
									<div id="daumRoughmapContainer1709084509390" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%; border-bottom:1px solid #eee;"></div>

									<!--
										2. 설치 스크립트
										* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
									-->
									<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

									<!-- 3. 실행 스크립트 -->
									<script charset="UTF-8">
										new daum.roughmap.Lander({
											"timestamp" : "1709084509390",
											"key" : "2iafy",
											// "mapWidth" : "640",
											"mapHeight" : "420"
										}).render();
									</script>

									<script>
										var mapContainer = document.getElementById('map');
        var mapOption = {
            center: new kakao.maps.LatLng(37.5665, 126.9780), // 지도 중심 좌표 (서울)
            level: 4 // 지도 확대 레벨
        };

        // 지도 생성
        var map = new kakao.maps.Map(mapContainer, mapOption);

        // 창 크기 조절 이벤트
        window.addEventListener('resize', function() {
            // 창 크기가 변경될 때 지도 크기 재조절
            map.relayout();
        });
									</script>

								</div>

								<div class="contents-area">
									<h4 class="title-type01">
											국제교류처 오시는 길 
									</h4>

									<p class="word-type01">
									(44965) 울산광역시 울주군 웅촌면 대학길 9 춘해보건대학교 해악관 302호
									</p>
								</div>


								

								<!-- //CMS 끝 -->
							</div>
						</div>
					</article>
					<!-- //contents  -->
				</div>

			</div>
		</section>
		<!-- //container -->

		<!-- footer -->
		<footer>
			<? include "../include/footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
	<script>
		menuOn(1, 4, 0);

		/* facilities swiper01 */
		var facilitiesSwiper01 = new Swiper('#facilities-slider01', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn01 .facilities-next',
				prevEl: '#facilities-btn01 .facilities-prev',
			},
		});

		$("#facilities-btn01 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper01.autoplay.stop();

			$("#facilities-btn01 .swiper-button-pause").hide();
			$("#facilities-btn01 .swiper-button-play").show();
		});

		$("#facilities-btn01 .swiper-button-play").on('click', function(e){
			facilitiesSwiper01.autoplay.start();
			$("#facilities-btn01 .swiper-button-pause").show();
			$("#facilities-btn01 .swiper-button-play").hide();
		});

		/* facilities swiper02 */
		var facilitiesSwiper02 = new Swiper('#facilities-slider02', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn02 .facilities-next',
				prevEl: '#facilities-btn02 .facilities-prev',
			},
		});

		$("#facilities-btn02 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper02.autoplay.stop();

			$("#facilities-btn02 .swiper-button-pause").hide();
			$("#facilities-btn02 .swiper-button-play").show();
		});

		$("#facilities-btn02 .swiper-button-play").on('click', function(e){
			facilitiesSwiper02.autoplay.start();
			$("#facilities-btn02 .swiper-button-pause").show();
			$("#facilities-btn02 .swiper-button-play").hide();
		});

		/* facilities swiper03 */
		var facilitiesSwiper03 = new Swiper('#facilities-slider03', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn03 .facilities-next',
				prevEl: '#facilities-btn03 .facilities-prev',
			},
		});

		$("#facilities-btn03 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper03.autoplay.stop();

			$("#facilities-btn03 .swiper-button-pause").hide();
			$("#facilities-btn03 .swiper-button-play").show();
		});

		$("#facilities-btn03 .swiper-button-play").on('click', function(e){
			facilitiesSwiper03.autoplay.start();
			$("#facilities-btn03 .swiper-button-pause").show();
			$("#facilities-btn03 .swiper-button-play").hide();
		});

		/* facilities swiper04 */
		var facilitiesSwiper04 = new Swiper('#facilities-slider04', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn04 .facilities-next',
				prevEl: '#facilities-btn04 .facilities-prev',
			},
		});

		$("#facilities-btn04 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper04.autoplay.stop();

			$("#facilities-btn04 .swiper-button-pause").hide();
			$("#facilities-btn04 .swiper-button-play").show();
		});

		$("#facilities-btn04 .swiper-button-play").on('click', function(e){
			facilitiesSwiper04.autoplay.start();
			$("#facilities-btn04 .swiper-button-pause").show();
			$("#facilities-btn04 .swiper-button-play").hide();
		});

		/* facilities swiper05 */
		var facilitiesSwiper05 = new Swiper('#facilities-slider05', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn05 .facilities-next',
				prevEl: '#facilities-btn05 .facilities-prev',
			},
		});

		$("#facilities-btn05 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper05.autoplay.stop();

			$("#facilities-btn05 .swiper-button-pause").hide();
			$("#facilities-btn05 .swiper-button-play").show();
		});

		$("#facilities-btn05 .swiper-button-play").on('click', function(e){
			facilitiesSwiper05.autoplay.start();
			$("#facilities-btn05 .swiper-button-pause").show();
			$("#facilities-btn05 .swiper-button-play").hide();
		});

		/* facilities swiper06 */
		var facilitiesSwiper06 = new Swiper('#facilities-slider06', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn06 .facilities-next',
				prevEl: '#facilities-btn06 .facilities-prev',
			},
		});

		$("#facilities-btn06 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper06.autoplay.stop();

			$("#facilities-btn06 .swiper-button-pause").hide();
			$("#facilities-btn06 .swiper-button-play").show();
		});

		$("#facilities-btn06 .swiper-button-play").on('click', function(e){
			facilitiesSwiper06.autoplay.start();
			$("#facilities-btn06 .swiper-button-pause").show();
			$("#facilities-btn06 .swiper-button-play").hide();
		});
	</script>
</body>
</html>
