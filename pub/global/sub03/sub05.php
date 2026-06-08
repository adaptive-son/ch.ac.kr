<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		취업정보 &lt; 취업·진로 &lt; 웰니스문화관광과 - 춘해보건대학교
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
							취업·진로
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<strong>
							취업정보
						</strong>
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
								취업정보
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->
								
								<? include "../../assets/board/list.php" ?>

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
		menuOn(3, 5, 0);
	</script>
</body>
</html>
