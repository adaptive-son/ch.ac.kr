<!doctype html>
<html lang="ko">

<head>
	<? include "../include/meta.php" ?>
	<title>
		대학이념 &lt; 대학소개 &lt; 대학안내 &lt; 춘해보건대학교
	</title>
</head>

<body>

	<!-- quick menu -->
	<? include "../include/quickmenu.php" ?>
	<!-- //quick menu -->
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
				<!-- contents navigation, content options -->
				<? include "../include/contents_navigation.php" ?>
				<!-- contents navigation, content options -->

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
								공지사항
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<!-- CMS 시작 -->

                                    <!-- //게시판 보기 -->
							    	<? include "../../assets/board/write.php" ?>
									<!-- //게시판 보기 -->

									

								<!-- //CMS 끝 -->
							</div>

							<!-- 담당자 -->
							<? include "../include/manager_information.php" ?>
							<!-- //담당자 -->
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
		menuOn(1, 1, 1);
	</script>
</body>

</html>