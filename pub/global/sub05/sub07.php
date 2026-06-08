<!doctype html>
<html lang="ko">

<head>
    <? include "../include/meta.php" ?>
    <title>
    FAQ &lt; 글로벌센터 &lt; 국제교류처 - 춘해보건대학교
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
                        FAQ
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
                            FAQ
                                <span class="arrow"></span>
                            </h3>

                            <div class="contents-wrapper">
                                <!-- CMS 시작 -->

                                <div class="faq-wrapper">


	
		
		
		
		
		
		

		
		

		
		
		
		
			<dl class="   ">
				<dt class="">
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
							글로벌 현장학습 프로그램에 지원하기 위한 제출서류는 무엇인가요?




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>
					참가신청서, 현장학습 계획서, 개인정보 수집 동의서, 어학성적표, 성적증명서, 재학증명서 서류가 필요합니다.
					</p>

				</dd>
			</dl>



			<dl class=" row-bg  ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						글로벌 프로그램을 들으면 특별학점이 인정되는지 궁금합니다.



						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="display: none;">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

				토익사관학교와 잉글리시 클래스 수료증이 있다면 학점 1점 인정됩니다.


					</p>

				</dd>
			</dl>




			<dl class="   ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						글로벌 프로그램 별로 마일리지 적립이 어떻게 다른가요?




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

				 1) 어학교육 (오프라인): 30점<br>
				 2) 어학교육 (온라인): 20점<br>
				 3) 어학 경진대회: 20점<br>
				 4) 어학캠프 참가: 20점<br>
				 5) 교내 국제교류 프로그램 참가: 20점 
					</p>

				</dd>
			</dl>






	

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
		/* faq */
	$(".faq-wrapper > dl > dt > a").on("click", function() {
		if( $(this).parent().next().css("display") != "none" ) {
			$(".faq-wrapper > dl > dd").slideUp(75);
			$(".faq-wrapper > dl > dt").removeClass('active');
		} else {
			$(".faq-wrapper > dl > dd").slideUp(75);
			$(".faq-wrapper > dl > dt").removeClass('active');
			$(this).parent().addClass('active');
			$(this).parent().next().slideDown(75);
		}
	});


	</script>
    <script>
        menuOn(5, 7, 0);

    </script>
</body>

</html>
