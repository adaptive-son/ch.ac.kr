<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
	포토갤러리 &lt; 국제개발협력센터 &lt; 국제개발협력센터 - 춘해보건대학교
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
						국제개발협력센터
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
						포토갤러리
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
							<? include "../include/lnb06.php" ?>
						</div>
					</div>				
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
	
							
							<h3 class="contents-title">
								포토갤러리
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->

							<? include "../../assets/board/photo.php" ?>

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
		menuOn(6, 4, 0);
	</script>
</body>
</html>
