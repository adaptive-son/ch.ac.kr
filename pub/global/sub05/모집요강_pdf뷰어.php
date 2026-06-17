<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	
	<title>
		Growing &lt; 글로벌센터 &lt; 국제교류원 - 춘해보건대학교
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
							글로벌센터
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							Growing
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
							<? include "../include/lnb05.php" ?>
						</div>
					</div>				
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
	
							
							<h3 class="contents-title">
								Growing
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->
								<div class="tabmenu-wrapper ratio"><!-- 탭 크기 동일한 비율로 작성할때 ratio 추가 -->
									<ul class="depth4"> <!-- 기본 2개 depth3 depth4 depth5 ..형식으로 구성됨-->
										<li class="topmenu1-5-1">
											<a href="../sub05/sub0501.php">
												2020학년도
											</a>
										</li>
										<li class="topmenu1-5-2">
											<a href="../sub05/sub0502.php">
												2019학년도
											</a>
										</li>
										<li class="topmenu1-5-3">
											<a href="../sub05/sub0503.php">
												2018학년도
											</a>
										</li>
										<li class="topmenu1-5-4">
											<a href="../sub05/sub0504.php">
												2017학년도
											</a>
										</li>
									</ul>
								</div>

								<div class="btns-area pt0">
									<div class="btns-right">
										<a href="#" class="btn-download type01 depth2">
											<span>
												<strong>
													PDF 다운로드
												</strong>
												<img src="../img/icon/icon_download01.png" alt="" />
											</span>
										</a>

										<a href="https://get.adobe.com/reader/?loc=kr" class="btn-download type02 depth2" target="_blank" title="새창 열림">
											<span>
												<strong>
													PDF 뷰어
												</strong>
												<img src="../img/icon/icon_download01.png" alt="" />
											</span>
										</a>
									</div>
								</div>

								<div class="contents-area">
									<iframe class="div-pdf" src="../pdfjs/web/viewer.html?file=schdule_nurs2020.pdf" title="춘해보건대학교 - 간호학과"></iframe>
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
		menuOn(5, 4, 1);
	</script>
</body>
</html>
