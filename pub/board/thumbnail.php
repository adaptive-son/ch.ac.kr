<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		감리교신학대학교(METHODIST THEOLOGICAL UNIVERSITY) 장천생활관
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
					<div class="contents-navigation-area">
						<p class="contents-navigation-box">
							<a href="#" class="home">
								홈
							</a>

							<span class="icon-gt">
								&gt;
							</span>

							<a href="#" class="location">
								장천생활관 소개
							</a>

							<span class="icon-gt">
								&gt;
							</span>

							<strong>
								설립목적 및 연혁
							</strong>
						</p>

						<ul class="additional-function-wrapper">
							<li>
								<button type="button" class="big" onclick="zoomOut(); return false;">
									Font Big
								</button>
							</li>
							<li>
								<button type="button" class="reset" onclick="zoomReset(); return false;">
									Font Reset
								</button>
							</li>
							<li>
								<button type="button" class="small" onclick="zoomIn(); return false;">
									Font Small
								</button>
							</li>

							<li>
								<button type="button" class="print">
									Print
								</button>
							</li>
						</ul>
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
								설립목적 및 연혁
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->


								<!-- 게시판 목록 -->
								<? include "../../assets/board/thumbnail.php" ?>
								<!-- //게시판 목록 -->


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
		menuOn(5, 1, 0);
	</script>
</body>
</html>
