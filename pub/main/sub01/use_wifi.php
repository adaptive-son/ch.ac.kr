<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
$PAGEINDEX1="1";
?>
<!doctype html>
<html lang="ko">
<head>
	<?php
    include("../include/meta.php");
    ?>
    <title>춘해보건대학교 와이파이 이용가이드</title>
</head>
<body>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->
<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../include/header.php");?>
    <!-- //header -->

    <!-- sub visual -->
      <div class="sub-visual02">
		<img src="../img02/sub01/img_subvisual_pc.jpg" alt="" class="pc active">
		<img src="../img02/sub01/img_subvisual_mobile.jpg" alt="" class="mobile active">
		<p>
			<strong>
				구형 안드로이드폰 사용자용 스마트 클라스 연결방법
			</strong>
			<span>
				57년 전통의 보건의료 특성화 대학
			</span>
		</p>
	</div>
    <!-- sub visual -->

    <!-- container -->
    <section>
        <div class="container" id="container">
            <div class="container-wrapper">
			<!-- lnb -->
			<?
				include("../include/lnb.php");
			?>
			<!-- //lnb -->
            <!-- contents -->
            <article>
                <div class="contents" id="contents">
                    <h3 class="contents-title">
						와이파이 이용가이드
                        <span class="arrow"></span>
                    </h3>

                    <!-- contents-wrapper -->
                    <div class="contents-wrapper">
						<div class="btns-area mb35">
							<div class="btns-left">
								<a href="/sub01/iOS.php" target="_blank" class="btn download03">
									<span class="name1">
										아이폰 사용자용 스마트 클래스 연결방법 보기
									</span>
								</a>

								<a href="/sub01/android.php" target="_blank" class="btn download03">
									<span class="name1">
										안드로이드폰 사용자용 스마트 클래스 연결방법 보기
									</span>
								</a>

								<a href="/sub01/old_android.php" target="_blank" class="btn download03">
									<span class="name1">
										구형 안드로이드 및 갤럭시 탭 사용자용 스마트 클래스 연결방법 보기
									</span>
								</a>
							</div>
						</div>

						<div class="pdf-box-area">
							<iframe class="div-pdf" id="div-pdf" src="../pdfjs/web/viewer.html?file=/main/wifi_240322.pdf" title="와이파이 이용가이드"></iframe>
						</div>
					</div>
                    <!-- //contents-wrapper -->
                </div>
            </article>
            <!-- //contents -->
            </div>
        </div>
    </section>
    <!-- //container -->
    <!-- footer -->
	<?
		include("../_common/footer.php");
	?>
    <!-- //footer -->
</div>
<!-- //wrapper -->
</body>
</html>
