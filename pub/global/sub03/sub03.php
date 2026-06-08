<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		졸업후 진로 &lt; 유학생활 안내 &lt; 국제교류처 - 춘해보건대학교
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
							유학생활 안내
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							졸업후 진로
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
							<? include "../include/lnb03.php" ?>
						</div>
					</div>				
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
	
							
							<h3 class="contents-title">
								졸업후 진로
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<!-- CMS 시작 -->
							<div class="images-box" >
							<img src="../img/img_preparation.jpg" alt="">
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
		menuOn(3, 3, 0);

		var mainStudentSlider01 = new Swiper('#student-slide-area', {
			loop: true,
			autoHeight: true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '#main-student-pagination01'
			},
			navigation: {
				nextEl: '.student-btn-next',
				prevEl: '.student-btn-prev',
			},
		});
	</script>
</body>
</html>
