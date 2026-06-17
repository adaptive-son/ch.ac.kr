<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	
	<title>
		오시는 길 &lt; 국제교류원 &lt; 국제교류원 - 춘해보건대학교
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
							국제교류원
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
								

								<div class="facilities-slide-wrapper">
									<div class="facilities-slide-area">
										<h4>
											이론 강의실
										</h4>
										<div class="facilities-slide-box">
											<div class="swiper-container" id="facilities-slider01">
												<div class="swiper-wrapper">
													<div class="swiper-slide">
														<img src="../img/sub01/facilities/01/01.jpg" alt="기초실습실1" />
													</div>
													<div class="swiper-slide">
														<img src="../img/sub01/facilities/01/02.jpg" alt="기초실습실2" />
													</div>
												</div>
											</div>
										</div>

										<div class="facilities-option-btn" id="facilities-btn01">
											<button type="button" class="swiper-button-play" style="display: none">play</button>
											<button type="button" class="swiper-button-pause">stop</button>
											<button type="button" class="facilities-prev">previous</button>
											<button type="button" class="facilities-next">next</button>
										</div>
									</div>


									<div class="facilities-slide-area">
										<h4>
											다목적 강의실
										</h4>
										<div class="facilities-slide-box">
											<div class="swiper-container" id="facilities-slider02">
												<div class="swiper-wrapper">
													<div class="swiper-slide">
														<img src="../img/sub01/facilities/02/01.jpg" alt="치위생실습실1" />
													</div>
												</div>
											</div>
										</div>

										<div class="facilities-option-btn" id="facilities-btn02">
											<button type="button" class="swiper-button-play" style="display: none">play</button>
											<button type="button" class="swiper-button-pause">stop</button>
											<button type="button" class="facilities-prev">previous</button>
											<button type="button" class="facilities-next">next</button>
										</div>
									</div>

									<div class="facilities-slide-area">
										<h4>
											전산실습실
										</h4>
										<div class="facilities-slide-box">
											<div class="swiper-container" id="facilities-slider03">
												<div class="swiper-wrapper">
													<div class="swiper-slide">
														<img src="../img/sub01/facilities/03/01.jpg" alt="구강방사선실습실1" />
													</div>
												</div>
											</div>
										</div>

										<div class="facilities-option-btn" id="facilities-btn03">
											<button type="button" class="swiper-button-play" style="display: none">play</button>
											<button type="button" class="swiper-button-pause">stop</button>
											<button type="button" class="facilities-prev">previous</button>
											<button type="button" class="facilities-next">next</button>
										</div>
									</div>

								
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
