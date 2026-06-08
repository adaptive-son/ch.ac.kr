<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		FAQ &lt; 국제개발협력센터 &lt; 국제개발협력센터 - 춘해보건대학교
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
							<? include "../include/lnb06.php" ?>
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
							ODA가 무엇인가요?




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>
				ODA (Official Development Assistance) 공적 개발원조라고 합니다.<br>
				   ODA에 대한 정의는 OECD DAC에 의해 1969년에 도입되었으며, 개발도상국 또는 다자개     발기구로 흘러 들어가는 자금 중 다음의 3가지 조건을 충족하는 자금을 말합니다. <br>
				   ① 중앙 및 지방정부, 그 집행기관 등의 공적기관이 제공하는 자금<br>
				   ② 주요목적이 개발도상국의 경제 발전과 복지증진에 이바지하기 위한 것<br>
				   ③ 양허적 성격을 가져야 함 (양허: 상대방이 유리하도록 헤아려 주는 것)
					</p>

				</dd>
			</dl>



			<dl class=" row-bg  ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						해외현장 활동에 참여하고 싶습니다. 자격요건이 어떻게 되나요?




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="display: none;">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

				최소한 다음의 3가지가 충족되어야 합니다.<br>
			   ① 의사소통 : 영어 등의 외국어 사용으로 의사소통이 가능한 사람<br>
			   ② 봉사정신 : 타인을 배려하고 도와주고자 하는 아름다운 마음이 갖추어진 사람<br>
			   ③ 재능기부 : 만들기, 운동, 춤, 악기, 한글 가르치기 등 본인이 가진 역량을 타인을 위해  기꺼이 나눌 수 있는 사람


					</p>

				</dd>
			</dl>




			<dl class="   ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						ODA자격증 시험에 대해 알려주세요. 




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

					ODA 시험이라고 입력하면 자세히 알 수 있습니다.<br>
●자격시험 요강 (2023년 10월 기준)<br>
 - 응시자격: 연령, 학력, 경력 제한없이 누구나 응시가능<br>
 - 시험유형: 필기/4지선다형 객관식<br>
 - 시험문항: 총 80문항<br>
 - 시험과목: 총 2과목 (국제개발협력의 이해 및 분야별 이슈)<br>
 - 합격기준: 과목당 60전 이상, 전 과목 평균 70점 이상<br>
 - 접수처: ODA 교육원 홈페이지 온라인 접수<br>
 - 응시료: 20,000원<br>
 - 자격증 유효기간: 합격 발표일로부터 3년간

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
		//faq script

		// $('.faq-wrapper').find('dl').on('click',function(){
		// 	$(this).children('dt').toggleClass('active');
		// 	$(this).children('dd').css({'display':'block'});
		// });

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
		menuOn(6, 3, 0);
	</script>
</body>
</html>
