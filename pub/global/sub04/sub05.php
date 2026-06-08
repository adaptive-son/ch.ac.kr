<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		FAQ &lt; 한국어교육원 &lt; 국제개발협력센터 - 춘해보건대학교
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
							한국어교육원
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
							<? include "../include/lnb04.php" ?>
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
							한국어교육원에서 실시하는 한국어수업의 수강생 자격이 궁금합니다.




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

					외국인 한국어연수생 입학수칙 제 3조에 따라 다음과 같습니다.<br>
					제3조 (입학자격)<br>
					1. 고등학교 졸업 혹은 동등의 학력 이상인 자로서 학위과정에 진학할 의사가 분명한 자<br>
					2. 연령이 18~25세를 초과하지 않고 최종학교 졸업 후 3년이 경과하지 않은 자<br>
					3. 대한만국 어학연수 비자를 신청하여 불허를 받은 경험이 없는 자<br>
					4. 대한민국 내에 불법체류를 한 경험이 없는 자<br>
					5. 대한민국 내에 거주하는 친인척 혹은 가족이 불법체류를 한 경력이 없는 자<br>
					6. 기타 본교 한국어교육원에서 정한 유학생 입학 요강에 부합하는 자

				</dd>
			</dl>



			<dl class=" row-bg  ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						기숙사 시설과 비용이 어떻게 되는 지 궁금합니다.




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="display: none;">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

				기숙사 시설은 본교 홈페이지를 참조하세요. <br>
				   2인 1실이며, 한국어 연수생에 한정하여 6개월에 900,000원입니다.<br>
				   (*전기료 등 실비 미포함)


					</p>

				</dd>
			</dl>




			<dl class="   ">
				<dt>
					<a href="#faq-dl">
						<img src="../../assets/img/board/icon_q@2x.png" alt="Question" class="icon-q">






						<strong>
						한국어교육원에서 실시하는 한국어 level을 모두 마치는데 걸리는 시간은 얼마나 되나요?




						</strong>
						<span class="arrow"></span>
					</a>
				</dt>
				<dd style="">
					<img src="../../assets/img/board/icon_a@2x.png" alt="Answer" class="icon-a">
					<p>

					학생들이 얼마나 열심히 하느냐에 따라 다릅니다. 1년 과정을 통해 TOPIK 3급     에 합격할 수 있도록 하는 것이 본교의 목표입니다.  
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
		menuOn(4, 5, 0);
	</script>
</body>
</html>
